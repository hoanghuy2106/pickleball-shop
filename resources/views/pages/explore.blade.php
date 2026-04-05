<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khám Phá - SportQ&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .text-gradient { background: linear-gradient(to right, #f97316, #fb923c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .modal-animate { animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
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

    <main class="max-w-7xl mx-auto pt-48 pb-32 px-10">
        <div class="mb-24 text-center md:text-left">
            <span class="text-orange-500 font-black text-[10px] tracking-[0.5em] uppercase italic mb-4 block">Gia nhập cuộc chơi mới</span>
            <h2 class="text-6xl md:text-8xl font-black uppercase italic tracking-tighter leading-none">KHÁM PHÁ <br> <span class="text-gradient">THẾ GIỚI MỚI</span></h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-7 group relative h-[600px] rounded-[4rem] overflow-hidden border border-white/5 shadow-2xl transition-all duration-500 hover:border-orange-500/30">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1599586120429-48281b6f0ece?q=80&w=2070')] bg-cover bg-center transition-transform duration-700 group-hover:scale-110 opacity-40"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/20 to-transparent"></div>
                <div class="absolute bottom-16 left-16 right-16">
                    <span class="bg-orange-600/20 text-orange-500 px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest mb-6 inline-block border border-orange-500/20">Cộng đồng</span>
                    <h3 class="text-4xl font-black uppercase italic mb-4 tracking-tighter">Cộng đồng <br> Pickleball VN</h3>
                    <p class="text-gray-400 text-sm font-medium leading-relaxed max-w-sm mb-8">Nơi kết nối hàng nghìn người chơi đam mê, chia sẻ kỹ thuật.</p>
                    <a href="https://facebook.com" target="_blank" class="inline-flex items-center gap-4 bg-white text-black px-10 py-5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 hover:text-white transition-all shadow-xl">Tham gia ngay <span>→</span></a>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col gap-10">
                <div onclick="openTechModal()" class="h-full group relative rounded-[4rem] overflow-hidden border border-white/5 glass-card p-12 transition-all duration-500 hover:bg-orange-600 cursor-pointer">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <div class="w-16 h-16 bg-orange-600/10 rounded-3xl flex items-center justify-center mb-8 group-hover:bg-black/20 transition-colors">
                                <svg class="w-8 h-8 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h3 class="text-3xl font-black uppercase italic mb-4 tracking-tighter group-hover:text-white leading-tight">Công nghệ <br> Sợi Carbon</h3>
                        </div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest leading-loose group-hover:text-black/80">Tìm hiểu lý do T700 dẫn đầu.</p>
                    </div>
                </div>

                <div onclick="openRankModal()" class="bg-[#111] h-1/3 rounded-[3rem] border border-white/5 flex items-center justify-between px-10 hover:border-orange-500/50 transition-all group cursor-pointer">
                    <div class="flex flex-col">
                        <span class="text-orange-500 font-black text-[9px] uppercase tracking-widest mb-1 opacity-0 group-hover:opacity-100 transition-all">Elo Rating</span>
                        <span class="text-2xl font-black italic uppercase group-hover:text-orange-500 transition-colors">Bảng xếp hạng</span>
                    </div>
                    <div class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-black transition">→</div>
                </div>
            </div>
        </div>
    </main>

<div id="techModal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-6">
    <div class="absolute inset-0 bg-black/95 backdrop-blur-xl" onclick="closeTechModal()"></div>
    
    <div class="relative bg-[#111] border border-white/10 p-12 rounded-[4rem] max-w-4xl w-full shadow-2xl modal-animate overflow-hidden">
        <button onclick="closeTechModal()" class="absolute top-8 right-8 text-gray-500 hover:text-white font-black text-[10px] uppercase tracking-widest z-20 transition">Đóng [x]</button>
        
        <div class="mb-10">
            <span class="text-orange-500 font-black text-[10px] tracking-[0.5em] uppercase italic mb-4 block">Pickleball Lab</span>
            <h3 class="text-5xl font-black uppercase italic tracking-tighter">CÔNG NGHỆ <span class="text-gradient">LÕI VỢT</span></h3>
        </div>

        <div class="max-h-[500px] overflow-y-auto pr-6 custom-scrollbar space-y-12">
            
            <div class="group">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-orange-500 font-black text-2xl italic">01</span>
                    <h4 class="text-2xl font-black uppercase italic">Sợi Carbon T700 Raw</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <p class="text-gray-400 text-sm leading-relaxed">Tiêu chuẩn vàng cho Pro Player. Bề mặt nhám tự nhiên giúp bám bóng cực lâu, tạo ra những cú xoáy (spin) không thể cản phá.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">+45%</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Độ Xoáy</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">Elite</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Phân khúc</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-white/5">

            <div class="group">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-orange-500 font-black text-2xl italic">02</span>
                    <h4 class="text-2xl font-black uppercase italic">Lõi Polymer Honeycomb</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <p class="text-gray-400 text-sm leading-relaxed">Loại lõi phổ biến nhất thế giới. Cân bằng hoàn hảo giữa sức mạnh và kiểm soát, đồng thời giảm thiểu tiếng ồn tối đa.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">-30%</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Tiếng Ồn</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">All-Round</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Lối Chơi</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-white/5">

            <div class="group">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-orange-500 font-black text-2xl italic">03</span>
                    <h4 class="text-2xl font-black uppercase italic">Lõi Nomex (Hardcore)</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <p class="text-gray-400 text-sm leading-relaxed">Dành cho "Big Hitters". Lõi Nomex rất cứng, tạo ra lực đẩy lò xò và tiếng nổ đanh thép đặc trưng.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">+25%</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Tốc Độ</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">Power</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Đặc Tính</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-white/5">

            <div class="group">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-orange-500 font-black text-2xl italic">04</span>
                    <h4 class="text-2xl font-black uppercase italic">Lõi Nhôm (Aluminum)</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <p class="text-gray-400 text-sm leading-relaxed">Chuyên gia kiểm soát. Mang lại cảm giác bóng (touch) tuyệt vời nhất, lý tưởng cho những cú dink hiểm hóc trên lưới.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">100%</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Cảm Giác</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">Control</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Lối Chơi</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-white/5">

            <div class="group">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-orange-500 font-black text-2xl italic">05</span>
                    <h4 class="text-2xl font-black uppercase italic">Lõi Cao Su (EVA Foam)</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <p class="text-gray-400 text-sm leading-relaxed">Công nghệ triệt tiêu rung động. Giải pháp hoàn hảo cho người chơi bị đau khuỷu tay (Tennis Elbow).</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">Zero</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Độ Rung</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">Comfort</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Ưu Điểm</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-white/5">

            <div class="group">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-orange-500 font-black text-2xl italic">06</span>
                    <h4 class="text-2xl font-black uppercase italic">Lõi Lai Đa Tầng (Hybrid)</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <p class="text-gray-400 text-sm leading-relaxed">Đỉnh cao thiết kế 2026. Kết hợp Polymer và sợi Carbon đa lớp để mở rộng "điểm ngọt" tối đa trên mặt vợt.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">Max</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Sweet Spot</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center">
                            <b class="text-white block text-xl">Versatile</b>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-gray-500">Linh Hoạt</span>
                        </div>
                    </div>
                </div>
            </div>

        </div> </div> </div>

    <div id="rankModal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-6">
    <div class="absolute inset-0 bg-black/95 backdrop-blur-xl" onclick="closeRankModal()"></div>
    <div class="relative bg-[#111] border border-white/10 p-10 rounded-[4rem] max-w-2xl w-full shadow-2xl modal-animate overflow-hidden">
        <button onclick="closeRankModal()" class="absolute top-8 right-8 text-gray-500 hover:text-white font-black text-[10px] uppercase tracking-widest z-20">Đóng [x]</button>
        
        <div class="text-center mb-10">
            <span class="text-orange-500 font-black text-[10px] tracking-[0.5em] uppercase italic mb-2 block">Global Standings</span>
            <h3 class="text-4xl font-black uppercase italic tracking-tighter">SQA ELITE <span class="text-gradient">RANKING</span></h3>
        </div>

        <div class="space-y-3 max-h-[450px] overflow-y-auto pr-4 custom-scrollbar">
            @foreach($topPlayers as $key => $player)
                @php $isTop1 = ($key == 0); @endphp
                
                <div class="flex items-center justify-between p-5 rounded-3xl {{ $isTop1 ? 'bg-orange-600/10 border border-orange-500/20 group hover:bg-orange-600' : 'bg-white/5 border border-white/5' }} transition-all duration-300 mb-1">
                    <div class="flex items-center gap-6">
                        <span class="text-2xl font-black italic {{ $isTop1 ? 'text-orange-500 group-hover:text-white' : 'text-gray-600' }}">
                            {{ $key + 1 < 10 ? '0'.($key + 1) : ($key + 1) }}
                        </span>
                        <div>
                            <p class="text-white font-black uppercase text-sm {{ $isTop1 ? 'group-hover:text-black' : '' }}">
                                {{ $player->name }}
                            </p>
                            <p class="text-gray-500 text-[9px] uppercase font-bold tracking-widest {{ $isTop1 ? 'group-hover:text-black/60' : '' }}">
                                {{ $player->rank_title }} • {{ $player->region }}
                            </p>
                        </div>
                    </div>
                    <span class="text-xl font-black {{ $isTop1 ? 'text-white group-hover:text-black' : 'text-orange-500' }} italic">
                        {{ number_format($player->elo_points) }} PTS
                    </span>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-600 text-[10px] font-bold uppercase tracking-widest mb-4 italic">* Hệ thống Elo cập nhật mỗi 24h</p>
        </div>
    </div>
</div>

<style>
    /* Tùy chỉnh thanh cuộn riêng cho BXH */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f97316, #fb923c);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #f97316;
    }
</style>
            <div class="space-y-3">
    @foreach($topPlayers as $key => $player)
        @php $isTop1 = ($key == 0); @endphp
        
        <div class="flex items-center justify-between p-5 rounded-3xl {{ $isTop1 ? 'bg-orange-600/10 border border-orange-500/20 group hover:bg-orange-600' : 'bg-white/5 border border-white/5' }} transition-all duration-300">
            <div class="flex items-center gap-6">
                <span class="text-2xl font-black italic {{ $isTop1 ? 'text-orange-500 group-hover:text-white' : 'text-gray-600' }}">
                    0{{ $key + 1 }}
                </span>
                <div>
                    <p class="text-white font-black uppercase text-sm {{ $isTop1 ? 'group-hover:text-black' : '' }}">
                        {{ $player->name }}
                    </p>
                    <p class="text-gray-500 text-[9px] uppercase font-bold tracking-widest {{ $isTop1 ? 'group-hover:text-black/60' : '' }}">
                        {{ $player->rank_title }} • {{ $player->region }}
                    </p>
                </div>
            </div>
            <span class="text-xl font-black {{ $isTop1 ? 'text-white group-hover:text-black' : 'text-orange-500' }} italic">
                {{ number_format($player->elo_points) }} PTS
            </span>
        </div>
    @endforeach
</div>
    <script>
        // Logic Modal Công Nghệ
        function openTechModal() { document.getElementById('techModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function closeTechModal() { document.getElementById('techModal').classList.add('hidden'); document.body.style.overflow = 'auto'; }
        
        // Logic Modal BXH
        function openRankModal() { document.getElementById('rankModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function closeRankModal() { document.getElementById('rankModal').classList.add('hidden'); document.body.style.overflow = 'auto'; }
    </script>

    <footer class="py-20 text-center border-t border-white/5 opacity-50">
        <p class="text-[9px] font-black uppercase tracking-[0.5em]">© 2026 SportQ&A Elite Gear</p>
    </footer>

</body>
</html>