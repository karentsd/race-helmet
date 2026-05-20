<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    private function sid(): string
    {
        return session()->getId();
    }

    public function index(): View
    {
        $items          = CartItem::session($this->sid())->orderBy('created_at')->get();
        $total          = $items->sum(fn($i) => (float) $i->precio * $i->cantidad);
        $cantidad_total = $items->sum('cantidad');

        return view('cart', compact('items', 'total', 'cantidad_total'));
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'producto_nombre' => 'required|string|max:150',
            'producto_imagen' => 'nullable|string|max:150',
            'producto_emoji'  => 'nullable|string|max:10',
            'producto_bg'     => 'nullable|string|max:200',
            'precio'          => 'required|numeric|min:0',
        ]);

        $sid  = $this->sid();
        $item = CartItem::where('session_id', $sid)
            ->where('producto_nombre', $request->producto_nombre)
            ->first();

        if ($item) {
            $item->increment('cantidad');
        } else {
            CartItem::create([
                'session_id'      => $sid,
                'producto_nombre' => $request->producto_nombre,
                'producto_imagen' => $request->producto_imagen,
                'producto_emoji'  => $request->producto_emoji ?? '🪖',
                'producto_bg'     => $request->producto_bg,
                'precio'          => (float) $request->precio,
                'cantidad'        => 1,
            ]);
        }

        return response()->json([
            'success'    => true,
            'message'    => '¡Casco agregado al carrito!',
            'cart_count' => (int) CartItem::session($sid)->sum('cantidad'),
        ]);
    }

    public function update(Request $request, CartItem $cartItem): JsonResponse
    {
        $request->validate(['cantidad' => 'required|integer|min:1|max:99']);

        if ($cartItem->session_id !== $this->sid()) {
            return response()->json(['success' => false, 'message' => 'No autorizado.'], 403);
        }

        $cartItem->update(['cantidad' => (int) $request->cantidad]);
        $cartItem->refresh();

        $subtotal = (float) $cartItem->precio * $cartItem->cantidad;
        $total    = CartItem::session($this->sid())->get()->sum(fn($i) => (float) $i->precio * $i->cantidad);

        return response()->json([
            'success'    => true,
            'subtotal'   => number_format($subtotal, 0, ',', '.'),
            'total'      => number_format($total,    0, ',', '.'),
            'cart_count' => (int) CartItem::session($this->sid())->sum('cantidad'),
        ]);
    }

    public function remove(CartItem $cartItem): JsonResponse
    {
        if ($cartItem->session_id !== $this->sid()) {
            return response()->json(['success' => false, 'message' => 'No autorizado.'], 403);
        }

        $cartItem->delete();

        $total = CartItem::session($this->sid())->get()->sum(fn($i) => (float) $i->precio * $i->cantidad);

        return response()->json([
            'success'    => true,
            'total'      => number_format($total, 0, ',', '.'),
            'cart_count' => (int) CartItem::session($this->sid())->sum('cantidad'),
        ]);
    }

    public function clear(): RedirectResponse
    {
        CartItem::session($this->sid())->delete();
        return redirect()->route('cart')->with('success', 'Carrito vaciado correctamente.');
    }

    public function count(): JsonResponse
    {
        return response()->json(['count' => (int) CartItem::session($this->sid())->sum('cantidad')]);
    }
}