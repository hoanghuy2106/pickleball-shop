<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Lấy chi tiết đơn hàng cho Modal
     */
    public function getDetails($id)
    {
        // FIX: Trong JS bạn đang dùng 'order_items', nên ở đây ta load đúng quan hệ đó
        // Đảm bảo trong Model Order bạn đã định nghĩa public function order_items()
        $order = Order::with(['orderItems.product'])->find($id);

        if (!$order) {
            return response()->json([
                'success' => false, 
                'message' => 'Không tìm thấy dữ liệu vận đơn.'
            ], 404);
        }

        // Ép dữ liệu về Array để đảm bảo JS nhận diện đúng các trường underscore (order_items)
        return response()->json([
            'success' => true,
            'data' => $order->toArray() 
        ]);
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            
            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Đơn hàng không tồn tại.']);
            }

            $currentStatus = trim($order->status); // Khử khoảng trắng để tránh lỗi SQL
            $nextStatus = $currentStatus;

            if ($currentStatus == 'pending') $nextStatus = 'confirmed';
            elseif ($currentStatus == 'confirmed') $nextStatus = 'shipping';
            elseif ($currentStatus == 'shipping') $nextStatus = 'completed';

            // FIX LỖI 1265: Ép kiểu dữ liệu và lưu
            $order->status = (string)$nextStatus;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật trạng thái thành công!',
                'new_status' => $nextStatus
            ]);

        } catch (\Exception $e) {
            // Log lỗi ra file storage/logs/laravel.log để bạn kiểm tra nếu vẫn lỗi SQL
            Log::error("Lỗi update đơn hàng: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống: ' . $e->getMessage()
            ], 500);
        }
    }
}