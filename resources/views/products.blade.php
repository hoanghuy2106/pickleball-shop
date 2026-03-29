<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm - Pickleball Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        .modal-active {
            display: flex !important;
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body class="bg-[#F8F9FB] text-[#1A1C1E]">

<div id="cart-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div onclick="closeCart()" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    
    <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col">
        <div class="p-6 border-b flex justify-between items-center bg-gray-50">
            <h2 class="text-xl font-black text-gray-800">Giỏ hàng của bạn 🛒</h2>
            <button onclick="closeCart()" class="text-gray-400 hover:text-red-500 text-3xl transition">&times;</button>
        </div>

        <div class="p-8 space-y-4">
            <div class="flex gap-6 items-start border-b pb-6">
                <div class="w-24 h-24 bg-gray-100 rounded-2xl overflow-hidden shrink-0 shadow-inner">
                    <img id="modal-img" src="" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h4 id="modal-name" class="font-bold text-gray-900 text-lg leading-tight">Sản phẩm vừa thêm</h4>
                    <p id="modal-brand" class="text-orange-600 font-bold text-sm mt-1 uppercase tracking-widest">Đã thêm thành công!</p>
                    
                    <p id="modal-description" class="text-gray-500 text-xs mt-2 line-clamp-2 leading-relaxed italic">Thông tin chi tiết...</p>
                    
                    <p id="modal-price" class="mt-3 font-black text-xl text-gray-900">0đ</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border-t">
            <div class="grid grid-cols-2 gap-4">
                <button onclick="closeCart()" class="py-4 rounded-2xl font-bold bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm">TIẾP TỤC MUA</button>
                <a href="{{ route('cart.index') }}" class="text-center py-4 rounded-2xl font-bold bg-orange-500 text-white shadow-lg hover:bg-orange-600 transition text-sm flex items-center justify-center uppercase tracking-wider">XEM GIỎ HÀNG</a>
            </div>
        </div>
    </div>
</div>

<nav class="bg-white shadow-sm p-4 sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
        <a href="{{ url('/') }}">
            <h1 class="text-2xl font-extrabold text-orange-600 tracking-tighter">PICKLEBALL MASTER<span class="text-gray-900">.</span></h1>
        </a>
        
        <div class="flex items-center space-x-8">
            <div class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" class="hover:text-orange-500 font-bold text-sm transition uppercase">Trang chủ</a>
                <a href="{{ route('products.index') }}" class="text-orange-500 font-bold text-sm transition uppercase">Cửa hàng</a>
            </div>

            <div onclick="openCart()" class="relative group cursor-pointer">
                <div class="flex items-center p-2 bg-gray-50 rounded-xl group-hover:bg-orange-50 transition-colors">
                    <span class="text-xl">🛒</span>
                    <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full border-2 border-white">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </div>
            </div>

            @auth
                <div class="flex items-center space-x-4 border-l pl-6 border-gray-200">
                    <span class="text-gray-400 text-xs font-bold uppercase">Admin: <b class="text-gray-900">{{ Auth::user()->name }}</b></span>
                    <a href="{{ route('products.create') }}" class="bg-black text-white px-4 py-2 rounded-xl text-xs font-black hover:bg-orange-600 transition shadow-sm uppercase">+ Thêm mới</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 text-xs font-bold hover:text-red-500 transition uppercase">Thoát</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-orange-500 text-white px-6 py-2 rounded-xl shadow-lg hover:bg-orange-600 transition font-bold text-sm">ĐĂNG NHẬP</a>
            @endauth
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto py-16 px-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
        <div>
            <h2 class="text-4xl font-black text-gray-900 tracking-tighter">Tất cả sản phẩm <span class="text-orange-500">.</span></h2>
            <p class="text-gray-400 font-medium mt-2">Khám phá bộ sưu tập thiết bị Pickleball chuyên nghiệp nhất.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
            <div class="bg-white p-5 rounded-[2.5rem] shadow-[0_10px_30px_-15px_rgba(0,0,0,0.05)] hover:shadow-2xl transition-all duration-500 group border border-transparent hover:border-orange-100 flex flex-col relative overflow-hidden">
                
                <div class="h-64 bg-[#F3F4F6] rounded-[2rem] mb-5 flex items-center justify-center overflow-hidden relative group-hover:bg-orange-50 transition-colors duration-500">
                    @php 
                        $imagePath = $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300';
                        $description = str_replace(["\r", "\n", "'"], ["", "", "\\'"], $product->description ?? 'Sản phẩm Pickleball chất lượng cao.');
                    @endphp

                    <img src="{{ $imagePath }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-700">

                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black uppercase text-gray-700 shadow-sm">
                        {{ $product->brand }}
                    </span>
                </div>

                <div class="flex-1 px-2">
                    <h3 class="font-bold text-xl text-gray-800 group-hover:text-orange-600 transition mb-1 leading-tight">
                        {{ $product->name }}
                    </h3>

                    <p class="text-gray-400 text-xs mb-4 line-clamp-2 italic leading-relaxed">
                        {{ $product->description ?? 'Chưa có mô tả chi tiết cho sản phẩm này.' }}
                    </p>

                    <p class="text-[#1A1C1E] font-black text-2xl mb-6 tracking-tighter">{{ number_format($product->price) }} <span class="text-sm underline">đ</span></p>
                </div>

                <div class="flex flex-col gap-2 mt-auto px-2 pb-2">
                    @auth
                    <div class="flex gap-2 mb-2">
                        <a href="{{ route('products.edit', $product->id) }}" 
                           class="flex-1 text-center bg-gray-50 text-gray-500 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-orange-50 hover:text-orange-600 transition-all border border-gray-100">
                           Sửa sản phẩm
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1"
                              onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-gray-50 text-gray-400 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-red-50 hover:text-red-500 transition-all border border-gray-100">
                                Xóa
                            </button>
                        </form>
                    </div>
                    @endauth

                    <div class="flex gap-2">
                        <button onclick="addToCart('{{ $product->name }}', '{{ $product->brand }}', '{{ number_format($product->price) }}đ', '{{ $imagePath }}', '{{ $description }}')" 
                                class="flex-1 bg-gray-100 text-gray-800 py-4 rounded-2xl font-bold hover:bg-gray-900 hover:text-white transition-all flex justify-center items-center gap-2 group/cart">
                            <span class="text-xl group-hover/cart:rotate-12 transition-transform">🛒</span>
                        </button>
                        <button class="flex-[3] bg-orange-500 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-orange-600 transition-all active:scale-95 shadow-lg shadow-orange-200">
                            Mua ngay
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <span class="text-6xl block mb-4">📦</span>
                <p class="text-gray-400 text-xl font-bold">Chưa có sản phẩm nào được đăng tải...</p>
            </div>
        @endforelse
    </div>
</div>

<footer class="bg-white mt-20 py-12 border-t border-gray-100">
    <div class="text-center">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">&copy; 2026 <span class="text-orange-600">Pickleball Master</span>. All Rights Reserved.</p>
    </div>
</footer>

<script>
    const cartModal = document.getElementById('cart-modal');

    function openCart() {
        cartModal.classList.add('modal-active');
        document.body.style.overflow = 'hidden';
    }

    function closeCart() {
        cartModal.classList.remove('modal-active');
        document.body.style.overflow = 'auto';
    }

    function addToCart(name, brand, price, image, description) {
        document.getElementById('modal-name').innerText = name;
        document.getElementById('modal-brand').innerText = brand + " - Đã thêm thành công!";
        document.getElementById('modal-price').innerText = price;
        document.getElementById('modal-description').innerText = description; 
        
        const modalImg = document.getElementById('modal-img');
        modalImg.src = image;

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                name: name, 
                brand: brand, 
                price: price, 
                image: image 
            })
        })
        .then(res => {
            if (!res.ok) throw new Error('Lỗi server');
            return res.json();
        })
        .then(data => {
            document.getElementById('cart-count').innerText = data.count;
            openCart(); 
        })
        .catch(error => {
            console.error('Lỗi khi thêm vào giỏ hàng:', error);
            alert('Có lỗi xảy ra, Huy vui lòng thử lại!');
        });
    }
</script>

</body>
</html>