<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - SPORTQ&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0a0a0a; color: #eee; }
        .glass-effect { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .slider-img { display: none; }
        .slider-img.active { display: block; animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="antialiased">

    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5 px-8 py-4 flex justify-between items-center">
        <a href="{{ route('products.index') }}" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 hover:text-orange-500 transition">
            <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Quay lại cửa hàng
        </a>
        <a href="{{ url('/') }}">
            <h1 class="text-xl font-black text-orange-500 tracking-tighter uppercase italic">SPORTQ&A</h1>
        </a>
    </nav>

    <div class="max-w-7xl mx-auto pt-32 pb-20 px-6">
        <div class="grid lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-7 sticky top-32">
                <div class="relative group rounded-[3rem] overflow-hidden bg-white/5 border border-white/5 p-12 flex items-center justify-center shadow-2xl min-h-[500px]">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-orange-600/10 via-transparent to-transparent opacity-50"></div>
                    
                    @php
                        // Gộp ảnh chính và các ảnh phụ vào một mảng duy nhất
                        $allImages = [$product->image];
                        if($product->gallery) {
                            $allImages = array_merge($allImages, $product->gallery);
                        }
                    @endphp

                    @foreach($allImages as $index => $img)
                        <img src="{{ asset('storage/' . $img) }}" 
                             class="slider-img {{ $index === 0 ? 'active' : '' }} max-h-[600px] w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)] group-hover:scale-105 transition-transform duration-700"
                             data-index="{{ $index }}">
                    @endforeach

                    @if(count($allImages) > 1)
                        <button onclick="prevSlide()" class="absolute left-8 p-4 rounded-full bg-black/50 text-white hover:bg-orange-600 transition-all opacity-0 group-hover:opacity-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button onclick="nextSlide()" class="absolute right-8 p-4 rounded-full bg-black/50 text-white hover:bg-orange-600 transition-all opacity-0 group-hover:opacity-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                        </button>

                        <div class="absolute bottom-8 flex gap-2">
                            @foreach($allImages as $index => $img)
                                <div class="dot w-2 h-2 rounded-full transition-all {{ $index === 0 ? 'bg-orange-600 w-6' : 'bg-white/20' }}"></div>
                            @endforeach
                        </div>
                    @endif
                    
                    <div class="absolute top-8 left-8 bg-orange-600 text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest italic shadow-lg">
                        {{ $product->brand }} Official
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col pt-4">
                <span class="text-orange-500 font-black uppercase tracking-[0.4em] text-xs mb-4 italic flex items-center gap-2">
                    <span class="h-[1px] w-8 bg-orange-500"></span> Pro Performance Gear
                </span>
                
                <h2 class="text-5xl md:text-6xl font-black text-white leading-[1.1] mb-6 italic uppercase tracking-tighter">
                    {{ $product->name }}
                </h2>
                
                <div class="flex items-baseline gap-4 mb-8">
                    <span class="text-5xl font-black text-white tracking-tighter italic">
                        {{ number_format($product->price) }}<span class="text-lg text-orange-500 ml-1 italic">đ</span>
                    </span>
                    <span class="text-gray-600 text-sm font-bold uppercase line-through italic">VAT Included</span>
                </div>

                <div class="glass-effect p-8 rounded-[2.5rem] mb-10">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4 flex items-center gap-2">
                        <svg class="w-3 h-3 fill-orange-500" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2z"/></svg> 
                        Đặc điểm nổi bật
                    </h4>
                    <p class="text-gray-400 text-sm leading-relaxed italic mb-0">
                        "{{ $product->description ?? 'Dòng sản phẩm cao cấp được thiết kế dành riêng cho vận động viên chuyên nghiệp, đảm bảo sự linh hoạt và độ bền vượt trội.' }}"
                    </p>
                </div>

                <button onclick="handleBuyNow()" 
                        class="group relative w-full bg-orange-600 text-white py-6 rounded-2xl font-black uppercase tracking-[0.2em] italic hover:bg-white hover:text-black transition-all duration-500 shadow-[0_20px_40px_rgba(249,115,22,0.2)] flex items-center justify-center gap-3">
                    <span>MUA NGAY</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>

                <div class="mt-12 grid grid-cols-2 gap-6">
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-orange-500 transition-colors">🛡️</div>
                        <span class="text-[9px] font-black uppercase tracking-widest text-gray-500">Bảo hành 12 tháng</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-orange-500 transition-colors">🚚</div>
                        <span class="text-[9px] font-black uppercase tracking-widest text-gray-500">Giao hàng 2h</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // LOGIC SLIDER
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slider-img');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            if (slides.length <= 1) return;
            
            slides[currentIndex].classList.remove('active');
            if (dots.length > 0) {
                dots[currentIndex].classList.remove('bg-orange-600', 'w-6');
                dots[currentIndex].classList.add('bg-white/20');
            }

            currentIndex = (index + slides.length) % slides.length;

            slides[currentIndex].classList.add('active');
            if (dots.length > 0) {
                dots[currentIndex].classList.add('bg-orange-600', 'w-6');
                dots[currentIndex].classList.remove('bg-white/20');
            }
        }

        function nextSlide() { showSlide(currentIndex + 1); }
        function prevSlide() { showSlide(currentIndex - 1); }

        // Mua hàng
        const productData = {
            name: "{{ addslashes($product->name) }}",
            brand: "{{ addslashes($product->brand) }}",
            price: "{{ number_format($product->price) }}đ",
            image: "{{ asset('storage/' . $product->image) }}"
        };

        function handleBuyNow() {
            buyNow(productData.name, productData.brand, productData.price, productData.image);
        }

        function buyNow(name, brand, price, image) {
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                },
                body: JSON.stringify({ name: name, brand: brand, price: price, image: image })
            })
            .then(res => {
                if (res.ok) {
                    window.location.href = "{{ route('cart.index') }}"; 
                } else {
                    alert("Lỗi thêm vào giỏ hàng!");
                }
            })
            .catch(err => console.error("Lỗi:", err));
        }
    </script>
</body>
</html>