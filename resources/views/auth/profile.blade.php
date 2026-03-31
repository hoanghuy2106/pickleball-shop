<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống Admin - SPORT Q&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .stat-card:hover { transform: translateY(-5px); border-color: rgba(234, 88, 12, 0.5); }
        .input-field { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 1rem; color: white; transition: all 0.3s; }
        .input-field:focus { border-color: #ea580c; background: rgba(234, 88, 12, 0.08); outline: none; }
    </style>
</head>
<body class="antialiased">
    <div class="max-w-[1440px] mx-auto py-16 px-8 md:px-16">
        
        @if(session('success'))
        <div class="fixed top-5 right-5 z-50 bg-orange-600 text-white px-6 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-2xl animate-bounce">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-start mb-12">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-[10px] font-black tracking-[0.2em] text-gray-500 hover:text-orange-500 transition-all group uppercase">
                <div class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-orange-600 transition-all shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                Quay lại trang chủ
            </a>
            
            <div class="text-right">
                <span class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-2">Trạng thái hệ thống</span>
                <div class="flex items-center gap-2 justify-end">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-[12px] font-bold text-white uppercase">Đang hoạt động</span>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto">
            <h2 class="text-6xl font-black tracking-tighter mb-12 text-white italic uppercase leading-none">
                Bảng điều khiển <span class="text-orange-600">Admin .</span>
            </h2>

            @if ($errors->any())
                <div class="mb-8 p-6 rounded-[2rem] bg-red-600/10 border border-red-600/20">
                    <p class="text-red-500 text-[10px] font-black uppercase tracking-widest mb-3 italic">Phát hiện lỗi nhập liệu:</p>
                    <ul class="list-disc list-inside text-red-400 text-[11px] font-bold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-4 space-y-6">
                    <div class="glass-card p-8 rounded-[3rem] text-center relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-600/20 blur-[50px]"></div>
                        
                        <div class="relative inline-block mb-6">
                            <div class="w-32 h-32 rounded-[2.5rem] bg-gradient-to-br from-orange-600 to-red-600 flex items-center justify-center shadow-2xl shadow-orange-600/40 mx-auto transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                                <span class="text-5xl font-black text-white italic uppercase">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        </div>

                        <h3 class="text-2xl font-black text-white italic uppercase mb-1">{{ $user->name }}</h3>
                        <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em] mb-8">{{ $user->email }}</p>

                        <div class="space-y-3">
                            <form action="{{ route('logout') }}" method="POST"> @csrf
                                <button type="submit" class="w-full bg-red-600/5 text-red-500 border border-red-600/10 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-red-600 hover:text-white transition-all">Đăng xuất</button>
                            </form>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-[2rem] border-l-4 border-orange-600 bg-gradient-to-r from-orange-600/5 to-transparent">
                        <p class="text-[9px] font-black text-orange-500 uppercase tracking-widest mb-2">Elite Badge</p>
                        <p class="text-[11px] text-gray-400 font-medium leading-relaxed">Dữ liệu được bảo mật bằng mã hóa đầu cuối. Mọi thay đổi đều được lưu vết hệ thống.</p>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-8">
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="glass-card p-6 rounded-[2rem] stat-card transition-all duration-300">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-3">Tổng đơn hàng</p>
                            <p class="text-3xl font-black text-white italic leading-none">128<span class="text-orange-500 text-lg">.</span></p>
                        </div>
                        <div class="glass-card p-6 rounded-[2rem] stat-card transition-all duration-300 border-orange-600/20 bg-orange-600/5">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-3">Doanh thu tháng</p>
                            <p class="text-3xl font-black text-white italic leading-none">42M<span class="text-orange-500 text-lg">.</span></p>
                        </div>
                        <div class="glass-card p-6 rounded-[2rem] stat-card transition-all duration-300 hidden md:block">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-3">Sản phẩm kho</p>
                            <p class="text-3xl font-black text-white italic leading-none">540<span class="text-orange-500 text-lg">.</span></p>
                        </div>
                    </div>

                    <div class="glass-card p-10 rounded-[3rem]">
                        <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-8 italic border-b border-white/5 pb-4">Thiết lập định danh người dùng</p>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-2">Tên hiển thị</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="w-full p-4 input-field font-bold text-xs" placeholder="Nhập tên mới">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-2">Số điện thoại</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}" class="w-full p-4 input-field font-bold text-xs" placeholder="Số điện thoại Admin">
                                </div>
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-2">Địa chỉ trụ sở</label>
                                    <textarea name="address" rows="3" class="w-full p-4 input-field font-bold text-xs" placeholder="Địa chỉ điều phối đơn hàng">{{ $user->address }}</textarea>
                                </div>
                            </div>

                            <div class="pt-4 flex items-center justify-between">
                                <span class="text-[9px] text-gray-600 font-bold italic uppercase">Lần cuối cập nhật: {{ $user->updated_at->diffForHumans() }}</span>
                                <button type="submit" class="bg-white text-black px-8 py-4 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-orange-600 hover:text-white transition-all shadow-xl active:scale-95">
                                    Lưu hồ sơ
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="glass-card p-8 rounded-[3rem]">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 italic">Quản trị nhanh</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('products.index') }}" class="group p-5 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-600/50 hover:bg-orange-600/5 transition-all flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-orange-500 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <span class="text-[11px] font-black text-white uppercase tracking-widest">Kho sản phẩm</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="#" class="group p-5 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-600/50 hover:bg-orange-600/5 transition-all flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-orange-500 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <span class="text-[11px] font-black text-white uppercase tracking-widest">Báo cáo doanh thu</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>