<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỗ Trợ - SportQ&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #050505; color: #eee; overflow-x: hidden; }
        
        /* Hiệu ứng Text Gradient từ trang Khám phá */
        .text-gradient {
            background: linear-gradient(to bottom right, #fff 30%, rgba(255,255,255,0.4));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Support Card "Biến hình" */
        .support-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .support-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(249, 115, 22, 0.4);
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0,0,0,0.5), 0 0 40px rgba(249, 115, 22, 0.1);
        }

        /* Đốm sáng Decor */
        .glow-dot {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
        }

        /* FAQ Accordion */
        .faq-item { transition: all 0.3s ease; }
        .faq-item:hover { background: rgba(249, 115, 22, 0.05); padding-left: 2rem; border-color: rgba(249, 115, 22, 0.3); }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
    </style>
</head>
<body class="antialiased custom-scrollbar">

    <div class="glow-dot top-[-10%] right-[-10%]"></div>
    <div class="glow-dot bottom-[-10%] left-[-10%]"></div>

    <nav class="bg-black/80 backdrop-blur-xl fixed w-full z-[100] border-b border-white/5">
        <div class="max-w-7xl mx-auto flex justify-between items-center p-5 px-8">
            <a href="{{ url('/') }}">
                <h1 class="text-2xl font-black text-orange-500 tracking-tighter">SPORT Q&A<span class="text-white"></span></h1>
            </a>
<div class="space-x-10 hidden md:flex items-center">
    <a href="{{ url('/') }}" class="text-orange-500 font-bold text-[11px] uppercase tracking-widest">Trang chủ</a>

    <a href="{{ url('/about') }}" class="hover:text-orange-500 text-gray-400 font-bold text-[11px] uppercase tracking-widest transition">Giới thiệu</a>

<div class="relative group">
    <a href="{{ route('explore') }}" class="hover:text-orange-500 text-gray-400 font-bold text-[11px] uppercase tracking-widest transition cursor-pointer">
        Khám phá
    </a>
</div>

    <div class="relative group">
    <a href="{{ route('support') }}" class="hover:text-orange-500 text-gray-400 font-bold text-[11px] uppercase tracking-widest transition cursor-pointer">
        Hỗ trợ
    </a>
</div>
    <a href="{{ url('/products') }}" class="hover:text-orange-500 text-gray-400 font-bold text-[11px] uppercase tracking-widest transition">Sản phẩm</a>

    <a href="{{ url('/contact') }}" class="hover:text-orange-500 text-gray-400 font-bold text-[11px] uppercase tracking-widest transition">Liên hệ</a>

    @auth
        <div class="flex items-center space-x-5 border-l pl-8 border-white/10">
            <a href="{{ route('profile') }}" class="group flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-orange-600 group-hover:border-orange-600 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="text-[10px] font-bold uppercase text-gray-500 group-hover:text-orange-500 transition-all tracking-widest">
                    <b class="text-white group-hover:text-orange-500 transition-colors">{{ Auth::user()->name }}</b>
                </span>
            </a>
        </div>
    @else
        <a href="{{ url('/login') }}" class="bg-orange-600 text-white px-7 py-2.5 rounded-full font-black text-[10px] tracking-widest shadow-lg hover:bg-orange-700 transition active:scale-95">ĐĂNG NHẬP</a>
    @endauth
</div>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto pt-56 pb-32 px-10">
        
        <div class="relative mb-32">
            <span class="text-orange-500 font-black text-[12px] tracking-[0.6em] uppercase mb-6 block">Service Center 24/7</span>
            <h2 class="text-7xl md:text-[10rem] font-black uppercase italic tracking-[0.05em] leading-[0.85] text-gradient">
                TRUNG TÂM <br> <span class="text-orange-500">HỖ TRỢ</span>
            </h2>
            <div class="mt-12 max-w-xl">
                <p class="text-gray-500 text-sm font-medium leading-relaxed uppercase tracking-widest">
                    SportQ&A không chỉ bán sản phẩm, chúng tôi bán sự an tâm tuyệt đối cho mọi tay vợt trên sân đấu.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
            
            <div class="md:col-span-4 support-card p-14 rounded-[4rem] group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-10 opacity-5 group-hover:opacity-10 group-hover:scale-150 transition-all duration-700">
                    <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                </div>
                <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mb-12 border border-white/10 group-hover:bg-orange-600 transition-colors">
                    <svg class="w-8 h-8 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h4 class="text-3xl font-black uppercase italic mb-6 tracking-tighter">Bảo Hành <br> <span class="text-gray-500 group-hover:text-white transition-colors">Tin Cậy</span></h4>
                <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest leading-loose mb-10">Lỗi 1 đổi 1 trong 7 ngày. <br> Bảo hành mặt vợt 6 tháng chính hãng.</p>
                <a href="#" class="inline-block bg-white/5 px-8 py-4 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-white/5 hover:bg-orange-500 transition-all">Chi tiết chính sách</a>
            </div>

            <div class="md:col-span-4 support-card p-14 rounded-[4rem] group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-10 opacity-5 group-hover:opacity-10 group-hover:scale-150 transition-all duration-700">
                    <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                </div>
                <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mb-12 border border-white/10 group-hover:bg-orange-600 transition-colors">
                    <svg class="w-8 h-8 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h4 class="text-3xl font-black uppercase italic mb-6 tracking-tighter">Giao Hàng <br> <span class="text-gray-500 group-hover:text-white transition-colors">Siêu Tốc</span></h4>
                <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest leading-loose mb-10">Ship COD toàn quốc. <br> Free ship cho đơn trên 2.000.000đ.</p>
                <a href="#" class="inline-block bg-white/5 px-8 py-4 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-white/5 hover:bg-orange-500 transition-all">Tra cứu đơn</a>
            </div>

            <div class="md:col-span-4 bg-orange-600 p-14 rounded-[4rem] flex flex-col justify-between shadow-[0_40px_80px_rgba(249,115,22,0.3)] hover:scale-[1.03] transition-all duration-500 relative overflow-hidden group">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
                <div class="relative z-10">
                    <h4 class="text-4xl font-black text-white uppercase italic mb-6 tracking-tighter leading-none">Cần tư vấn <br> Ngay lập tức?</h4>
                    <p class="text-orange-100 text-[11px] font-black uppercase tracking-[0.2em] leading-relaxed italic mb-12">Giải đáp kỹ thuật 24/7 chuyên sâu cho từng lối chơi.</p>
                </div>
                <a href="#" class="relative z-10 bg-black text-white text-center py-6 rounded-[2rem] text-[11px] font-black uppercase tracking-[0.3em] hover:bg-white hover:text-black transition-all shadow-2xl">Kết nối Zalo</a>
            </div>
        </div>

        <div class="mt-56 max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <h3 class="text-5xl font-black uppercase italic tracking-tighter">Câu hỏi <br> <span class="text-orange-500">Thường gặp</span></h3>
                <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[0.3em] border-l border-orange-500 pl-6 max-w-xs">Chúng tôi minh bạch mọi quy trình để bạn yên tâm mua sắm.</p>
            </div>
            
            <div class="space-y-4">
                <div class="faq-item bg-[#0a0a0a] p-10 rounded-[2.5rem] border border-white/5 flex justify-between items-center cursor-pointer group">
                    <span class="text-[12px] font-black uppercase tracking-[0.2em] group-hover:text-orange-500 transition-colors">Làm sao để chọn trọng lượng vợt phù hợp?</span>
                    <div class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-orange-500 group-hover:border-orange-500 transition-all">
                        <span class="text-white text-xl font-light group-hover:rotate-90 transition-transform">+</span>
                    </div>
                </div>
                
                <div class="faq-item bg-[#0a0a0a] p-10 rounded-[2.5rem] border border-white/5 flex justify-between items-center cursor-pointer group">
                    <span class="text-[12px] font-black uppercase tracking-[0.2em] group-hover:text-orange-500 transition-colors">Chính sách trả góp qua thẻ tín dụng?</span>
                    <div class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-orange-500 group-hover:border-orange-500 transition-all">
                        <span class="text-white text-xl font-light group-hover:rotate-90 transition-transform">+</span>
                    </div>
                </div>

                <div class="faq-item bg-[#0a0a0a] p-10 rounded-[2.5rem] border border-white/5 flex justify-between items-center cursor-pointer group">
                    <span class="text-[12px] font-black uppercase tracking-[0.2em] group-hover:text-orange-500 transition-colors">Làm thế nào để vệ sinh mặt vợt Carbon?</span>
                    <div class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-orange-500 group-hover:border-orange-500 transition-all">
                        <span class="text-white text-xl font-light group-hover:rotate-90 transition-transform">+</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-24 text-center border-t border-white/5">
        <h2 class="text-white/10 font-black text-8xl mb-10 tracking-[0.2em] select-none">SPORTQ&A</h2>
        <p class="text-[10px] font-black uppercase text-gray-600 tracking-[0.8em]">© 2026 SportQ&A Support Center. All rights reserved.</p>
    </footer>

</body>
</html>