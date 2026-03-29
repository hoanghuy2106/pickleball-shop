<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-2xl shadow-xl w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-orange-600">Đăng nhập</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600 text-sm text-center bg-green-50 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-orange-400 outline-none @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <input type="password" name="password" placeholder="Mật khẩu" required
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-orange-400 outline-none @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition">
            Đăng nhập
        </button>
    </form>

    <p class="text-sm mt-4 text-center">
        Chưa có tài khoản?
        <a href="{{ route('register') }}" class="text-orange-500 hover:underline">Đăng ký</a>
    </p>

    <p class="text-sm mt-2 text-center">
        <a href="{{ url('/') }}" class="text-gray-500 hover:underline">← Quay lại trang chủ</a>
    </p>
</div>

</body>
</html>