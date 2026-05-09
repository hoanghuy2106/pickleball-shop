<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::post('/casso-webhook', function (Request $request) {
    $data = $request->json()->all();
    if (isset($data['data']) && is_array($data['data'])) {
        foreach ($data['data'] as $transaction) {
            $description = $transaction['description'];
            if (preg_match('/SQA\d+/', $description, $matches)) {
                $orderCode = $matches[0];
                Cache::put("payment_status_$orderCode", 'paid', 600);
            }
        }
    }
    return response()->json(['error' => 0, 'message' => 'Ok']);
});
// File: routes/api.php
Route::get('/check-payment/{orderCode}', function ($orderCode) {
    $status = Cache::get("payment_status_$orderCode", 'pending');
    return response()->json(['status' => $status]);
});