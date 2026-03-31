<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ - SPORTQ&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white">

<nav class="fixed top-0 w-full z-50 bg-black/90 backdrop-blur-md border-b border-white/5 px-8 py-4 flex justify-between items-center">
    <a href="{{ url('/') }}" class="flex-shrink-0">
        <h1 class="text-2xl font-black text-orange-500 tracking-tighter uppercase italic">
            SPORTQ&A<span class="text-white"></span>
        </h1>
    </a>

    <div class="flex items-center space-x-10">
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ url('/') }}" class="text-[10px] font-black uppercase tracking-[0.2em] hover:text-orange-500 transition-colors">Trang chủ</a>
            <a href="{{ url('/products') }}" class="text-[10px] font-black uppercase tracking-[0.2em] hover:text-orange-500 transition-colors">Sản phẩm</a>
            <a href="#" class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500 italic border-b border-orange-500/50">Liên hệ</a>
        </div>

        <div class="h-4 w-[1px] bg-white/10 hidden md:block"></div>

        <div class="flex items-center">
            @guest
                <a href="{{ url('/login') }}" class="bg-orange-600 text-white px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-orange-700 transition-all active:scale-95 shadow-lg shadow-orange-600/20">
                    Đăng nhập
                </a>
            @endguest

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
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-white hover:text-black transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
<section class="relative pt-48 pb-24 overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-orange-600/10 via-transparent to-transparent"></div>
    <div class="max-w-7xl mx-auto px-8 relative z-10 text-center">
        <h2 class="text-7xl md:text-9xl font-black italic tracking-tighter uppercase mb-4 leading-none">
            Get In <span class="text-orange-500">Touch</span>
        </h2>
        <div class="flex items-center justify-center gap-4">
            <span class="h-[1px] w-12 bg-orange-500/50"></span>
            <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] italic text-center">Đồng hành cùng đam mê của bạn</p>
            <span class="h-[1px] w-12 bg-orange-500/50"></span>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto py-12 px-8 grid lg:grid-cols-12 gap-16">
    <div class="lg:col-span-5 space-y-12">
        <div>
            <h3 class="text-xl font-black uppercase italic mb-8 border-l-4 border-orange-500 pl-4 tracking-widest">Thông tin kết nối</h3>
            <div class="space-y-6">
                <div class="group flex items-center gap-5 p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/30 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-orange-600/10 flex items-center justify-center text-orange-500 text-xl shadow-inner">📍</div>
                    <div>
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest">Trụ sở chính</p>
                        <p class="text-sm font-bold italic tracking-tight">C/c Plazza 2, Ngõ 2 Nguyễn Hoàng, Mỹ Đình, Hà Nội</p>
                    </div>
                </div>
                <div class="group flex items-center gap-5 p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/30 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-orange-600/10 flex items-center justify-center text-orange-500 text-xl shadow-inner">📞</div>
                    <div>
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest">Hotline 24/7</p>
                        <p class="text-sm font-bold italic tracking-tight text-orange-500">0982 472 823</p>
                    </div>
                </div>
                <div class="group flex items-center gap-5 p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/30 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-orange-600/10 flex items-center justify-center text-orange-500 text-xl shadow-inner">📧</div>
                    <div>
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest">Email Partner</p>
                        <p class="text-sm font-bold italic tracking-tight uppercase">support@sportqa.vn</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="group relative rounded-[2rem] overflow-hidden border border-white/10 shadow-2xl">
            <div class="absolute inset-0 bg-orange-600/5 pointer-events-none group-hover:opacity-0 transition-opacity"></div>
            <iframe class="w-full h-72 grayscale invert group-hover:grayscale-0 group-hover:invert-0 transition-all duration-700" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.924198223689!2d105.77366341142512!3d21.03572048744888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b5f8841499%3A0xc391b1065908200!2zUGxhemEgMiwgMiBOZ3V54buFbiBIb8Ogbmc!5e0!3m2!1svi!2s!4v1711882000000" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <div class="lg:col-span-7 bg-white/[0.03] p-10 rounded-[3rem] border border-white/5 backdrop-blur-xl relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-600/10 blur-[80px] rounded-full"></div>
        <h3 class="text-2xl font-black uppercase italic mb-10 relative z-10">Gửi <span class="text-orange-500">Phản hồi</span></h3>
        
        <form class="space-y-6 relative z-10">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Danh tính của bạn</label>
                    <input type="text" placeholder="HỌ VÀ TÊN..." class="w-full bg-black/50 border border-white/10 rounded-2xl px-6 py-4 text-[11px] font-bold text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Địa chỉ Email</label>
                    <input type="email" placeholder="EMAIL@EXAMPLE.COM" class="w-full bg-black/50 border border-white/10 rounded-2xl px-6 py-4 text-[11px] font-bold text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600 transition-all">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Lời nhắn</label>
                <textarea placeholder="NỘI DUNG TƯ VẤN..." class="w-full bg-black/50 border border-white/10 rounded-2xl px-6 py-4 h-44 text-[11px] font-bold text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600 transition-all resize-none"></textarea>
            </div>

            <button type="submit" class="group w-full bg-orange-600 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] italic hover:bg-white hover:text-black transition-all duration-500 shadow-xl shadow-orange-600/20 flex items-center justify-center gap-3">
                Gửi yêu cầu ngay
                <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>
    </div>
</main>

<footer class="bg-black pt-24 pb-12 border-t border-white/5 mt-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-8 text-center relative z-10">
        <h2 class="text-4xl font-black text-orange-500 tracking-tighter uppercase italic mb-6">SPORTQ&A<span class="text-white">.</span></h2>
        
        <div class="flex justify-center gap-4 mb-10">
             <a href="https://www.facebook.com/sport.qa" target="_blank" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-orange-600 hover:scale-110 transition-all">
                <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.792 5 15.536 5H18V0h-3.977C10.038 0 9 2.105 9 5.589V8z"/></svg>
            </a>
            <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-blue-600 hover:scale-110 transition-all text-[10px] font-black italic uppercase">Zalo</a>
            <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white hover:text-black hover:scale-110 transition-all">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.01.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.89-.6-4.09-1.47-.77-.56-1.44-1.27-1.97-2.09-.01 3-.02 6-.02 9 0 1.51-.33 3.04-1.08 4.34-.82 1.44-2.11 2.61-3.64 3.19-1.53.58-3.23.63-4.8.19-1.57-.44-2.95-1.4-3.89-2.69-.94-1.29-1.39-2.92-1.39-4.52 0-1.6 0-3.21 0-4.81.01-.13.06-.27.13-.39.6-.8 1.43-1.44 2.36-1.84 1.11-.47 2.37-.62 3.59-.4 1.22.21 2.36.8 3.23 1.64.12-.12.24-.24.36-.36V0h0z"/></svg>
            </a>
        </div>

        <div class="space-y-2">
            <p class="text-gray-600 text-[10px] font-black uppercase tracking-[0.5em]">© 2026 Developed by <span class="text-white">SPORTQ&A Team</span></p>
            <p class="text-gray-800 text-[8px] font-bold uppercase tracking-widest">Vietnam Excellence in Pickleball</p>
        </div>
    </div>
</footer>

</body>
</html>