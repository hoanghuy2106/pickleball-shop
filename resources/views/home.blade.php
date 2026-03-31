<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickleball SportQ&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; }
        .swiper { width: 100%; height: 600px; } 
        .swiper-slide { position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .slide-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,10,10,0.9), rgba(10,10,10,0.2)); z-index: 1; }
        .slide-content { position: relative; z-index: 10; color: white; text-align: center; }
        .swiper-slide-active img { transform: scale(1.08); transition: transform 10s ease; }
        .swiper-pagination-bullet { background: #fff !important; opacity: 0.5; }
        .swiper-pagination-bullet-active { background: #f97316 !important; opacity: 1; width: 25px !important; border-radius: 10px !important; }
    </style>
</head>
<body class="antialiased">

    <nav class="bg-black/80 backdrop-blur-xl fixed w-full z-[100] border-b border-white/5">
        <div class="max-w-7xl mx-auto flex justify-between items-center p-5 px-8">
            <a href="{{ url('/') }}">
                <h1 class="text-2xl font-black text-orange-500 tracking-tighter">SPORT Q&A<span class="text-white"></span></h1>
            </a>
            <div class="space-x-10 hidden md:flex items-center">
                <a href="{{ url('/') }}" class="text-orange-500 font-bold text-[11px] uppercase tracking-widest">Trang chủ</a>
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
    
</div>
                @else
                    <a href="{{ url('/login') }}" class="bg-orange-600 text-white px-7 py-2.5 rounded-full font-black text-[10px] tracking-widest shadow-lg hover:bg-orange-700 transition active:scale-95">ĐĂNG NHẬP</a>
                @endguest
            </div>
        </div>
    </nav>

    <header class="pt-0">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide bg-black">
                    <img src="images/banner-joola.jpg" class="absolute inset-0 w-full h-full object-cover opacity-60">
                    <div class="slide-overlay"></div>
                    <div class="slide-content max-w-3xl px-6">
                        <h2 class="text-4xl md:text-7xl font-black mb-6 tracking-tighter uppercase leading-tight italic">Nâng Tầm <span class="text-orange-500">Trận Đấu</span></h2>
                        <p class="text-sm md:text-base text-gray-400 mb-10 max-w-xl mx-auto font-medium leading-relaxed">Sở hữu siêu phẩm JOOLA Perseus Heat Vision - Đỉnh cao công nghệ Carbon từ Ben Johns.</p>
                        <a href="{{ url('/products') }}">
                            <button class="bg-orange-600 text-white px-12 py-4 rounded-full font-black uppercase text-xs tracking-[0.2em] shadow-2xl hover:bg-white hover:text-black transition-all active:scale-95">Mua Ngay</button>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide bg-black">
                    <img src="images/banner-CRBN.jpg" class="absolute inset-0 w-full h-full object-cover opacity-60">
                    <div class="slide-overlay"></div>
                    <div class="slide-content max-w-3xl px-6">
                        <h2 class="text-4xl md:text-7xl font-black mb-6 tracking-tighter uppercase leading-tight italic">Bứt Phá <span class="text-orange-500">Giới Hạn</span></h2>
                        <p class="text-sm md:text-base text-gray-400 mb-10 max-w-xl mx-auto font-medium leading-relaxed">Khám phá bộ sưu tập thiết bị chuyên nghiệp dành cho các chiến thần Pickleball.</p>
                        <a href="{{ url('/products') }}">
                            <button class="bg-white text-black px-12 py-4 rounded-full font-black uppercase text-xs tracking-[0.2em] shadow-2xl hover:bg-orange-600 hover:text-white transition-all active:scale-95">Khám Phá</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </header>

    <section class="max-w-7xl mx-auto -mt-16 relative z-20 px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#151515] p-8 rounded-[2rem] shadow-2xl border border-white/5 flex items-center gap-6 group hover:border-orange-500/50 transition-all">
            <span class="text-4xl group-hover:scale-110 transition">🛡️</span>
            <div><h3 class="font-black text-white uppercase text-xs tracking-widest mb-1">Chính Hãng 100%</h3><p class="text-gray-500 text-xs">Bảo hành dài hạn từ NSX.</p></div>
        </div>
        <div class="bg-[#151515] p-8 rounded-[2rem] shadow-2xl border border-white/5 flex items-center gap-6 group hover:border-orange-500/50 transition-all">
            <span class="text-4xl group-hover:scale-110 transition">⚡</span>
            <div><h3 class="font-black text-white uppercase text-xs tracking-widest mb-1">Giao Siêu Tốc</h3><p class="text-gray-500 text-xs">Ship nội thành trong 2h.</p></div>
        </div>
        <div class="bg-[#151515] p-8 rounded-[2rem] shadow-2xl border border-white/5 flex items-center gap-6 group hover:border-orange-500/50 transition-all">
            <span class="text-4xl group-hover:scale-110 transition">🎧</span>
            <div><h3 class="font-black text-white uppercase text-xs tracking-widest mb-1">Hỗ Trợ 24/7</h3><p class="text-gray-500 text-xs">Tư vấn chuyên môn sâu.</p></div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto py-24 px-8">
        <div class="flex justify-between items-end mb-16">
            <div>
                <h3 class="text-4xl font-black text-white tracking-tighter uppercase italic">Sản Phẩm <span class="text-orange-500">Nổi Bật</span></h3>
                <p class="text-gray-500 text-sm font-medium mt-2">Được tin dùng bởi các vận động viên hàng đầu thế giới.</p>
            </div>
            <a href="{{ url('/products') }}" class="text-gray-400 font-black text-xs uppercase tracking-[0.2em] hover:text-orange-500 transition">Xem tất cả →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            <div class="bg-[#111] p-6 rounded-[2.5rem] shadow-2xl hover:shadow-orange-900/10 transition-all duration-500 group border border-white/5 flex flex-col relative overflow-hidden">
                <div class="h-64 bg-[#1a1a1a] rounded-[2rem] mb-6 flex items-center justify-center overflow-hidden relative group-hover:bg-[#222] transition-colors">
                    <img src="images/joola-p.png" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-80 group-hover:opacity-100">
                    <span class="absolute top-5 left-5 bg-orange-600 px-3 py-1 rounded-full text-[10px] font-black uppercase text-white shadow-lg">HOT</span>
                </div>
                <div class="px-2">
                    <h4 class="text-xl font-bold text-white mb-2 group-hover:text-orange-500 transition">Joola Perseus 16mm</h4>
                    <p class="text-gray-500 text-xs mb-6 line-clamp-2 leading-relaxed italic">Dòng vợt biểu tượng của Ben Johns với mặt Carbon mài tăng độ xoáy tối thượng.</p>
                    <div class="flex justify-between items-center border-t border-white/5 pt-6">
                        <span class="text-2xl font-black text-white tracking-tighter">5.450.000<span class="text-sm text-gray-600 ml-1">đ</span></span>
                        <button class="bg-white text-black px-6 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-orange-600 hover:text-white transition shadow-xl active:scale-95">Chi tiết</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<footer class="bg-[#050505] pt-24 pb-12 border-t border-white/5 relative overflow-hidden">
    <div class="absolute top-0 left-1/4 w-64 h-64 bg-orange-600/5 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-orange-900/5 blur-[150px] rounded-full"></div>

    <div class="max-w-7xl mx-auto px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
            
            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl font-black text-orange-500 tracking-tighter uppercase italic">
                        SPORTQ&A<span class="text-white"></span>
                    </h2>
                    <p class="mt-4 text-gray-500 text-xs leading-relaxed font-medium uppercase italic tracking-wider">
                        Nâng tầm trải nghiệm Pickleball chuyên nghiệp. Chúng tôi cung cấp những siêu phẩm dẫn đầu công nghệ thi đấu.
                    </p>
                </div>
                
                <div class="flex gap-4">
                    <a href="https://www.facebook.com/sport.qa?locale=vi_VN%2F" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-orange-600 hover:border-orange-600 transition-all duration-300 group shadow-lg">
                        <svg class="w-5 h-5 fill-white group-hover:scale-110 transition-transform" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.792 5 15.536 5H18V0h-3.977C10.038 0 9 2.105 9 5.589V8z"/></svg>
                    </a>
                    
                    <a href="https://zalo.me/g/ljdtiy106" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-[#0068FF] hover:border-[#0068FF] transition-all duration-300 group shadow-lg text-white font-black text-[10px] italic">
                        <span class="group-hover:scale-110 transition-transform">Zalo</span>
                    </a>
                    
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white hover:border-white transition-all duration-300 group shadow-lg">
                        <svg class="w-5 h-5 fill-white group-hover:fill-black group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.01.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.89-.6-4.09-1.47-.77-.56-1.44-1.27-1.97-2.09-.01 3-.02 6-.02 9 0 1.51-.33 3.04-1.08 4.34-.82 1.44-2.11 2.61-3.64 3.19-1.53.58-3.23.63-4.8.19-1.57-.44-2.95-1.4-3.89-2.69-.94-1.29-1.39-2.92-1.39-4.52 0-1.6 0-3.21 0-4.81.01-.13.06-.27.13-.39.6-.8 1.43-1.44 2.36-1.84 1.11-.47 2.37-.62 3.59-.4 1.22.21 2.36.8 3.23 1.64.12-.12.24-.24.36-.36V0h0z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-white font-black text-[11px] uppercase tracking-[0.3em] mb-8 border-l-2 border-orange-500 pl-4">Khám phá</h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-gray-500 hover:text-orange-500 text-[10px] font-bold uppercase transition-colors italic tracking-widest">Sản phẩm mới</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-orange-500 text-[10px] font-bold uppercase transition-colors italic tracking-widest">Bảng xếp hạng Vợt</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-orange-500 text-[10px] font-bold uppercase transition-colors italic tracking-widest">Cộng đồng SQ&A</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-black text-[11px] uppercase tracking-[0.3em] mb-8 border-l-2 border-orange-500 pl-4">Hỗ trợ</h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-gray-500 hover:text-orange-500 text-[10px] font-bold uppercase transition-colors italic tracking-widest">Chính sách bảo hành</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-orange-500 text-[10px] font-bold uppercase transition-colors italic tracking-widest">Vận chuyển hỏa tốc</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-orange-500 text-[10px] font-bold uppercase transition-colors italic tracking-widest">Hướng dẫn chọn vợt</a></li>
                </ul>
            </div>

            <div class="bg-white/5 p-6 rounded-[2rem] border border-white/5 backdrop-blur-sm shadow-2xl">
                <h3 class="text-white font-black text-[11px] uppercase tracking-[0.2em] mb-4">Gia nhập đội quân</h3>
                <p class="text-gray-500 text-[9px] font-bold uppercase mb-4 tracking-tight">Nhận ưu đãi sớm nhất từ SPORTQ&A</p>
                <div class="relative group">
                    <input type="text" placeholder="Email của bạn..." class="w-full bg-black border border-white/10 rounded-xl px-4 py-3 text-[10px] text-white focus:outline-none focus:border-orange-500 transition-all">
                    <button class="absolute right-1.5 top-1.5 bottom-1.5 bg-orange-600 hover:bg-orange-700 text-white px-4 rounded-lg text-[9px] font-black uppercase transition-all active:scale-95">Gửi</button>
                </div>
            </div>
        </div>

        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(249,115,22,0.8)]"></span>
                <p class="text-gray-600 text-[9px] font-bold uppercase tracking-[0.2em]">© 2026 Crafted by <span class="text-white font-black">SPORTQ&A</span></p>
            </div>
            <div class="flex gap-8">
                <p class="text-gray-700 text-[8px] font-black uppercase italic tracking-tighter hover:text-gray-400 cursor-pointer transition">Privacy Policy</p>
                <p class="text-gray-700 text-[8px] font-black uppercase italic tracking-tighter hover:text-gray-400 cursor-pointer transition">Terms of Service</p>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true, effect: "fade", speed: 1000, fadeEffect: { crossFade: true },
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
        });
    </script>
</body>
</html>