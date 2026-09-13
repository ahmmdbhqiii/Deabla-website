<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private function getStoragePath() {
        return 'admin_stock.json';
    }

    private function getOrderStoragePath() {
        return 'admin_orders.json';
    }

    private function getDefaultProducts() {
        return [
            [
                'id' => 1,
                'name' => 'DEABLA Zip Hoodie - Love Bombing',
                'price' => 350000,
                'stock' => 12,
                'category' => 'Heavyweight Hoodie',
                'image' => 'Love Bombing.png'
            ]
        ];
    }

    public function showLogin() {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'jekih' && $password === 'deabla') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout() {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }

    public function index() {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $productPath = $this->getStoragePath();
        if (!Storage::exists($productPath)) {
            Storage::put($productPath, json_encode($this->getDefaultProducts(), JSON_PRETTY_PRINT));
        }
        $products = json_decode(Storage::get($productPath), true);

        $orderPath = $this->getOrderStoragePath();
        $orders = [];
        if (Storage::exists($orderPath)) {
            $orders = json_decode(Storage::get($orderPath), true) ?? [];
        }

        // --- HITUNG CASH FLOW OTOMATIS DARI JSON ORDER ---
        $totalPemasukan = 0;
        $totalPending = 0;
        
        foreach ($orders as $order) {
            $status = strtolower($order['status'] ?? '');
            $price = isset($order['price']) ? (int)$order['price'] : 350000;

            if ($status === 'success' || $status === 'completed' || $status === 'selesai' || $status === 'kirim') {
                $totalPemasukan += $price;
            } elseif ($status === 'pending') {
                $totalPending += $price;
            }
        }

        // Data siap lempar ke Chart Bulat Dashboard Admin
        $chartData = [
            'labels' => ['Pemasukan (Sukses)', 'Pending / Belum Lunas'],
            'data' => [$totalPemasukan, $totalPending]
        ];

        return view('admin.index', compact('products', 'orders', 'totalPemasukan', 'totalPending', 'chartData'));
    }

    public function storeOrder(Request $request) {
        $orderPath = $this->getOrderStoragePath();
        $orders = [];

        if (Storage::exists($orderPath)) {
            $orders = json_decode(Storage::get($orderPath), true) ?? [];
        }

        $newOrder = [
            'order_id' => $request->input('order_id'),
            'date' => now()->format('d M Y | H:i'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'product' => $request->input('product'),
            'price' => (int) $request->input('price', 350000),
            'size' => $request->input('size'),
            'address' => $request->input('address'),
            'payment_method' => $request->input('payment_method'),
            'status' => 'Pending'
        ];

        array_unshift($orders, $newOrder);
        Storage::put($orderPath, json_encode($orders, JSON_PRETTY_PRINT));

        return response()->json(['success' => true, 'message' => 'Order berhasil disimpan!']);
    }

    public function storeProduct(Request $request) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $path = $this->getStoragePath();
        $products = json_decode(Storage::get($path), true) ?? [];

        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $imageName);

        $newId = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;

        $newProduct = [
            'id' => $newId,
            'name' => $request->input('name'),
            'price' => (int) $request->input('price'),
            'stock' => (int) $request->input('stock'),
            'category' => $request->input('category'),
            'image' => $imageName
        ];

        $products[] = $newProduct;
        Storage::put($path, json_encode($products, JSON_PRETTY_PRINT));

        return redirect()->route('admin.dashboard')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    public function deleteProduct($id) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $path = $this->getStoragePath();
        $products = json_decode(Storage::get($path), true) ?? [];

        $products = array_filter($products, function($product) use ($id) {
            return $product['id'] != $id;
        });

        Storage::put($path, json_encode(array_values($products), JSON_PRETTY_PRINT));

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus!');
    }

    public function updateStock(Request $request, $id) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $path = $this->getStoragePath();
        $products = json_decode(Storage::get($path), true);

        foreach ($products as &$product) {
            if ($product['id'] == $id) {
                $action = $request->input('action'); 
                $amount = (int) $request->input('amount', 1);

                if ($action === 'add') {
                    $product['stock'] += $amount;
                } elseif ($action === 'reduce') {
                    $product['stock'] = max(0, $product['stock'] - $amount);
                }
                break;
            }
        }

        Storage::put($path, json_encode($products, JSON_PRETTY_PRINT));

        return redirect()->route('admin.dashboard')->with('success', 'Stok produk berhasil diperbarui!');
    }

    public function updateOrderStatus(Request $request, $orderId) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $orderPath = $this->getOrderStoragePath();

        if (Storage::exists($orderPath)) {
            $orders = json_decode(Storage::get($orderPath), true) ?? [];

            foreach ($orders as &$order) {
                if (trim($order['order_id'] ?? '') === trim($orderId)) {
                    $order['status'] = $request->input('status');
                    break;
                }
            }

            Storage::put($orderPath, json_encode($orders, JSON_PRETTY_PRINT));
        }

        return back()->with('success', 'Status pesanan ' . $orderId . ' berhasil diperbarui.');
    }

    public function deleteOrder($orderId) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $orderPath = $this->getOrderStoragePath();
        
        if (Storage::exists($orderPath)) {
            $orders = json_decode(Storage::get($orderPath), true) ?? [];

            $filteredOrders = array_values(array_filter($orders, function($order) use ($orderId) {
                return trim($order['order_id'] ?? '') !== trim($orderId);
            }));

            Storage::put($orderPath, json_encode($filteredOrders, JSON_PRETTY_PRINT));
        }

        return back()->with('success', 'Riwayat pesanan ' . $orderId . ' berhasil dihapus.');
    }
}