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
    </style>
</head>
<body class="antialiased">

    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5 px-8 py-4 flex justify-between items-center">
        <a href="{{ route('products.index') }}" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 hover:text-orange-500 transition">
            <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Quay lại cửa hàng
        </a>
        <a href="{{ url('/') }}">
            <h1 class="text-xl font-black text-orange-500 tracking-tighter uppercase italic">SPORTQ&A<span class="text-white"></span></h1>
        </a>
    </nav>

    <div class="max-w-7xl mx-auto pt-32 pb-20 px-6">
        <div class="grid lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-7 sticky top-32">
                <div class="relative group rounded-[3rem] overflow-hidden bg-white/5 border border-white/5 p-12 flex items-center justify-center shadow-2xl">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-orange-600/10 via-transparent to-transparent opacity-50"></div>
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600' }}" 
                         class="max-h-[600px] w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)] group-hover:scale-105 transition-transform duration-700">
                    
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

<script>
    // Định nghĩa dữ liệu ở đây, VS Code sẽ không báo đỏ nữa
    const productData = {
        name: "{{ addslashes($product->name) }}",
        brand: "{{ addslashes($product->brand) }}",
        price: "{{ number_format($product->price) }}đ",
        image: "{{ asset('storage/products/' . $product->image) }}"
    };

    function handleBuyNow() {
        // Gọi lại hàm buyNow với các biến đã định nghĩa
        buyNow(productData.name, productData.brand, productData.price, productData.image, '');
    }
</script>
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
        function buyNow(name, brand, price, image, description) {
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