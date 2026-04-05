<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Chúng Tôi - Sport Q&A | Đỉnh Cao Pickleball Việt Nam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #000; color: #fff; overflow-x: hidden; }
        
        /* Hiệu ứng hạt bụi (Noise) tạo chiều sâu */
        .noise {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://grainy-gradients.vercel.app/noise.svg');
            opacity: 0.05; pointer-events: none; z-index: 999;
        }

        /* Tiêu đề rỗng nghệ thuật */
        .text-stroke { -webkit-text-stroke: 1px rgba(255,255,255,0.2); color: transparent; }

        /* Hiệu ứng Navbar khi cuộn */
        .nav-active {
            background: rgba(0, 0, 0, 0.85) !important;
            backdrop-filter: blur(20px);
            padding: 0.8rem 2rem !important;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* Chữ chạy nền */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee { display: flex; animation: marquee 30s linear infinite; }
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

    <section class="relative min-h-screen flex items-center justify-center pt-20">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-black z-10"></div>
            <img src="https://images.unsplash.com/photo-1626224580173-909904f03407?q=80&w=2070" class="w-full h-full object-cover opacity-60" alt="Sân Pickleball">
        </div>

        <div class="relative z-20 text-center px-6">
            <div data-aos="zoom-out" data-aos-duration="1500">
                <span class="inline-block px-5 py-2 border border-orange-500/40 rounded-full text-orange-500 text-[10px] font-bold uppercase tracking-[0.5em] mb-10 bg-orange-500/5">Cộng Đồng Pickleball Số 1 Việt Nam</span>
                <h1 class="text-6xl md:text-[140px] font-black leading-[0.8] tracking-tighter uppercase italic mb-8">
                    VƯỢT MỌI <br> <span class="text-stroke">GIỚI HẠN</span>
                </h1>
                <p class="max-w-2xl mx-auto text-gray-400 font-light text-sm md:text-lg leading-relaxed tracking-wide">
                    Sport Q&A – Nơi định nghĩa lại đẳng cấp Pickleball qua những dòng vợt <span class="text-white font-semibold italic">chính hãng tinh hoa</span> từ các Lab hàng đầu thế giới.
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto py-32 px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
            <div class="space-y-12" data-aos="fade-right">
                <div class="space-y-4">
                    <h2 class="text-4xl md:text-6xl font-black tracking-tighter uppercase italic leading-none">Tầm Nhìn <br> <span class="text-orange-500">Tiên Phong</span></h2>
                    <div class="h-1 w-24 bg-orange-600"></div>
                </div>
                
                <div class="space-y-6 text-gray-400 text-lg font-light leading-loose">
                    <p>Tại <span class="text-white font-bold">Sport Q&A</span>, chúng tôi không chỉ cung cấp dụng cụ. Chúng tôi kiến tạo nên phong cách sống năng động, hiện đại và tràn đầy năng lượng thông qua bộ môn Pickleball.</p>
                    <p>Mỗi cú đánh (dink), mỗi pha bỏ nhỏ hay cú đập (smash) đều là sự kết hợp giữa kỹ thuật và thiết bị hoàn hảo. Đó là lý do chúng tôi chỉ phân phối những dòng vợt có <span class="text-white italic">độ nhám mặt vợt và độ cân bằng</span> chuẩn quốc tế.</p>
                </div>

                <div class="grid grid-cols-2 gap-10">
                    <div>
                        <h4 class="text-3xl font-black text-white italic">5,000+</h4>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-2">Vận Động Viên Tin Dùng</p>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black text-white italic">100%</h4>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-2">Cam Kết Chính Hãng</p>
                    </div>
                </div>
            </div>

            <div class="relative group" data-aos="fade-left">
                <div class="absolute -inset-4 bg-orange-600/10 blur-3xl rounded-full opacity-30 group-hover:opacity-50 transition duration-700"></div>
                <img src="{{ asset('images/about-story.jpg') }}" class="relative rounded-3xl border border-white/10 shadow-2xl transition duration-700 group-hover:scale-[1.02]" alt="Pickleball Life">
                <div class="absolute -bottom-10 -left-10 bg-black/90 p-8 rounded-2xl border border-white/10 backdrop-blur-xl hidden xl:block shadow-2xl">
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-12 bg-orange-500"></div>
                        <div>
                            <p class="text-white font-black text-2xl">ELITE GEAR</p>
                            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest">Tiêu chuẩn thi đấu USAPA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-orange-600 overflow-hidden">
        <div class="animate-marquee whitespace-nowrap">
            <span class="text-[60px] font-black uppercase text-black italic mx-10">JOOLA • SELKIRK • LUXX • VNB • SPORT Q&A • PICKLEBALL PASSION •</span>
            <span class="text-[60px] font-black uppercase text-black italic mx-10">JOOLA • SELKIRK • LUXX • VNB • SPORT Q&A • PICKLEBALL PASSION •</span>
        </div>
    </section>

    <section class="py-32 px-8">
        <div class="max-w-7xl mx-auto">
            <p class="text-center text-gray-500 text-[10px] font-bold uppercase tracking-[0.6em] mb-20">Đối Tác Ủy Quyền Chính Thức</p>
            <div class="flex flex-wrap justify-center items-center gap-20 opacity-30">
                <img src="{{ asset('images/logo-joola.png') }}" class="h-10 md:h-14 grayscale hover:grayscale-0 hover:opacity-100 transition duration-500 invert" alt="JOOLA Việt Nam">
                <img src="{{ asset('images/logo-selkirk.png') }}" class="h-10 md:h-14 grayscale hover:grayscale-0 hover:opacity-100 transition duration-500 invert" alt="Selkirk Việt Nam">
                <img src="{{ asset('images/logo-luxx.png') }}" class="h-10 md:h-14 grayscale hover:grayscale-0 hover:opacity-100 transition duration-500 invert" alt="LUXX Pickleball">
            </div>
        </div>
    </section>

    <footer class="bg-black pt-32 pb-16 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-start gap-16 mb-24">
                <div class="max-w-md">
                    <h2 class="text-4xl font-black text-white italic tracking-tighter mb-8 uppercase">Sport <span class="text-orange-500">Q&A</span></h2>
                    <p class="text-gray-500 leading-relaxed mb-8">Hệ thống phân phối dụng cụ Pickleball cao cấp hàng đầu Việt Nam. Tận tâm - Chuyên nghiệp - Chính hãng.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-orange-600 transition group"><span class="text-[10px] group-hover:scale-110">FB</span></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-orange-600 transition group"><span class="text-[10px] group-hover:scale-110">YT</span></a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-20">
                    <div class="space-y-6">
                        <h4 class="text-[10px] font-bold text-white uppercase tracking-widest">Sản Phẩm</h4>
                        <ul class="space-y-3 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-orange-500 transition">Vợt Pickleball</a></li>
                            <li><a href="#" class="hover:text-orange-500 transition">Bóng & Phụ Kiện</a></li>
                            <li><a href="#" class="hover:text-orange-500 transition">Thời Trang</a></li>
                        </ul>
                    </div>
                    <div class="space-y-6">
                        <h4 class="text-[10px] font-bold text-white uppercase tracking-widest">Hỗ Trợ</h4>
                        <ul class="space-y-3 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-orange-500 transition">Chính Sách Bảo Hành</a></li>
                            <li><a href="#" class="hover:text-orange-500 transition">Hướng Dẫn Chọn Vợt</a></li>
                            <li><a href="#" class="hover:text-orange-500 transition">Tuyển Đại Lý</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="pt-10 border-t border-white/5 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-widest">© 2026 Sport Q&A. Crafted with Passion for Pickleball.</p>
                <div class="flex gap-8 text-[9px] font-bold text-gray-600 uppercase tracking-widest">
                    <a href="#">Bảo mật</a>
                    <a href="#">Điều khoản</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('nav-active');
            } else {
                nav.classList.remove('nav-active');
            }
        });
    </script>
</body>
</html>