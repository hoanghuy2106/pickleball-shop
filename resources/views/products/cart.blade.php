<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng Elite - SPORT Q&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; overflow-x: hidden; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); }
        #grand-total { font-size: 48px; white-space: nowrap; display: inline-block; line-height: 1; letter-spacing: -0.05em; transition: all 0.2s; }
    </style>
</head>
<body class="antialiased">

<div class="max-w-[1440px] mx-auto py-16 px-8 md:px-16">
    
    <a href="{{ route('products.index') }}" class="relative z-10 inline-flex items-center gap-3 text-[10px] font-black tracking-[0.2em] text-gray-500 hover:text-orange-500 transition-all mb-10 group uppercase">
        <div class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-orange-600 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
            </svg>
        </div>
        Tiếp tục mua sắm
    </a>

    <div class="relative z-10 mb-10 text-right md:text-left">
        <h2 class="text-5xl md:text-7xl font-black tracking-tighter mb-4 text-white italic uppercase leading-none">
            Giỏ hàng <span class="text-orange-600"></span>
        </h2>
        <p class="text-gray-500 font-bold uppercase tracking-[0.3em] text-[10px]">
            Hệ thống đang điều phối <span id="cart-count" class="text-orange-500 underline decoration-2 underline-offset-4">{{ count($cart) }}</span> sản phẩm
        </p>
    </div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 space-y-4">
            @php $total = 0; @endphp
            @forelse($cart as $id => $item)
                @php 
                    $unitPrice = (int) str_replace([',', '.', 'đ'], '', $item['price'] ?? '0');
                    $itemTotal = $unitPrice * ($item['quantity'] ?? 1);
                    $total += $itemTotal;
                @endphp
                <div class="glass-card p-6 rounded-[2rem] flex items-center gap-6 cart-item" data-id="{{ $id }}" data-unit-price="{{ $unitPrice }}">
                    <div class="w-24 h-24 md:w-32 md:h-32 bg-black rounded-2xl overflow-hidden shrink-0 border border-white/5">
                        <img src="{{ $item['image'] ?? '' }}" class="w-full h-full object-cover opacity-80">
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between mb-2 md:mb-4">
                            <h3 class="font-black text-lg md:text-xl text-white italic uppercase truncate max-w-[150px] md:max-w-none">{{ $item['name'] }}</h3>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-red-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center bg-black/50 rounded-xl p-1 border border-white/5">
                                <button onclick="changeQty(this, -1)" class="w-8 h-8 text-white hover:bg-orange-600 rounded-lg">-</button>
                                <span class="qty-val px-4 text-xs font-black text-white italic">{{ $item['quantity'] < 10 ? '0'.$item['quantity'] : $item['quantity'] }}</span>
                                <button onclick="changeQty(this, 1)" class="w-8 h-8 text-white hover:bg-orange-600 rounded-lg">+</button>
                            </div>
                            <p class="item-total-price text-white font-black text-lg md:text-xl italic tracking-tighter">{{ number_format($itemTotal) }}đ</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="glass-card p-20 rounded-[3rem] text-center border-dashed border-white/10">
                    <p class="text-gray-500 font-black text-xl uppercase tracking-widest mb-6">Trống rỗng</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-orange-600 text-white px-8 py-3 rounded-xl font-black text-xs uppercase hover:bg-white hover:text-black transition-all">Khám phá ngay</a>
                </div>
            @endforelse
        </div>

        <div class="lg:col-span-4">
            <div class="glass-card p-8 rounded-[2.5rem] sticky top-10 border border-white/10 shadow-2xl">
                <h3 class="text-[10px] font-black text-gray-400 mb-8 uppercase tracking-widest border-b border-white/5 pb-4">Đơn hàng của bạn</h3>
                
                <div class="space-y-4 mb-10">
                    <div class="flex justify-between text-gray-500 font-bold text-[10px] uppercase">
                        <span>Tạm tính</span>
                        <span id="subtotal" class="text-white">{{ number_format($total) }}đ</span>
                    </div>
                    <div class="flex justify-between text-orange-500 font-black text-[10px] uppercase italic">
                        <span>Vận chuyển</span>
                        <span>MIỄN PHÍ</span>
                    </div>
                </div>

                <div class="mb-10">
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-4">Phương thức thanh toán</p>
                    <div class="grid grid-cols-1 gap-3">
                        <label class="cursor-pointer group relative">
                            <input type="radio" name="payment_method" value="transfer" class="peer hidden" checked>
                            <div class="p-4 rounded-2xl border border-white/5 bg-white/5 peer-checked:border-orange-600 peer-checked:bg-orange-600/10 transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-black uppercase text-gray-400 peer-checked:text-white group-hover:text-white transition-colors">Chuyển khoản</span>
                                    <div class="w-4 h-4 rounded-full border-2 border-white/10 peer-checked:border-orange-600 flex items-center justify-center">
                                        <div class="w-2 h-2 rounded-full bg-orange-600 opacity-0 peer-checked:opacity-100"></div>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer group relative">
                            <input type="radio" name="payment_method" value="cod" class="peer hidden">
                            <div class="p-4 rounded-2xl border border-white/5 bg-white/5 peer-checked:border-orange-600 peer-checked:bg-orange-600/10 transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-black uppercase text-gray-400 peer-checked:text-white group-hover:text-white transition-colors">Tiền mặt (COD)</span>
                                    <div class="w-4 h-4 rounded-full border-2 border-white/10 peer-checked:border-orange-600 flex items-center justify-center">
                                        <div class="w-2 h-2 rounded-full bg-orange-600 opacity-0 peer-checked:opacity-100"></div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="pt-6 border-t border-white/5 flex flex-col items-end mb-8">
                    <span class="font-black text-gray-500 text-[9px] uppercase mb-2">Tổng thanh toán</span>
                    <p id="grand-total" class="font-black text-orange-600 italic text-right leading-none tracking-tighter">{{ number_format($total) }}đ</p>
                </div>

                <button class="w-full bg-white text-black py-5 rounded-2xl font-black uppercase text-[10px] hover:bg-orange-600 hover:text-white transition-all transform active:scale-95 shadow-xl shadow-white/5">
                    Xác nhận đặt đơn →
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    async function changeQty(btn, delta) {
        const row = btn.closest('.cart-item');
        const id = row.getAttribute('data-id');
        const qtySpan = row.querySelector('.qty-val');
        const unitPrice = parseInt(row.getAttribute('data-unit-price'));
        const itemTotalPriceEl = row.querySelector('.item-total-price');

        let currentQty = parseInt(qtySpan.innerText);
        let newQty = currentQty + delta;
        if (newQty < 1) return;

        try {
            const response = await fetch("{{ route('cart.update') }}", {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id: id, quantity: newQty })
            });

            if (response.ok) {
                qtySpan.innerText = newQty < 10 ? '0' + newQty : newQty;
                itemTotalPriceEl.innerText = new Intl.NumberFormat('vi-VN').format(unitPrice * newQty) + 'đ';
                updateCartTotals();
            }
        } catch (error) {
            console.error("Lỗi cập nhật:", error);
        }
    }

    function updateCartTotals() {
        let grandTotal = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const up = parseInt(item.getAttribute('data-unit-price'));
            const q = parseInt(item.querySelector('.qty-val').innerText);
            grandTotal += up * q;
        });
        const formatted = new Intl.NumberFormat('vi-VN').format(grandTotal) + 'đ';
        document.getElementById('subtotal').innerText = formatted;
        document.getElementById('grand-total').innerText = formatted;
    }
</script>
</body>
</html>