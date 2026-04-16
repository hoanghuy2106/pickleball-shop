<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khám Phá - Sport Q&A Elite Gear</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; overflow-x: hidden; }
        
        /* Hiệu ứng kính và viền sáng */
        .glass-card { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .text-gradient { background: linear-gradient(to right, #f97316, #fb923c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        /* Luồng sáng theo chuột */
        #cursor-glow {
            position: fixed; top: 0; left: 0; width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.08) 0%, transparent 70%);
            border-radius: 50%; pointer-events: none; z-index: 0; transform: translate(-50%, -50%);
        }

        /* Animation cho Modal */
        .modal-animate { animation: modalIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes modalIn { from { opacity: 0; transform: scale(0.9) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.02); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }

        /* Hiệu ứng Card nghiêng */
        .tilt-card { transition: transform 0.2s ease-out; transform-style: preserve-3d; }
    </style>
</head>
<body class="antialiased">
    <div id="cursor-glow"></div>

    <nav class="bg-black/80 backdrop-blur-xl fixed w-full z-[100] border-b border-white/5">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-5 px-8">
        <a href="{{ url('/') }}">
            <h1 class="text-2xl font-black text-orange-500 tracking-tighter">SPORT Q&A</h1>
        </a>
        <div class="space-x-10 hidden md:flex items-center">
            <a href="{{ url('/') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Trang chủ</a>
            <a href="{{ url('/about') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Giới thiệu</a>
            
            <a href="{{ route('explore') }}" class="text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Khám phá</a>
            
            <a href="{{ route('support') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Hỗ trợ</a>
            
            <a href="{{ url('/products') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Sản phẩm</a>
            <a href="{{ url('/contact') }}" class="text-gray-400 hover:text-orange-500 font-bold text-[11px] uppercase tracking-widest transition">Liên hệ</a>
            
            @auth
                <div class="flex items-center space-x-5 border-l pl-8 border-white/10">
                    <span class="text-[10px] font-bold uppercase text-white tracking-widest">{{ Auth::user()->name }}</span>
                </div>
            @else
                <a href="{{ url('/login') }}" class="bg-orange-600 text-white px-7 py-2.5 rounded-full font-black text-[10px] tracking-widest hover:bg-orange-700 transition">ĐĂNG NHẬP</a>
            @endauth
        </div>
    </div>
</nav>

    <main class="max-w-7xl mx-auto pt-48 pb-32 px-8 relative z-10">
        <div class="mb-24 text-center md:text-left">
            <span class="text-orange-500 font-black text-[10px] tracking-[0.5em] uppercase italic mb-4 block">Gia nhập cuộc chơi mới</span>
            <h2 class="text-6xl md:text-8xl font-black uppercase italic tracking-tighter leading-none">KHÁM PHÁ <br> <span class="text-gradient">THẾ GIỚI MỚI</span></h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div id="mainCard" class="lg:col-span-7 group relative h-[600px] rounded-[4rem] overflow-hidden border border-white/5 shadow-2xl tilt-card">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1599586120429-48281b6f0ece?q=80&w=2070')] bg-cover bg-center transition-transform duration-700 group-hover:scale-110 opacity-40"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent"></div>
                <div class="absolute bottom-16 left-16 right-16">
                    <span class="bg-orange-600/20 text-orange-500 px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest mb-6 inline-block border border-orange-500/20">Cộng đồng</span>
                    <h3 class="text-4xl font-black uppercase italic mb-4 tracking-tighter">Cộng đồng <br> Pickleball VN</h3>
                    <p class="text-gray-400 text-sm font-medium mb-8 max-w-sm">Nơi kết nối hàng nghìn người chơi đam mê, chia sẻ kỹ thuật và kinh nghiệm thực chiến.</p>
                    <a href="#" class="inline-flex items-center gap-4 bg-white text-black px-10 py-5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 hover:text-white transition-all">Tham gia ngay <span>→</span></a>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col gap-10">
                <div onclick="openTechModal()" class="flex-1 group relative rounded-[4rem] overflow-hidden glass-card p-12 transition-all duration-500 hover:bg-orange-600 cursor-pointer">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <div class="w-16 h-16 bg-orange-600/10 rounded-3xl flex items-center justify-center mb-8 group-hover:bg-black/20 transition-colors">
                                <svg class="w-8 h-8 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h3 class="text-3xl font-black uppercase italic mb-4 tracking-tighter group-hover:text-white leading-tight">Công nghệ <br> Sợi Carbon</h3>
                        </div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest group-hover:text-black/80">Tìm hiểu lý do T700 dẫn đầu thị trường.</p>
                    </div>
                </div>

                <div onclick="openRankModal()" class="bg-[#111] h-[180px] rounded-[3rem] border border-white/5 flex items-center justify-between px-10 hover:border-orange-500/50 transition-all group cursor-pointer">
                    <div class="flex flex-col">
                        <span class="text-orange-500 font-black text-[9px] uppercase tracking-widest mb-1 opacity-0 group-hover:opacity-100 transition-all">Elo Rating System</span>
                        <span class="text-2xl font-black italic uppercase group-hover:text-orange-500 transition-colors">Bảng xếp hạng Elite</span>
                    </div>
                    <div class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-black transition">→</div>
                </div>
            </div>
        </div>
    </main>

    <div id="techModal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-black/95 backdrop-blur-xl" onclick="closeTechModal()"></div>
        <div class="relative bg-[#0d0d0d] border border-white/10 p-12 rounded-[4rem] max-w-4xl w-full modal-animate">
            <button onclick="closeTechModal()" class="absolute top-8 right-8 text-gray-500 hover:text-white uppercase text-[10px] font-black tracking-widest transition">Đóng [x]</button>
            <h3 class="text-5xl font-black uppercase italic tracking-tighter mb-12">CÔNG NGHỆ <span class="text-gradient">LÕI VỢT</span></h3>
            
            <div class="max-h-[450px] overflow-y-auto pr-6 custom-scrollbar space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-6 border-b border-white/5">
                    <div>
                        <span class="text-orange-500 font-black text-xl italic block mb-2">01. Carbon T700 Raw</span>
                        <p class="text-gray-400 text-sm leading-relaxed">Bề mặt nhám tự nhiên giúp bám bóng cực lâu, tạo ra những cú xoáy (spin) không thể cản phá.</p>
                    </div>
                    <div class="flex gap-4 items-center">
                        <div class="bg-white/5 p-4 rounded-2xl flex-1 text-center font-black italic">+45% <span class="text-[8px] block not-italic text-gray-500 uppercase">Độ xoáy</span></div>
                        <div class="bg-white/5 p-4 rounded-2xl flex-1 text-center font-black italic">PRO <span class="text-[8px] block not-italic text-gray-500 uppercase">Cấp độ</span></div>
                    </div>
                </div>
                </div>
        </div>
    </div>

    <div id="rankModal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-black/95 backdrop-blur-xl" onclick="closeRankModal()"></div>
        <div class="relative bg-[#0d0d0d] border border-white/10 p-10 rounded-[4rem] max-w-2xl w-full modal-animate">
            <button onclick="closeRankModal()" class="absolute top-8 right-8 text-gray-500 hover:text-white uppercase text-[10px] font-black tracking-widest transition">Đóng [x]</button>
            <div class="text-center mb-10">
                <span class="text-orange-500 font-black text-[10px] tracking-[0.5em] uppercase italic mb-2 block">Global Standings</span>
                <h3 class="text-4xl font-black uppercase italic tracking-tighter">SQA ELITE <span class="text-gradient">RANKING</span></h3>
            </div>

            <div class="space-y-3 max-h-[400px] overflow-y-auto pr-4 custom-scrollbar">
                @foreach($topPlayers as $key => $player)
                    <div class="flex items-center justify-between p-5 rounded-3xl bg-white/5 border border-white/5 hover:bg-orange-600 transition-all duration-300 group">
                        <div class="flex items-center gap-6">
                            <span class="text-2xl font-black italic text-gray-600 group-hover:text-white">0{{ $key + 1 }}</span>
                            <div>
                                <p class="text-white font-black uppercase text-sm group-hover:text-black">{{ $player->name }}</p>
                                <p class="text-gray-500 text-[9px] uppercase font-bold tracking-widest group-hover:text-black/60">{{ $player->rank_title }}</p>
                            </div>
                        </div>
                        <span class="text-xl font-black text-orange-500 italic group-hover:text-black">{{ number_format($player->elo_points) }} PTS</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const glow = document.getElementById('cursor-glow');
        const mainCard = document.getElementById('mainCard');

        // Hiệu ứng chuột
        document.addEventListener('mousemove', (e) => {
            // Glow chạy theo chuột
            glow.style.left = e.clientX + 'px';
            glow.style.top = e.clientY + 'px';

            // Parallax Tilt cho Card
            const rect = mainCard.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 25;
            const rotateY = (centerX - x) / 25;

            mainCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        mainCard.addEventListener('mouseleave', () => {
            mainCard.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg)`;
        });

        // Modals
        function openTechModal() { document.getElementById('techModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function closeTechModal() { document.getElementById('techModal').classList.add('hidden'); document.body.style.overflow = 'auto'; }
        
        function openRankModal() { document.getElementById('rankModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function closeRankModal() { document.getElementById('rankModal').classList.add('hidden'); document.body.style.overflow = 'auto'; }
    </script>
</body>
</html>