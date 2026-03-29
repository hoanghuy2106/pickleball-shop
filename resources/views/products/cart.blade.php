<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng cao cấp - Pickleball Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .item-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="bg-[#F8F9FB] text-[#1A1C1E]">

<div class="max-w-6xl mx-auto py-16 px-6">
    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-orange-600 transition-all mb-12 group">
        <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center group-hover:bg-orange-50 group-hover:text-orange-600 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
            </svg>
        </div>
        TIẾP TỤC MUA SẮM
    </a>

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
            <h2 class="text-5xl font-extrabold tracking-tighter mb-2">
                Giỏ hàng <span class="text-orange-500">.</span>
            </h2>
            <p class="text-gray-400 font-medium">Bạn có <span class="text-[#1A1C1E] font-bold">{{ count($cart) }}</span> sản phẩm trong danh sách chọn lọc</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="h-1.5 w-12 rounded-full bg-orange-500"></div>
            <div class="h-1.5 w-8 rounded-full bg-gray-200"></div>
            <div class="h-1.5 w-8 rounded-full bg-gray-200"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <div class="lg:col-span-8 space-y-6">
            @php $total = 0; @endphp
            @forelse($cart as $item)
                @php 
                    // Chuyển đổi giá từ chuỗi "5,900,000đ" sang số để tính toán
                    $priceNumeric = (int) str_replace([',', '.', 'đ'], '', $item['price']);
                    $total += $priceNumeric;
                @endphp
                <div class="bg-white p-6 rounded-[2.5rem] item-hover transition-all duration-500 border border-gray-50 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-orange-50/30 rounded-full blur-3xl"></div>

                    <div class="w-40 h-40 bg-[#F3F4F6] rounded-[2rem] overflow-hidden shrink-0 group">
                        <img src="{{ $item['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    
                    <div class="flex-1 w-full z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500 bg-orange-50 px-3 py-1 rounded-full">{{ $item['brand'] }}</span>
                                <h3 class="font-bold text-2xl text-[#1A1C1E] mt-2">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-400 font-medium">Phiên bản giới hạn • Professional Gear</p>
                            </div>
                            <button class="w-10 h-10 rounded-full flex items-center justify-center text-gray-300 hover:bg-red-50 hover:text-red-500 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center bg-[#F3F4F6] rounded-2xl p-1.5">
                                    <button class="w-8 h-8 flex items-center justify-center bg-white rounded-xl shadow-sm text-sm font-bold hover:bg-orange-500 hover:text-white transition-all">-</button>
                                    <span class="px-5 text-sm font-black text-[#1A1C1E]">01</span>
                                    <button class="w-8 h-8 flex items-center justify-center bg-white rounded-xl shadow-sm text-sm font-bold hover:bg-orange-500 hover:text-white transition-all">+</button>
                                </div>
                            </div>
                            <p class="text-[#1A1C1E] font-black text-2xl tracking-tighter">{{ $item['price'] }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-20 rounded-[2.5rem] text-center border border-dashed border-gray-200">
                    <span class="text-6xl block mb-6">📦</span>
                    <p class="text-gray-400 font-bold text-xl">Giỏ hàng của Huy đang trống!</p>
                    <a href="{{ route('products.index') }}" class="mt-6 inline-block bg-orange-500 text-white px-8 py-3 rounded-2xl font-bold hover:bg-orange-600 transition-all">Tiếp tục mua sắm</a>
                </div>
            @endforelse

            <div class="bg-gray-900 rounded-[2.5rem] p-8 relative overflow-hidden group">
                <div class="absolute right-0 top-0 h-full w-1/3 bg-orange-500 skew-x-12 translate-x-12 group-hover:translate-x-8 transition-transform duration-700"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 text-white">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-2xl">⚡</div>
                        <div>
                            <p class="font-bold text-lg">Mã giảm giá độc quyền</p>
                            <p class="text-white/50 text-xs">Ưu đãi dành riêng cho thành viên Pickleball Master</p>
                        </div>
                    </div>
                    <div class="flex w-full md:w-auto bg-white/10 backdrop-blur-md p-1.5 rounded-2xl border border-white/10">
                        <input type="text" placeholder="Nhập mã tại đây..." class="bg-transparent px-4 py-2 w-full md:w-40 focus:outline-none text-sm font-medium placeholder:text-white/30 text-white">
                        <button class="bg-white text-gray-900 px-6 py-2 rounded-1.5xl font-black text-xs uppercase hover:bg-orange-500 hover:text-white transition-all">Áp dụng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4">
            <div class="bg-white p-10 rounded-[3rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] border border-gray-50 sticky top-12">
                <h3 class="text-2xl font-black text-[#1A1C1E] mb-10 tracking-tight flex items-center gap-2">
                    Hóa đơn
                    <div class="h-1 flex-1 bg-gray-50 rounded-full"></div>
                </h3>
                
                <div class="space-y-6 mb-10">
                    <div class="flex justify-between text-gray-400 font-bold text-xs uppercase tracking-widest">
                        <span>Giá niêm yết</span>
                        <span class="text-[#1A1C1E]">{{ number_format($total ?? 0) }}đ</span>
                    </div>
                    <div class="flex justify-between text-gray-400 font-bold text-xs uppercase tracking-widest">
                        <span>Vận chuyển</span>
                        <span class="text-green-500">Free</span>
                    </div>
                    <div class="flex justify-between text-gray-400 font-bold text-xs uppercase tracking-widest">
                        <span>Bảo hiểm vợt</span>
                        <span class="text-[#1A1C1E]">Miễn phí</span>
                    </div>
                    
                    <div class="pt-8 border-t border-gray-100 flex justify-between items-end">
                        <span class="font-black text-gray-400 text-xs uppercase tracking-[0.2em] mb-2">Thành tiền</span>
                        <div class="text-right">
                            <p class="text-4xl font-black text-orange-600 tracking-tighter">{{ number_format($total ?? 0) }}đ</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest text-center mb-4">Chọn phương thức thanh toán</p>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <label class="cursor-pointer group">
                            <input type="radio" name="pay" class="hidden peer" checked>
                            <div class="border-2 border-gray-50 bg-gray-50 peer-checked:border-orange-500 peer-checked:bg-white p-4 rounded-3xl text-center transition-all group-hover:border-orange-200">
                                <span class="block text-2xl mb-1">🏦</span>
                                <span class="text-[10px] font-black text-gray-400 peer-checked:text-gray-900 uppercase">Chuyển khoản</span>
                            </div>
                        </label>
                        <label class="cursor-pointer group">
                            <input type="radio" name="pay" class="hidden peer">
                            <div class="border-2 border-gray-50 bg-gray-50 peer-checked:border-orange-500 peer-checked:bg-white p-4 rounded-3xl text-center transition-all group-hover:border-orange-200">
                                <span class="block text-2xl mb-1">🚚</span>
                                <span class="text-[10px] font-black text-gray-400 peer-checked:text-gray-900 uppercase">Tiền mặt</span>
                            </div>
                        </label>
                    </div>

                    <button class="w-full bg-orange-600 text-white py-6 rounded-[2rem] font-black shadow-[0_20px_40px_-10px_rgba(234,88,12,0.3)] hover:bg-orange-700 hover:scale-[1.02] transition-all active:scale-95 uppercase tracking-[0.15em] text-sm">
                        Xác nhận đặt hàng ngay
                    </button>
                </div>

                <div class="mt-8 flex justify-center gap-4 grayscale opacity-30">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6">
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>