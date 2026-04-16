<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng Elite - SPORT Q&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; overflow-x: hidden; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); }
        #grand-total { font-size: 48px; white-space: nowrap; display: inline-block; line-height: 1; letter-spacing: -0.05em; transition: all 0.2s; }
        input, textarea { outline: none !important; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        /* Tùy chỉnh thông báo cho tiệp với style tối của ông */
        .swal2-popup { border-radius: 2rem !important; background: #121212 !important; border: 1px solid rgba(255,255,255,0.1) !important; }
        .swal2-title, .swal2-html-container { font-family: 'Plus Jakarta Sans', sans-serif !important; }
    </style>
</head>
<body class="antialiased">

<div class="max-w-[1440px] mx-auto py-16 px-8 md:px-16">
    
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-xl mb-6 text-xs uppercase font-black">
            {{ session('error') }}
        </div>
    @endif

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
            Giỏ hàng <span class="text-orange-600">Elite</span>
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
                    $unitPrice = (int) preg_replace('/[^0-9]/', '', $item['price'] ?? '0');
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
                            <p class="item-total-price text-white font-black text-lg md:text-xl italic tracking-tighter" data-raw-total="{{ $itemTotal }}">
                                {{ number_format($itemTotal) }}đ
                            </p>
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
            <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="glass-card p-8 rounded-[2.5rem] sticky top-10 border border-white/10 shadow-2xl">
                    <h3 class="text-[10px] font-black text-gray-400 mb-6 uppercase tracking-widest border-b border-white/5 pb-4">Thông tin giao hàng</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div>
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Họ và tên</label>
                            <input type="text" id="receiver_name" name="receiver_name" value="{{ Auth::user()->name ?? '' }}" required
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs font-bold text-white focus:border-orange-600 transition-all outline-none">
                        </div>
                        <div>
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Số điện thoại</label>
                            <input type="text" id="order-phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" required placeholder="Nhập số điện thoại..."
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs font-bold text-white focus:border-orange-600 transition-all outline-none">
                        </div>
                        <div>
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Địa chỉ nhận hàng</label>
                            <textarea name="address" rows="2" required placeholder="Nhập địa chỉ giao hàng..."
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs font-bold text-white focus:border-orange-600 transition-all outline-none">{{ Auth::user()->address ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="mb-10">
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-4">Phương thức thanh toán</p>
                        <div class="grid grid-cols-1 gap-3">
                            <label class="cursor-pointer group relative">
                                <input type="radio" name="payment_method" value="transfer" class="peer hidden" checked>
                                <div class="p-4 rounded-2xl border border-white/5 bg-white/5 peer-checked:border-orange-600 peer-checked:bg-orange-600/10 transition-all duration-300">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-black uppercase text-gray-400 peer-checked:text-white group-hover:text-white transition-colors">Chuyển khoản QR</span>
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

                    @if(count($cart) > 0)
                        <button type="submit" class="w-full bg-white text-black py-5 rounded-2xl font-black uppercase text-[10px] hover:bg-orange-600 hover:text-white transition-all transform active:scale-95 shadow-xl shadow-white/5">
                            Tiến hành thanh toán →
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<div id="qr-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/95 backdrop-blur-xl p-4">
    <div class="glass-card p-8 rounded-[3rem] max-w-sm w-full border border-white/10 text-center relative shadow-2xl">
        <button type="button" onclick="closeQR()" class="absolute top-6 right-6 text-gray-500 hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h3 class="text-orange-600 font-black italic uppercase tracking-tighter text-2xl mb-1">Techcombank QR</h3>
        <p class="text-[9px] text-gray-500 uppercase font-bold mb-6 tracking-[0.2em]">Quét để thanh toán tự động</p>

        <div class="bg-white p-4 rounded-[2rem] mb-6 shadow-inner flex justify-center">
            <img id="qr-image" src="" alt="QR Code" class="w-full h-auto max-w-[220px]">
        </div>

        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 mb-6 text-left space-y-2">
            <div>
                <p class="text-[8px] text-gray-500 uppercase font-black mb-1">Số tiền</p>
                <p id="qr-amount-display" class="text-xl font-black text-white italic tracking-tighter">0đ</p>
            </div>
            <div>
                <p class="text-[8px] text-gray-500 uppercase font-black mb-1">Chủ tài khoản</p>
                <p id="qr-name-display" class="text-[11px] font-bold text-gray-300 uppercase">---</p>
            </div>
        </div>

        <button type="button" onclick="submitFinalForm()" class="w-full bg-orange-600 text-white py-4 rounded-xl font-black uppercase text-[10px] hover:bg-white hover:text-black transition-all shadow-lg shadow-orange-600/20">
            Tôi đã chuyển khoản xong →
        </button>
    </div>
</div>

<script>
    // --- 1. CẤU HÌNH ---
    const MY_BANK = {
        BANK_ID: "tcb",
        ACCOUNT_NO: "45200421062004",
        ACCOUNT_NAME: "HOANG TIEN HUY"
    };

    // --- 2. CẬP NHẬT GIỎ HÀNG ---
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
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ id: id, quantity: newQty })
            });

            if (response.ok) {
                const updatedTotal = unitPrice * newQty;
                qtySpan.innerText = newQty < 10 ? '0' + newQty : newQty;
                itemTotalPriceEl.innerText = new Intl.NumberFormat('vi-VN').format(updatedTotal) + 'đ';
                itemTotalPriceEl.setAttribute('data-raw-total', updatedTotal);
                updateCartTotals();
            }
        } catch (error) {
            console.error("Lỗi cập nhật:", error);
        }
    }

    function updateCartTotals() {
        let grandTotal = 0;
        document.querySelectorAll('.item-total-price').forEach(el => {
            grandTotal += parseInt(el.getAttribute('data-raw-total'));
        });
        const formatted = new Intl.NumberFormat('vi-VN').format(grandTotal) + 'đ';
        document.getElementById('grand-total').innerText = formatted;
    }

    // --- 3. XỬ LÝ THANH TOÁN & THÔNG BÁO ---
    const checkoutForm = document.getElementById('checkout-form');

    checkoutForm.onsubmit = function(e) {
        const method = document.querySelector('input[name="payment_method"]:checked').value;

        if (method === 'transfer') {
            e.preventDefault(); 
            showQR();
        } else {
            // Thanh toán COD - Hiện thông báo thành công luôn
            e.preventDefault();
            showSuccessAlert();
        }
    };

    function showQR() {
        const amountStr = document.getElementById('grand-total').innerText;
        const amount = amountStr.replace(/[^0-9]/g, ''); 
        const receiver = document.getElementById('receiver_name').value || "Khách hàng";
        const desc = `THANH TOAN SPORTQA ${receiver}`.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        const qrUrl = `https://img.vietqr.io/image/${MY_BANK.BANK_ID}-${MY_BANK.ACCOUNT_NO}-compact.png?amount=${amount}&addInfo=${encodeURIComponent(desc)}&accountName=${encodeURIComponent(MY_BANK.ACCOUNT_NAME)}`;

        document.getElementById('qr-image').src = qrUrl;
        document.getElementById('qr-amount-display').innerText = amountStr;
        document.getElementById('qr-name-display').innerText = MY_BANK.ACCOUNT_NAME;
        document.getElementById('qr-modal').classList.remove('hidden');
    }

    function closeQR() {
        document.getElementById('qr-modal').classList.add('hidden');
    }

    function showSuccessAlert() {
        Swal.fire({
            title: 'MUA HÀNG THÀNH CÔNG!',
            text: 'Đơn hàng của ông đang được hệ thống Elite điều phối.',
            icon: 'success',
            background: '#0a0a0a',
            color: '#fff',
            confirmButtonColor: '#ea580c',
            confirmButtonText: 'TUYỆT VỜI',
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            checkoutForm.submit(); 
        });
    }

    function submitFinalForm() {
        closeQR();
        showSuccessAlert();
    }
</script>
</body>
</html>