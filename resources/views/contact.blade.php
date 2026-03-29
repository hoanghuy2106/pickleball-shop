<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ - Pickleball Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- NAVBAR -->
<nav class="bg-white/80 backdrop-blur shadow-md p-4 flex justify-between items-center px-10 sticky top-0 z-50">
  <a href="{{ url('/') }}">
    <h1 class="text-2xl font-extrabold text-orange-600 tracking-wide">
        PICKLEBALL MASTER
    </h1>
</a>
    <div class="space-x-6">
        <a href="{{ url('/') }}" class="hover:text-orange-500 font-medium">Trang chủ</a>
        <a href="{{ url('/products') }}" class="hover:text-orange-500 font-medium">Sản phẩm</a>
        <a href="{{ url('/login') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Đăng nhập</a>
    </div>
</nav>

<!-- HERO -->
<section class="bg-gradient-to-r from-orange-500 to-red-500 text-white py-16 text-center">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Liên hệ với chúng tôi</h2>
    <p class="text-orange-100 max-w-xl mx-auto">Bạn có câu hỏi về sản phẩm hoặc cần tư vấn? Hãy gửi thông tin, chúng tôi sẽ phản hồi nhanh nhất!</p>
</section>

<!-- CONTENT -->
<div class="max-w-6xl mx-auto py-16 px-6 grid md:grid-cols-2 gap-10">

    <!-- CONTACT INFO -->
    <div class="bg-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-2xl font-bold mb-6 text-orange-600">Thông tin liên hệ</h3>

        <p class="mb-4"><strong>📍 Địa chỉ:</strong> TP. Hồ Chí Minh</p>
        <p class="mb-4"><strong>📞 Điện thoại:</strong> 0123 456 789</p>
        <p class="mb-4"><strong>📧 Email:</strong> support@pickleballmaster.vn</p>

        <div class="mt-6">
            <iframe class="w-full h-48 rounded-lg" src="https://maps.google.com/maps?q=ho%20chi%20minh&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
        </div>
    </div>

    <!-- FORM -->
    <div class="bg-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-2xl font-bold mb-6 text-orange-600">Gửi tin nhắn</h3>

        <form class="space-y-4">
            <input type="text" placeholder="Họ và tên"
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-orange-400 outline-none">

            <input type="email" placeholder="Email"
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-orange-400 outline-none">

            <textarea placeholder="Nội dung..."
                class="w-full p-3 border rounded-lg h-32 focus:ring-2 focus:ring-orange-400 outline-none"></textarea>

            <button class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                Gửi liên hệ
            </button>
        </form>
    </div>

</div>

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-400 text-center py-6">
    <p>© 2026 Pickleball Master</p>
    <p class="text-sm">Thiết kế chuyên nghiệp - UI hiện đại</p>
</footer>

</body>
</html>