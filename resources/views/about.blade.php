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
        
        /* Hiệu ứng hạt bụi (Noise) */
        .noise {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://grainy-gradients.vercel.app/noise.svg');
            opacity: 0.05; pointer-events: none; z-index: 999;
        }

        /* Tiêu đề rỗng nghệ thuật */
        .text-stroke { -webkit-text-stroke: 1px rgba(255,255,255,0.2); color: transparent; }

        /* Chữ chạy nền */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee { display: flex; animation: marquee 30s linear infinite; }

        /* Thanh tiến trình cuộn */
        #progress-bar {
            position: fixed; top: 0; left: 0; width: 0%; height: 3px;
            background: linear-gradient(to right, #ea580c, #fb923c);
            z-index: 1000; transition: width 0.1s;
        }

        /* Nút Back to Top */
        #backToTop {
            position: fixed; bottom: 30px; right: 30px; z-index: 90;
            opacity: 0; visibility: hidden; transition: all 0.3s;
        }
        #backToTop.show { opacity: 1; visibility: visible; }
    </style>
</head>
<body class="antialiased">
    <div id="progress-bar"></div>
    <div class="noise"></div>

    <button id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="bg-orange-600 w-12 h-12 rounded-full flex items-center justify-center border border-white/20 shadow-2xl hover:bg-orange-700 hover:-translate-y-1 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7" />
        </svg>
    </button>

   <nav id="navbar" class="bg-black/80 backdrop-blur-xl fixed w-full z-[100] border-b border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-5 px-8">
        <a href="{{ url('/') }}">
            <h1 class="text-2xl font-black text-orange-500 tracking-tighter">SPORT Q&A</h1>
        </a>
        <div class="space-x-10 hidden md:flex items-center">
            <a href="{{ url('/') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Trang chủ</a>
            
            <a href="{{ url('/about') }}" class="text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Giới thiệu</a>
            
            <a href="{{ route('explore') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Khám phá</a>
            
            <a href="{{ route('support') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Hỗ trợ</a>
            
            <a href="{{ url('/products') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Sản phẩm</a>
            <a href="{{ url('/contact') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Liên hệ</a>
            
            @auth
                <div class="flex items-center space-x-5 border-l pl-8 border-white/10">
                    <a href="{{ route('profile') }}" class="group flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-orange-600 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold uppercase text-white group-hover:text-orange-500 transition-colors">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            @else
                <a href="{{ url('/login') }}" class="bg-orange-600 text-white px-7 py-2.5 rounded-full font-black text-[10px] tracking-widest shadow-lg hover:bg-orange-700 transition active:scale-95">ĐĂNG NHẬP</a>
            @endauth
        </div>
    </div>
</nav>
    <section class="relative min-h-screen flex items-center justify-center pt-20">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-black z-10"></div>
            <img src="https://images.unsplash.com/photo-1626224580173-909904f03407?q=80&w=2070" class="w-full h-full object-cover opacity-60" alt="Pickleball">
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
                    <p>Tại <span class="text-white font-bold">Sport Q&A</span>, chúng tôi kiến tạo nên phong cách sống năng động thông qua bộ môn Pickleball.</p>
                    <p>Mỗi cú đánh đều là sự kết hợp giữa kỹ thuật và thiết bị hoàn hảo. Đó là lý do chúng tôi chỉ phân phối những dòng vợt chuẩn quốc tế.</p>
                </div>

                <div class="grid grid-cols-2 gap-10">
                    <div>
                        <h4 class="text-3xl font-black text-white italic counter" data-target="5000">0+</h4>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-2">Vận Động Viên Tin Dùng</p>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black text-white italic counter" data-target="100">0%</h4>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-2">Cam Kết Chính Hãng</p>
                    </div>
                </div>
            </div>

            <div class="relative group" data-aos="fade-left">
                <div class="absolute -inset-4 bg-orange-600/10 blur-3xl rounded-full opacity-30 group-hover:opacity-50 transition duration-700"></div>
                <img src="https://images.unsplash.com/photo-1599586120429-48281b6f0ece?q=80&w=2070" class="relative rounded-3xl border border-white/10 shadow-2xl transition duration-700 group-hover:scale-[1.02]" alt="Pickleball Life">
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto py-20 px-8" data-aos="zoom-in">
        <div class="bg-white/5 border border-white/10 rounded-3xl p-10 text-center backdrop-blur-xl">
            <h3 class="text-2xl font-black uppercase italic mb-6">Bạn thuộc hệ chơi nào?</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <button onclick="recommend('newbie')" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-[10px] font-bold uppercase tracking-widest hover:bg-orange-600 transition">Người mới</button>
                <button onclick="recommend('power')" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-[10px] font-bold uppercase tracking-widest hover:bg-orange-600 transition">Sức mạnh (Power)</button>
                <button onclick="recommend('control')" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-[10px] font-bold uppercase tracking-widest hover:bg-orange-600 transition">Kiểm soát (Control)</button>
            </div>
            <div id="recommendation-result" class="mt-8 text-orange-500 font-bold italic hidden animate-pulse"></div>
        </div>
    </section>

    <section class="py-12 bg-orange-600 overflow-hidden">
        <div class="animate-marquee whitespace-nowrap">
            <span class="text-[60px] font-black uppercase text-black italic mx-10">JOOLA • SELKIRK • LUXX • VNB • SPORT Q&A • PICKLEBALL PASSION •</span>
            <span class="text-[60px] font-black uppercase text-black italic mx-10">JOOLA • SELKIRK • LUXX • VNB • SPORT Q&A • PICKLEBALL PASSION •</span>
        </div>
    </section>

    <footer class="bg-black pt-32 pb-16 border-t border-white/5 text-center">
        <p class="text-[10px] font-bold text-gray-600 uppercase tracking-widest">© 2026 Sport Q&A. Crafted with Passion for Pickleball.</p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });

        // 1. Thanh tiến trình, Navbar và Nút Back to Top
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            const btt = document.getElementById('backToTop');
            const scrollMax = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (window.scrollY / scrollMax) * 100;
            
            document.getElementById('progress-bar').style.width = scrolled + '%';
            
            if (window.scrollY > 50) nav.style.background = "rgba(0,0,0,0.95)";
            else nav.style.background = "rgba(0,0,0,0.8)";

            if (window.scrollY > 500) btt.classList.add('show');
            else btt.classList.remove('show');
        });

        // 2. Chức năng gợi ý nhanh
        function recommend(type) {
            const result = document.getElementById('recommendation-result');
            result.classList.remove('hidden');
            let text = "";
            if(type === 'newbie') text = "👉 Gợi ý cho bạn: Dòng vợt JOOLA Essentials - Dễ chơi, bền bỉ!";
            if(type === 'power') text = "👉 Gợi ý cho bạn: Selkirk Vanguard Power Air - Cực đại sức mạnh!";
            if(type === 'control') text = "👉 Gợi ý cho bạn: JOOLA Perseus 16mm - Kiểm soát tuyệt đối!";
            result.innerText = text;
        }

        // 3. Hiệu ứng đếm số (Counter Up)
        const counters = document.querySelectorAll('.counter');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    const target = entry.target;
                    const targetValue = parseInt(target.getAttribute('data-target'));
                    let current = 0;
                    const duration = 2000; // 2 giây
                    const step = targetValue / (duration / 30);

                    const timer = setInterval(() => {
                        current += step;
                        if(current >= targetValue) {
                            target.innerText = targetValue + (target.innerText.includes('%') || target.getAttribute('data-target') === "100" ? '%' : '+');
                            clearInterval(timer);
                        } else {
                            target.innerText = Math.floor(current) + (target.innerText.includes('%') || target.getAttribute('data-target') === "100" ? '%' : '+');
                        }
                    }, 30);
                    observer.unobserve(target);
                }
            });
        }, { threshold: 1 });
        counters.forEach(c => observer.observe(c));
    </script>
</body>
</html>