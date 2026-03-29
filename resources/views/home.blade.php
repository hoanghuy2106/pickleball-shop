<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickleball Master - Premium Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white/80 backdrop-blur-lg shadow-sm fixed w-full z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
            <a href="{{ url('/') }}">
                <h1 class="text-2xl font-extrabold text-orange-600 tracking-wide">
                    PICKLEBALL MASTER
                </h1>
            </a>
            
            <div class="space-x-8 hidden md:flex items-center">
                <a href="{{ url('/') }}" class="hover:text-orange-500 font-medium">Trang chủ</a>
                <a href="{{ url('/products') }}" class="hover:text-orange-500 font-medium">Sản phẩm</a>
                <a href="{{ url('/contact') }}" class="hover:text-orange-500 font-medium">Liên hệ</a>

                @auth
                    <div class="flex items-center space-x-4 border-l pl-6 border-gray-200">
                        <span class="text-gray-700 font-medium">
                             <span class="text-orange-600 font-bold">{{ Auth::user()->name }}</span>
                        </span>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-red-500 hover:text-white transition">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                @endauth

                @guest
                    <a href="{{ url('/login') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-600 transition">
                        Đăng nhập
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <header class="bg-gradient-to-r from-orange-500 to-red-500 text-white pt-32 pb-24 text-center">
        <h2 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">Nâng Tầm Trận Đấu</h2>
        <p class="text-lg md:text-xl text-orange-100 mb-8 max-w-2xl mx-auto">Khám phá những cây vợt Pickleball cao cấp giúp bạn kiểm soát và bứt phá trong từng cú đánh.</p>
        <a href="{{ url('/products') }}">
            <button class="bg-white text-orange-600 px-10 py-4 rounded-full font-bold shadow-xl hover:scale-105 transition">
                Mua Ngay
            </button>
        </a>
    </header>

    <section class="max-w-6xl mx-auto py-12 px-6 grid md:grid-cols-3 gap-6 text-center">
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-bold text-lg mb-2">Chính Hãng 100%</h3>
            <p class="text-gray-600 text-sm">Cam kết sản phẩm từ thương hiệu uy tín.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-bold text-lg mb-2">Giao Hàng Nhanh</h3>
            <p class="text-gray-600 text-sm">Ship toàn quốc chỉ từ 2-3 ngày.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-bold text-lg mb-2">Hỗ Trợ 24/7</h3>
            <p class="text-gray-600 text-sm">Luôn sẵn sàng tư vấn cho bạn.</p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto py-16 px-6">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-3xl font-bold border-l-4 border-orange-500 pl-4">Sản Phẩm Nổi Bật</h3>
            <a href="{{ url('/products') }}" class="text-orange-500 font-semibold hover:underline">
                Xem tất cả
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-white rounded-2xl shadow hover:shadow-2xl transition overflow-hidden group">
                <div class="h-52 bg-gray-200 flex items-center justify-center font-bold text-gray-400">IMAGE</div>
                <div class="p-5">
                    <h4 class="text-xl font-bold mb-2 group-hover:text-orange-500">Joola Perseus</h4>
                    <p class="text-gray-500 text-sm mb-4">Carbon cao cấp tăng xoáy & kiểm soát.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-bold text-lg">5.450.000đ</span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Mua</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow hover:shadow-2xl transition overflow-hidden group">
                <div class="h-52 bg-gray-200 flex items-center justify-center font-bold text-gray-400">IMAGE</div>
                <div class="p-5">
                    <h4 class="text-xl font-bold mb-2 group-hover:text-orange-500">Selkirk Vanguard</h4>
                    <p class="text-gray-500 text-sm mb-4">Kiểm soát bóng tối đa, lõi 16mm.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-bold text-lg">4.900.000đ</span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Mua</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow hover:shadow-2xl transition overflow-hidden group">
                <div class="h-52 bg-gray-200 flex items-center justify-center font-bold text-gray-400">IMAGE</div>
                <div class="p-5">
                    <h4 class="text-xl font-bold mb-2 group-hover:text-orange-500">WAVEX Pro</h4>
                    <p class="text-gray-500 text-sm mb-4">Cân bằng hoàn hảo cho mọi lối chơi.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-bold text-lg">2.850.000đ</span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Mua</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-400 py-10 text-center">
        <p class="mb-2">© 2026 Pickleball Master</p>
        <p class="text-sm">Thiết kế chuyên nghiệp - Chuẩn UI/UX hiện đại</p>
    </footer>

</body>
</html>