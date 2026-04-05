<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ - SPORTQ&A | Hỗ Trợ Chuyên Nghiệp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #050505; color: #fff; overflow-x: hidden; }
        
        .noise {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://grainy-gradients.vercel.app/noise.svg');
            opacity: 0.05; pointer-events: none; z-index: 999;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .input-glow:focus {
            box-shadow: 0 0 20px rgba(234, 88, 12, 0.1);
            border-color: rgba(234, 88, 12, 0.5);
        }

        .text-outline { -webkit-text-stroke: 1px rgba(255,255,255,0.1); color: transparent; }
        
        @keyframes border-draw {
            0% { border-color: rgba(255,255,255,0.05); }
            50% { border-color: rgba(234, 88, 12, 0.3); }
            100% { border-color: rgba(255,255,255,0.05); }
        }
        .animate-border { animation: border-draw 4s infinite; }
    </style>
</head>
<body class="antialiased">
    <div class="noise"></div>

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

    <section class="relative pt-64 pb-32 overflow-hidden text-center">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_center,_rgba(234,88,12,0.1),transparent_70%)]"></div>
        <div class="relative z-10" data-aos="zoom-out">
            <span class="text-orange-500 text-[10px] font-bold uppercase tracking-[0.6em] mb-6 block">Connect with us</span>
            <h2 class="text-7xl md:text-[120px] font-black italic tracking-tighter uppercase leading-none mb-4">
                GET IN <span class="text-outline">TOUCH</span>
            </h2>
            <p class="text-gray-500 text-xs font-medium uppercase tracking-[0.3em]">Mọi thắc mắc về Pickleball, chúng tôi luôn ở đây.</p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto pb-40 px-8 grid lg:grid-cols-12 gap-20">
        
        <div class="lg:col-span-5 space-y-16" data-aos="fade-right">
            <div class="space-y-10">
                <h3 class="text-2xl font-black uppercase italic tracking-widest flex items-center gap-4">
                    <span class="w-10 h-[2px] bg-orange-600"></span>
                    Thông tin kết nối
                </h3>
                
                <div class="space-y-4">
                    <div class="group glass-card p-6 rounded-2xl hover:bg-white/5 transition-all duration-500 cursor-pointer">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 rounded-2xl bg-orange-600/10 flex items-center justify-center text-orange-500 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-orange-500 text-[9px] font-black uppercase tracking-widest mb-1">Trụ sở chính</p>
                                <p class="text-gray-300 font-semibold leading-relaxed">C/c Plazza 2, Ngõ 2 Nguyễn Hoàng, Mỹ Đình, Hà Nội</p>
                            </div>
                        </div>
                    </div>

                    <div class="group glass-card p-6 rounded-2xl hover:bg-white/5 transition-all duration-500 cursor-pointer animate-border">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 rounded-2xl bg-orange-600/10 flex items-center justify-center text-orange-500 group-hover:rotate-12 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <p class="text-orange-500 text-[9px] font-black uppercase tracking-widest mb-1">Hotline 24/7</p>
                                <p class="text-2xl font-black italic tracking-tighter text-white">0982 472 823</p>
                            </div>
                        </div>
                    </div>

                    <div class="group glass-card p-6 rounded-2xl hover:bg-white/5 transition-all duration-500 cursor-pointer">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 rounded-2xl bg-orange-600/10 flex items-center justify-center text-orange-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-orange-500 text-[9px] font-black uppercase tracking-widest mb-1">Email Partner</p>
                                <p class="text-gray-300 font-semibold uppercase tracking-wider">support@sportqa.vn</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative rounded-[2.5rem] overflow-hidden border border-white/10 group h-64 shadow-2xl">
                <div class="absolute inset-0 bg-orange-600/10 z-10 pointer-events-none group-hover:opacity-0 transition-opacity"></div>
                <iframe class="w-full h-full grayscale invert scale-110 group-hover:scale-100 group-hover:grayscale-0 group-hover:invert-0 transition-all duration-1000" 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.924403936735!2d105.773907!3d21.03571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b563f6902d%3A0xc06180373070495f!2sNg.%202%20Nguy%E1%BB%85n%20Ho%C3%A0ng%2C%20M%E1%BB%B9%20%C4%90%C3%ACnh%2C%20Từ%20Liêm%2C%20Hà%20Nội!5e0!3m2!1svi!2s!4v1711900000000" 
                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="lg:col-span-7" data-aos="fade-left">
            <div class="glass-card p-12 md:p-16 rounded-[3.5rem] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-600/10 blur-[100px] -mr-32 -mt-32"></div>
                
                <h3 class="text-3xl font-black uppercase italic mb-12 flex items-center gap-4">
                    Gửi <span class="text-orange-500">Phản hồi</span>
                </h3>
                
                <form class="space-y-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500 ml-2">Họ tên của bạn</label>
                            <input type="text" placeholder="NGUYỄN VĂN A..." class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-5 text-sm font-semibold focus:outline-none input-glow transition-all placeholder:text-gray-700">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500 ml-2">Địa chỉ Email</label>
                            <input type="email" placeholder="EMAIL@GMAIL.COM" class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-5 text-sm font-semibold focus:outline-none input-glow transition-all placeholder:text-gray-700">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500 ml-2">Nội dung tư vấn</label>
                        <textarea placeholder="BẠN ĐANG QUAN TÂM ĐẾN VỢT HAY DỊCH VỤ NÀO?..." class="w-full bg-white/[0.03] border border-white/10 rounded-3xl px-6 py-5 h-48 text-sm font-semibold focus:outline-none input-glow transition-all resize-none placeholder:text-gray-700"></textarea>
                    </div>

                    <button type="submit" class="group w-full bg-orange-600 text-white py-6 rounded-2xl font-black uppercase tracking-[0.3em] italic hover:bg-white hover:text-black transition-all duration-700 flex items-center justify-center gap-4 shadow-2xl shadow-orange-900/20">
                        Gửi yêu cầu hỗ trợ
                        <svg class="w-5 h-5 transform group-hover:translate-x-3 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-black pt-24 pb-12 border-t border-white/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <h2 class="text-3xl font-black text-orange-500 tracking-tighter uppercase italic mb-8">SPORTQ&A<span class="text-white">.</span></h2>
            
            <div class="flex justify-center gap-6 mb-12">
                <a href="#" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center hover:bg-orange-600 transition-all group">
                    <span class="text-[10px] font-black group-hover:scale-110">FB</span>
                </a>
                <a href="#" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center hover:bg-orange-600 transition-all group">
                    <span class="text-[10px] font-black group-hover:scale-110">ZL</span>
                </a>
                <a href="#" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center hover:bg-orange-600 transition-all group">
                    <span class="text-[10px] font-black group-hover:scale-110">TK</span>
                </a>
            </div>

            <p class="text-gray-600 text-[10px] font-bold uppercase tracking-[0.5em] mb-2">© 2026 Developed by <span class="text-white">SPORTQ&A Team</span></p>
            <p class="text-gray-800 text-[9px] font-bold uppercase tracking-widest italic">Redefining Pickleball Excellence in Vietnam</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
</body>
</html>