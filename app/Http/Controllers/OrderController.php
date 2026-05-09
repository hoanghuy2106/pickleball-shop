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
        // Load quan hệ orderItems và product để lấy tên/ảnh sản phẩm
        $order = Order::with(['orderItems.product'])->find($id);

        if (!$order) {
            return response()->json([
                'success' => false, 
                'message' => 'Không tìm thấy dữ liệu vận đơn.'
            ], 404);
        }

        // Dữ liệu trả về bao gồm receiver_name, phone, address (mặc định có trong table orders)
        return response()->json([
            'success' => true,
            'data' => $order->toArray() 
        ]);
    }

    /**
     * Cập nhật trạng thái đơn hàng (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            
            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Đơn hàng không tồn tại.']);
            }

            $currentStatus = trim($order->status);
            $nextStatus = $currentStatus;

            // Logic chuyển đổi trạng thái
            if ($currentStatus == 'pending') $nextStatus = 'confirmed';
            elseif ($currentStatus == 'confirmed') $nextStatus = 'shipping';
            elseif ($currentStatus == 'shipping') $nextStatus = 'completed';

            $order->status = (string)$nextStatus;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật trạng thái thành công!',
                'new_status' => $nextStatus
            ]);

        } catch (\Exception $e) {
            Log::error("Lỗi update đơn hàng: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống: ' . $e->getMessage()
            ], 500);
        }
    }
    public function cancel($id)
{
    try {
        $order = \App\Models\Order::findOrFail($id);

        // Kiểm tra quyền: Chỉ Admin hoặc chính chủ đơn hàng mới được hủy
        // Và chỉ được hủy khi đơn hàng đang ở trạng thái 'pending'
        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Không thể hủy đơn hàng đã được xử lý!'
            ]);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Đã hủy đơn hàng thành công.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi hệ thống: ' . $e->getMessage()
        ]);
    }
}
}