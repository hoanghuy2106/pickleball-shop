<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỗ Trợ - SportQ&A Elite Gear</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #050505; color: #eee; overflow-x: hidden; }
        
        /* Hiệu ứng Text Gradient */
        .text-gradient {
            background: linear-gradient(to bottom right, #fff 30%, rgba(255,255,255,0.2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Support Card "Biến hình" */
        .support-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .support-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(249, 115, 22, 0.4);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }

        /* Đốm sáng Decor */
        .glow-dot {
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.12) 0%, transparent 70%);
            border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none;
        }

        /* FAQ Accordion */
        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s ease-in-out;
            opacity: 0;
        }
        .faq-item.active .faq-content {
            max-height: 300px;
            opacity: 1;
            padding-top: 1.5rem;
        }
        .faq-item.active .faq-plus { transform: rotate(45deg); background: #f97316; }

        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }

        /* Floating Contact Hub */
        .contact-hub {
            position: fixed; bottom: 30px; right: 30px; z-index: 110;
            display: flex; flex-direction: column; gap: 12px;
        }
        .hub-item {
            width: 50px; height: 50px; border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(15, 15, 15, 0.8); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;
        }
        .hub-item:hover { transform: scale(1.1); border-color: #f97316; color: #f97316; }
    </style>
</head>
<body class="antialiased custom-scrollbar">

    <div class="glow-dot top-[-10%] right-[-10%]"></div>
    <div class="glow-dot bottom-[-10%] left-[-10%]"></div>

    <div class="contact-hub">
        <a href="#" class="hub-item text-white" title="Zalo hỗ trợ">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
        </a>
        <a href="tel:0123456789" class="hub-item text-orange-500" title="Hotline 24/7">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
        </a>
    </div>

    <nav class="bg-black/80 backdrop-blur-xl fixed w-full z-[100] border-b border-white/5">
        <div class="max-w-7xl mx-auto flex justify-between items-center p-5 px-8">
            <a href="{{ url('/') }}">
                <h1 class="text-2xl font-black text-orange-500 tracking-tighter italic">SPORT Q&A</h1>
            </a>
            <div class="space-x-8 hidden md:flex items-center">
                <a href="{{ url('/') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[10px] uppercase tracking-widest transition">Trang chủ</a>
                <a href="{{ url('/about') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[10px] uppercase tracking-widest transition">Giới thiệu</a>
                <a href="{{ route('explore') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[10px] uppercase tracking-widest transition">Khám phá</a>
                <a href="{{ route('support') }}" class="text-orange-500 font-bold text-[10px] uppercase tracking-widest transition">Hỗ trợ</a>
                <a href="{{ url('/products') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[10px] uppercase tracking-widest transition">Sản phẩm</a>
                <a href="{{ url('/contact') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[10px] uppercase tracking-widest transition">Liên hệ</a>
                
                @auth
                    <div class="h-4 w-[1px] bg-white/10"></div>
                    <span class="text-[10px] font-bold uppercase text-white tracking-widest italic">{{ Auth::user()->name }}</span>
                @else
                    <a href="{{ url('/login') }}" class="bg-orange-600 text-white px-6 py-2 rounded-full font-black text-[10px] tracking-widest hover:bg-orange-700 transition">ĐĂNG NHẬP</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto pt-48 pb-32 px-10 relative z-10">
        <div class="mb-24">
            <span class="text-orange-500 font-black text-[11px] tracking-[0.6em] uppercase mb-6 block">Service Center 24/7</span>
            <h2 class="text-6xl md:text-[9rem] font-black uppercase italic tracking-tighter leading-[0.9] text-gradient">
                TRUNG TÂM <br> <span class="text-orange-500">HỖ TRỢ</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <div class="md:col-span-4 support-card p-10 rounded-[3rem] group">
                <div>
                    <div class="w-14 h-14 bg-white/5 rounded-xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-orange-600 transition-colors">
                        <svg class="w-6 h-6 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black uppercase italic mb-4">Bảo Hành <span class="text-gray-500 group-hover:text-white transition-colors">Tin Cậy</span></h4>
                    <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest leading-loose mb-8">Lỗi 1 đổi 1 trong 7 ngày. Bảo hành mặt vợt Carbon 6 tháng chính hãng.</p>
                </div>
                <a href="#" class="w-fit bg-white/5 px-6 py-3 rounded-full text-[9px] font-black uppercase tracking-widest border border-white/5 hover:bg-orange-500 transition-all">Chi tiết</a>
            </div>

            <div class="md:col-span-4 support-card p-10 rounded-[3rem] group">
                <div>
                    <div class="w-14 h-14 bg-white/5 rounded-xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-orange-600 transition-colors">
                        <svg class="w-6 h-6 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black uppercase italic mb-4">Giao Hàng <span class="text-gray-500 group-hover:text-white transition-colors">Siêu Tốc</span></h4>
                    <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest leading-loose mb-8">Ship hỏa tốc nội thành. Miễn phí vận chuyển cho các đơn hàng Elite.</p>
                </div>
                <a href="#" class="w-fit bg-white/5 px-6 py-3 rounded-full text-[9px] font-black uppercase tracking-widest border border-white/5 hover:bg-orange-500 transition-all">Tra cứu</a>
            </div>

            <div class="md:col-span-4 bg-orange-600 p-10 rounded-[3rem] flex flex-col justify-between shadow-xl group overflow-hidden relative">
                <div class="relative z-10">
                    <h4 class="text-3xl font-black text-white uppercase italic mb-4 leading-none">Cần tư vấn <br> Kỹ thuật?</h4>
                    <p class="text-orange-100 text-[10px] font-black uppercase tracking-widest italic mb-10">Đội ngũ chuyên gia hỗ trợ 24/7 cho mọi trình độ.</p>
                </div>
                <a href="#" class="relative z-10 bg-black text-white text-center py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white hover:text-black transition-all">Kết nối Zalo</a>
            </div>
        </div>

        <div class="mt-48 max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <h3 class="text-4xl font-black uppercase italic tracking-tighter">Câu hỏi <span class="text-orange-500">Thường gặp</span></h3>
                <div class="h-[1px] flex-1 bg-white/10 hidden md:block mx-10 mb-4"></div>
                <p class="text-gray-500 text-[9px] font-bold uppercase tracking-widest italic">Minh bạch & Tin cậy</p>
            </div>
            
            <div class="space-y-4">
                <div class="faq-item bg-[#0a0a0a] p-8 rounded-[2rem] border border-white/5 cursor-pointer group" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <span class="text-[11px] font-black uppercase tracking-[0.15em] group-hover:text-orange-500 transition-colors">Cách chọn trọng lượng vợt phù hợp?</span>
                        <div class="faq-plus w-8 h-8 rounded-full border border-white/10 flex items-center justify-center transition-all">
                            <span class="text-white">+</span>
                        </div>
                    </div>
                    <div class="faq-content">
                        <p class="text-gray-500 text-[10px] font-bold uppercase leading-relaxed tracking-wider">
                            Người mới nên chọn 7.8oz - 8.1oz. Người chơi thiên công cần lực mạnh nên chọn trên 8.2oz.
                        </p>
                    </div>
                </div>

                <div class="faq-item bg-[#0a0a0a] p-8 rounded-[2rem] border border-white/5 cursor-pointer group" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <span class="text-[11px] font-black uppercase tracking-[0.15em] group-hover:text-orange-500 transition-colors">Chính sách bảo hành mặt vợt Carbon?</span>
                        <div class="faq-plus w-8 h-8 rounded-full border border-white/10 flex items-center justify-center transition-all">
                            <span class="text-white">+</span>
                        </div>
                    </div>
                    <div class="faq-content">
                        <p class="text-gray-500 text-[10px] font-bold uppercase leading-relaxed tracking-wider">
                            Bảo hành 6 tháng cho lỗi bong tróc tự nhiên. Không bảo hành do va chạm vật lý mạnh hoặc tác động ngoại lực.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-20 text-center border-t border-white/5 relative z-10">
        <h2 class="text-white/5 font-black text-7xl md:text-9xl mb-8 tracking-widest select-none">SPORTQ&A</h2>
        <p class="text-[9px] font-black uppercase text-gray-600 tracking-[0.5em]">© 2026 Support Center | Vương Anh Tú - EAUT</p>
    </footer>

    <script>
        function toggleFAQ(element) {
            const isActive = element.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(item => item.classList.remove('active'));
            if (!isActive) element.classList.add('active');
        }
    </script>
</body>
</html>