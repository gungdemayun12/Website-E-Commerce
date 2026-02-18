<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelPdf\Facades\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    
    public function index()
    {
        $customerId = Auth::guard('customer')->id();

        if (!$customerId) {
            return redirect()->route('customer.login');
        }

       
        $orders = DB::table('orders')
            ->select('orders.*')
            ->where('orders.customer_id', $customerId)
            ->whereIn('orders.status', ['pending', 'diproses'])
            ->orderByDesc('orders.created_at')
            ->get();

      
        $groupedOrders = $orders->map(function($order) {
            $items = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->select(
                    'order_items.*',
                    'products.nama_produk',
                    'products.gambar',
                    DB::raw('order_items.qty * order_items.harga as total_harga')
                )
                ->where('order_items.order_id', $order->id)
                ->get();

            $order->items = $items;
            $order->total_items = $items->sum('qty');
            $order->grand_total = $items->sum('total_harga');
            
            return $order;
        });

        return view('order.index', compact('groupedOrders'));
    }

    
    public function receipt($id)
    {
        $customerId = Auth::guard('customer')->id();
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('customer_id', $customerId)
            ->first();

        if (!$order) {
            abort(404, 'Order tidak ditemukan');
        }

        
        $orderItems = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'order_items.*',
                'products.nama_produk',
                'products.gambar',
                DB::raw('order_items.qty * order_items.harga as total_harga')
            )
            ->where('order_items.order_id', $id)
            ->get();

        $grandTotal = $orderItems->sum('total_harga');
        $totalItems = $orderItems->sum('qty');

        return Pdf::view('order.receipt', compact('order', 'orderItems', 'grandTotal', 'totalItems'))
            ->format('A5')
            ->name('receipt-order-' . $order->id . '.pdf');
    }
}