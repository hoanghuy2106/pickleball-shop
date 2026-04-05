<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm - SPORT Q&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .modal-active { display: flex !important; animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

        .premium-card {
            background: #111;
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-card:hover {
            border-color: rgba(249, 115, 22, 0.4);
            box-shadow: 0 20px 40px -20px rgba(249, 115, 22, 0.15);
        }

        .sidebar-scroll {
            max-height: calc(100vh - 120px);
            overflow-y: auto;
            padding-right: 12px;
        }

        .sidebar-scroll::-webkit-scrollbar { width: 3px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #ea580c; border-radius: 10px; }

        .price-range {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            outline: none;
        }
        .price-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background: #ea580c;
            border: 3px solid #0a0a0a;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(234, 88, 12, 0.5);
        }
    </style>
</head>
<body class="antialiased">

<div id="cart-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div onclick="closeCart()" class="absolute inset-0 bg-black/90 backdrop-blur-xl"></div>
    <div class="relative bg-[#181818] w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col border border-white/10">
        <div class="p-6 border-b border-white/5 flex justify-between items-center bg-white/5">
            <h2 class="text-xl font-black text-white italic uppercase tracking-tighter">Giỏ hàng của Huy 🛒</h2>
            <button onclick="closeCart()" class="text-gray-500 hover:text-orange-500 text-3xl transition">&times;</button>
        </div>
        <div class="p-8 space-y-4">
            <div class="flex gap-6 items-start border-b border-white/5 pb-6">
                <div class="w-24 h-24 bg-[#222] rounded-2xl overflow-hidden shrink-0 shadow-inner border border-white/5">
                    <img id="modal-img" src="" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h4 id="modal-name" class="font-bold text-white text-lg leading-tight italic uppercase">Tên sản phẩm</h4>
                    <p class="text-orange-500 font-bold text-[10px] mt-1 uppercase tracking-[0.2em]">Đã thêm thành công!</p>
                    <p id="modal-description" class="text-gray-500 text-xs mt-2 line-clamp-2 leading-relaxed italic">Thông tin...</p>
                    <p id="modal-price" class="mt-3 font-black text-2xl text-white tracking-tighter">0đ</p>
                </div>
            </div>
        </div>
        <div class="p-6 bg-[#181818] border-t border-white/5">
            <div class="grid grid-cols-2 gap-4">
                <button onclick="closeCart()" class="py-4 rounded-2xl font-black bg-[#222] text-gray-500 hover:bg-[#333] transition text-[10px] uppercase tracking-widest">Tiếp tục mua</button>
                <a href="{{ route('cart.index') }}" class="text-center py-4 rounded-2xl font-black bg-orange-600 text-white shadow-lg shadow-orange-900/20 hover:bg-orange-700 transition text-[10px] flex items-center justify-center uppercase tracking-widest">Xem giỏ hàng</a>
            </div>
        </div>
    </div>
</div>

<nav class="bg-black/80 backdrop-blur-md shadow-sm p-4 sticky top-0 z-50 border-b border-white/5">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
        <a href="{{ url('/') }}">
            <h1 class="text-2xl font-black text-orange-500 tracking-tighter uppercase italic">SPORT Q&A</h1>
        </a>
        
        <div class="flex items-center space-x-8 flex-1 justify-end">
            <div class="hidden md:flex space-x-8 font-bold text-xs uppercase tracking-widest">
                <a href="{{ url('/') }}" class="text-gray-400 hover:text-orange-500 transition">Trang chủ</a>
                <a href="{{ route('products.index') }}" class="text-orange-500 border-b-2 border-orange-500 pb-1">Cửa hàng</a>
            </div>

            <div onclick="openCart()" class="relative group cursor-pointer bg-white/5 p-2.5 rounded-xl border border-white/5 hover:bg-white/10 transition">
                <span class="text-xl">🛒</span>
                <span id="cart-count" class="absolute -top-1 -right-1 bg-orange-600 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full border-2 border-black">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </div>

            @auth
            <div class="flex items-center space-x-5 border-l pl-8 border-white/10">
                <a href="{{ route('products.create') }}" class="bg-orange-600 hover:bg-white text-white hover:text-black px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all italic shadow-lg shadow-orange-900/20">
                    + Thêm siêu phẩm
                </a>
                <a href="{{ route('profile') }}" class="group flex items-center gap-3">
                    <b class="text-white text-[10px] uppercase tracking-widest group-hover:text-orange-500 transition">{{ Auth::user()->name }}</b>
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto py-16 px-6">
    <div class="flex flex-col lg:flex-row gap-12">
        <aside class="w-full lg:w-64 shrink-0 sticky top-28 h-fit">
            <div class="sidebar-scroll">
                <form action="{{ route('products.index') }}" method="GET" id="filter-form">
                    <div>
                        <h2 class="text-4xl font-black text-white tracking-tighter uppercase italic mb-2">Bộ lọc</h2>
                        <p class="text-gray-600 text-[10px] font-bold uppercase tracking-widest italic border-b border-white/5 pb-4">SPORT Q&A</p>
                        @if(request()->anyFilled(['categories', 'brand', 'price_max']))
                            <a href="{{ route('products.index') }}" class="inline-block mt-2 text-[9px] text-orange-500 font-black uppercase hover:underline">× Xóa tất cả</a>
                        @endif
                    </div>

                    <div class="space-y-4 mt-8">
                        <h3 class="text-white font-black text-[10px] uppercase tracking-[0.3em] border-l-2 border-orange-500 pl-3">Danh mục</h3>
                        <div class="flex flex-col gap-1">
                            @foreach(['Vợt Pickleball', 'Giày thi đấu', 'Balo & Túi', 'Bóng & Phụ kiện', 'Áo khoác Sport', 'Phụ kiện tập'] as $cat)
                            <label class="group flex items-center justify-between cursor-pointer p-3 rounded-2xl hover:bg-white/5 transition-all {{ in_array($cat, (array)request('categories')) ? 'bg-white/10' : '' }}">
                                <span class="font-bold text-xs transition uppercase italic {{ in_array($cat, (array)request('categories')) ? 'text-orange-500' : 'text-gray-500 group-hover:text-white' }}">{{ $cat }}</span>
                                <input type="checkbox" name="categories[]" value="{{ $cat }}" class="accent-orange-500 w-4 h-4" onchange="this.form.submit()" {{ in_array($cat, (array)request('categories')) ? 'checked' : '' }}>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-4 mt-8">
                        <h3 class="text-white font-black text-[10px] uppercase tracking-[0.3em] border-l-2 border-orange-500 pl-3">Thương hiệu</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(['Joola', 'Highpick', 'CRBN', 'facolos', 'BombaX', 'Engage', 'Selkirk', 'Franklin'] as $brand)
                                @php $isSelected = request('brand') == $brand; @endphp
                                <button type="button" 
                                    onclick="toggleBrand('{{ $brand }}')"
                                    class="py-2.5 rounded-xl border text-[9px] font-black uppercase transition-all {{ $isSelected ? 'border-orange-500 text-white bg-orange-500/20 shadow-[0_0_15px_rgba(249,115,22,0.2)]' : 'bg-white/5 border-white/5 text-gray-500 hover:border-orange-500/50 hover:text-white' }}">
                                    {{ $brand }}
                                </button>
                            @endforeach
                            <input type="hidden" name="brand" id="brand-input-hidden" value="{{ request('brand') }}">
                        </div>
                    </div>

                    <div class="mt-10 p-6 rounded-[2rem] bg-white/[0.03] border border-white/5 space-y-6 mb-10">
                        <h3 class="text-white font-black text-[10px] uppercase tracking-[0.3em] border-l-2 border-orange-500 pl-3">Ngân sách</h3>
                        <div class="space-y-4">
                            <input type="range" name="price_max" id="price-slider" min="0" max="10000000" step="500000" 
                                   value="{{ request('price_max', 10000000) }}" 
                                   class="price-range"
                                   oninput="updatePrice(this.value)"
                                   onchange="this.form.submit()">
                            <div class="flex flex-col">
                                <span class="text-[8px] font-black text-gray-600 uppercase italic">Tối đa</span>
                                <div class="flex items-baseline gap-1">
                                    <span id="price-display" class="text-2xl font-black text-white tracking-tighter italic">{{ number_format(request('price_max', 10000000)) }}</span>
                                    <span class="text-[10px] text-orange-500 font-bold uppercase">đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </aside>

        <main class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($products as $product)
                    @php 
                        $imagePath = $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300';
                        $safeDesc = str_replace(["\r", "\n", "'"], ["", "", "\\'"], $product->description ?? 'Premium Sport Gear.');
                    @endphp
                    <div class="premium-card p-3.5 rounded-[1.8rem] group flex flex-col relative overflow-hidden">
                        <a href="{{ route('products.show', $product->id) }}" class="block mb-3">
                            <div class="h-44 bg-[#1a1a1a] rounded-[1.4rem] flex items-center justify-center overflow-hidden relative">
                                <img src="{{ $imagePath }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-700 opacity-80 group-hover:opacity-100">
                                <span class="absolute top-3 right-3 bg-orange-600 px-2 py-0.5 rounded-lg text-[8px] font-black uppercase text-white border border-white/10 shadow-lg">{{ $product->brand }}</span>
                            </div>
                            
                            <div class="mt-3 px-1">
                                <div class="flex justify-between items-start gap-2 mb-1">
                                    <h3 class="font-black text-sm text-white group-hover:text-orange-500 transition italic uppercase tracking-tighter truncate flex-1">
                                        {{ $product->name }}
                                    </h3>
                                    
                                    @if($product->color)
                                    <span class="shrink-0 bg-white/5 border border-white/10 px-2 py-0.5 rounded-md text-[8px] font-bold text-gray-500 uppercase tracking-widest italic group-hover:text-orange-500 transition">
                                        {{ $product->color }}
                                    </span>
                                    @endif
                                </div>

                                <p class="text-gray-600 text-[10px] line-clamp-2 italic leading-relaxed mb-4 h-8">{{ $product->description }}</p>
                                <p class="text-white font-black text-lg tracking-tighter italic">{{ number_format($product->price) }}<span class="text-[10px] text-gray-600 ml-1 italic uppercase">đ</span></p>
                            </div>
                        </a>
                        
                        <div class="px-1 pb-2">
                            @auth
                            <div class="flex gap-1.5 mb-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="flex-1 text-center bg-[#222] text-gray-500 py-2 rounded-xl text-[8px] font-black uppercase hover:bg-orange-600 hover:text-white transition-all border border-white/5">Sửa</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Xóa siêu phẩm này?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full bg-[#222] text-gray-700 py-2 rounded-xl text-[8px] font-black uppercase hover:bg-red-600 hover:text-white transition-all border border-white/5">Xóa</button>
                                </form>
                            </div>
                            @endauth

                            <div class="flex gap-2">
                                <button onclick="addToCart('{{ addslashes($product->name) }}', '{{ addslashes($product->brand) }}', '{{ number_format($product->price) }}đ', '{{ $imagePath }}', '{{ $safeDesc }}')" 
                                        class="w-[30%] bg-[#222] text-gray-400 py-3.5 rounded-2xl flex items-center justify-center hover:bg-orange-600 hover:text-white transition-all border border-white/5 active:scale-95">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                                <button onclick="buyNow('{{ addslashes($product->name) }}', '{{ addslashes($product->brand) }}', '{{ number_format($product->price) }}đ', '{{ $imagePath }}', '{{ $safeDesc }}')" 
                                        class="w-[70%] bg-orange-600 text-white py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest italic hover:bg-white hover:text-black transition-all active:scale-95 shadow-lg shadow-orange-900/20">MUA NGAY</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center border-2 border-dashed border-white/5 rounded-[3.5rem] text-gray-600 font-black uppercase italic tracking-widest">Huy chưa cập nhật hàng mới...</div>
                @endforelse
            </div>
        </main>
    </div>
</div>

<footer class="bg-black py-16 border-t border-white/5 text-center mt-32">
    <p class="text-gray-800 text-[9px] font-bold uppercase tracking-widest">&copy; 2026 Developed by <span class="text-orange-600 font-black">Huy Tiến</span>.</p>
</footer>

<script>
    const cartModal = document.getElementById('cart-modal');
    function openCart() { cartModal.classList.add('modal-active'); document.body.style.overflow = 'hidden'; }
    function closeCart() { cartModal.classList.remove('modal-active'); document.body.style.overflow = 'auto'; }

    function updatePrice(val) {
        document.getElementById('price-display').innerText = new Intl.NumberFormat('vi-VN').format(val);
    }

    function toggleBrand(brandName) {
        const brandInput = document.getElementById('brand-input-hidden');
        const filterForm = document.getElementById('filter-form');
        
        if (brandInput.value === brandName) {
            brandInput.value = ''; 
        } else {
            brandInput.value = brandName; 
        }
        filterForm.submit();
    }

    function addToCart(name, brand, price, image, description) {
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ name, brand, price, image })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('cart-count').innerText = data.count;
            document.getElementById('modal-name').innerText = name;
            document.getElementById('modal-img').src = image;
            document.getElementById('modal-price').innerText = price;
            document.getElementById('modal-description').innerText = description.replace(/\\'/g, "'");
            openCart();
        }).catch(err => console.error("Lỗi:", err));
    }

    function buyNow(name, brand, price, image, description) {
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ name, brand, price, image })
        }).then(res => { if(res.ok) window.location.href = "{{ route('cart.index') }}"; });
    }
</script>
</body>
</html>