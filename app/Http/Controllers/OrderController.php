<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    private function getOrderStoragePath() {
        return 'admin_orders.json';
    }

    // Simpan order baru dengan ID yang dijamin unik (mencegah duplikasi nota)
    public function store(Request $request) {
        $path = $this->getOrderStoragePath();
        $orders = [];

        if (Storage::exists($path)) {
            $orders = json_decode(Storage::get($path), true) ?? [];
        }

        // Buat ID unik berbasis timestamp + angka acak agar tidak pernah kembar
        $uniqueOrderId = 'DBL-' . date('ymd') . '-' . strtoupper(substr(uniqid(), -5));

        $newOrder = [
            'order_id' => $uniqueOrderId,
            'date' => now()->format('d M Y | H:i'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'product' => $request->input('product'),
            'size' => $request->input('size'),
            'address' => $request->input('address'),
            'payment_method' => $request->input('payment_method'),
            'status' => 'Pending'
        ];

        array_unshift($orders, $newOrder); // Masukkan ke urutan paling atas
        Storage::put($path, json_encode($orders, JSON_PRETTY_PRINT));

        return response()->json(['success' => true, 'order_id' => $uniqueOrderId, 'message' => 'Order berhasil disimpan!']);
    }

    // Update status pesanan di Admin Dashboard berdasarkan order_id yang spesifik
    public function updateStatus(Request $request, $orderId) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $path = $this->getOrderStoragePath();
        if (Storage::exists($path)) {
            $orders = json_decode(Storage::get($path), true) ?? [];

            foreach ($orders as &$order) {
                if (trim($order['order_id']) === trim($orderId)) {
                    $order['status'] = $request->input('status');
                    break;
                }
            }

            Storage::put($path, json_encode($orders, JSON_PRETTY_PRINT));
        }

        return back()->with('success', 'Status pesanan ' . $orderId . ' berhasil diperbarui!');
    }

    // Hapus data pesanan SECARA PRESISI (Hanya 1 baris yang dipilih yang terhapus)
    public function destroy($orderId) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $path = $this->getOrderStoragePath();
        if (Storage::exists($path)) {
            $orders = json_decode(Storage::get($path), true) ?? [];

            // Filter ketat: Hanya buang data yang order_id-nya benar-benar persis sama
            $filteredOrders = array_values(array_filter($orders, function($order) use ($orderId) {
                return trim($order['order_id'] ?? '') !== trim($orderId);
            }));

            Storage::put($path, json_encode($filteredOrders, JSON_PRETTY_PRINT));
        }

        return back()->with('success', 'Riwayat pesanan ' . $orderId . ' berhasil dihapus.');
    }
}