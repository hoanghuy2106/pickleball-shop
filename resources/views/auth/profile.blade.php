<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Auth::user()->role === 'admin' ? 'Hệ thống Admin' : 'Hồ sơ cá nhân' }} - SPORT Q&A</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #0a0a0a; 
            color: #eee; 
            overflow-x: hidden;
        }
        .glass-card { 
            background: rgba(255, 255, 255, 0.03); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(255, 255, 255, 0.08); 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-field { 
            background: rgba(255, 255, 255, 0.05); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 1rem; 
            color: white; 
            transition: all 0.3s; 
        }
        .input-field:focus { 
            border-color: #ea580c; 
            background: rgba(234, 88, 12, 0.08); 
            outline: none; 
            box-shadow: 0 0 20px rgba(234, 88, 12, 0.15);
        }
        .status-badge { 
            padding: 4px 12px; 
            border-radius: 20px; 
            font-size: 9px; 
            font-weight: 900; 
            text-transform: uppercase; 
            letter-spacing: 0.05em; 
            display: inline-block;
        }
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); }
        .custom-scroll::-webkit-scrollbar-thumb { background: #ea580c; border-radius: 10px; }
        .scroll-container { position: relative; }
        .scroll-container::after {
            content: ''; 
            position: absolute; 
            bottom: 0; 
            left: 0; 
            right: 0;
            height: 40px; 
            pointer-events: none;
            background: linear-gradient(to top, rgba(10, 10, 10, 0.5), transparent);
            border-bottom-left-radius: 3rem; 
            border-bottom-right-radius: 3rem;
        }
        .tab-content.hidden { display: none; }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased">
    <div class="max-w-[1440px] mx-auto py-16 px-8 md:px-16">
        
        @if(session('success'))
        <div id="success-alert" class="fixed top-5 right-5 z-50 bg-orange-600 text-white px-6 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-2xl animate-bounce">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
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
                <span class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-2">Hệ thống vận hành</span>
                <div class="flex items-center gap-2 justify-end">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-[12px] font-bold text-white uppercase italic">Elite Server Online</span>
                </div> 
            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            <h2 class="text-6xl font-black tracking-tighter mb-12 text-white italic uppercase leading-none">
                {{ Auth::user()->role === 'admin' ? 'Quản trị' : 'Hồ sơ' }} <span class="text-orange-600">Elite .</span>
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">               
                <div class="lg:col-span-3 lg:sticky lg:top-10 space-y-6">
                    <div class="glass-card p-8 rounded-[3rem] text-center relative overflow-hidden">
                        <div class="w-24 h-24 rounded-[2rem] bg-gradient-to-br from-orange-600 to-red-600 flex items-center justify-center shadow-2xl mx-auto mb-6 transform -rotate-3">
                            <span class="text-4xl font-black text-white italic uppercase">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <h3 class="text-xl font-black text-white italic uppercase mb-1">{{ $user->name }}</h3>
                        <p class="text-orange-500 text-[9px] font-bold uppercase tracking-widest mb-8 italic">
                            {{ Auth::user()->role === 'admin' ? 'Super Admin Badge' : 'Thành viên Elite' }}
                        </p>
                        <div class="space-y-2">
                            <button onclick="switchTab('orders')" id="btn-orders" class="w-full text-left p-4 rounded-xl bg-orange-600 text-white font-black uppercase text-[9px] tracking-widest flex items-center gap-3 transition-all shadow-lg shadow-orange-600/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ Auth::user()->role === 'admin' ? 'Vận đơn hệ thống' : 'Đơn hàng của tôi' }}
                            </button>
                            @if(Auth::user()->role === 'admin')
                            <button onclick="switchTab('revenue')" id="btn-revenue" class="w-full text-left p-4 rounded-xl bg-white/5 text-gray-400 font-black uppercase text-[9px] tracking-widest flex items-center gap-3 hover:bg-white/10 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Báo cáo doanh thu
                            </button>
                            @endif
                            <button onclick="switchTab('profile')" id="btn-profile" class="w-full text-left p-4 rounded-xl bg-white/5 text-gray-400 font-black uppercase text-[9px] tracking-widest flex items-center gap-3 hover:bg-white/10 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Thiết lập hồ sơ
                            </button>
                            <div class="pt-6">
                                <form action="{{ route('logout') }}" method="POST" id="logout-form"> 
                                    @csrf
                                    <button type="submit" class="w-full text-red-500/50 hover:text-red-500 text-[9px] font-black uppercase tracking-widest transition-all italic underline decoration-red-500/20 underline-offset-4">
                                        Đăng xuất hệ thống
                                    </button>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="lg:col-span-9 space-y-8">              
                    <div id="tab-orders" class="tab-content glass-card p-8 rounded-[3rem] scroll-container animate-fade-in">
                        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4 border-b border-white/5 pb-6">
                            <div>
                                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 italic">Tiến độ vận hành</p>
                                <h3 class="text-3xl font-black text-white uppercase italic">
                                    {{ Auth::user()->role === 'admin' ? 'Danh sách vận đơn' : 'Lịch sử mua hàng' }}
                                </h3>
                            </div>
                        </div>
                        <div class="custom-scroll overflow-y-auto max-h-[600px] pr-2">
                            <table class="w-full text-left border-separate border-spacing-y-4">
                                <thead class="text-gray-500 text-[9px] font-black uppercase tracking-widest sticky top-0 bg-[#0a0a0a]/90 backdrop-blur-md z-10">
                                    <tr>
                                        <th class="px-6 py-4">Mã đơn</th><th class="px-6 py-4">Khách hàng</th><th class="px-6 py-4 text-center">Thanh toán</th><th class="px-6 py-4 text-center">Trạng thái</th><th class="px-6 py-4 text-right">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="text-xs font-bold">
                                    @foreach($orders as $order)
                                    @php
                                        $methodRaw = strtolower($order->payment_method);
                                        $isBank = false;
                                        if (str_contains($methodRaw, 'bank') || str_contains($methodRaw, 'transfer') || str_contains($methodRaw, 'casso') || str_contains($methodRaw, 'vnpay')) {
                                            $isBank = true;
                                        }   
                                        $isPaid = false;
                                        if ($isBank || $order->payment_status === 'paid' || $order->payment_status === 'completed') {
                                            $isPaid = true;
                                        }
                                    @endphp
                                    <tr class="glass-card group hover:bg-white/[0.05] transition-all {{ $order->status == 'cancelled' ? 'opacity-40 border-red-900/20' : '' }}">
                                        <td class="px-6 py-6 rounded-l-2xl text-orange-500 cursor-pointer hover:underline font-black" onclick="showOrderDetails('{{ $order->id }}')">
                                            #SQA-{{ $order->id }}
                                        </td>
                                        <td class="px-6 py-6">
                                            <div class="flex flex-col">
                                                <span class="text-white">Khách: {{ $order->receiver_name }}</span>
                                                <span class="text-[11px] text-orange-500/80 uppercase">Tổng: {{ number_format($order->total_price) }} VNĐ</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            <div class="flex flex-col items-center gap-1">
                                                <span class="text-[9px] font-black uppercase {{ $isBank ? 'text-blue-400' : 'text-gray-400' }}">
                                                    {{ $isBank ? 'Chuyển khoản' : 'Tiền mặt' }}
                                                </span>
                                                @if($isPaid)
                                                    <span class="text-[8px] bg-green-500/20 text-green-500 px-2 py-0.5 rounded border border-green-500/30 font-black uppercase">Đã thu tiền</span>
                                                @else
                                                    <span class="text-[8px] bg-red-500/20 text-red-500 px-2 py-0.5 rounded border border-red-500/30 font-black uppercase">Chưa thu</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            @if($order->status == 'pending')
                                                <span class="status-badge bg-orange-600/10 text-orange-500 border border-orange-600/20">Chờ xác nhận</span>
                                            @elseif($order->status == 'confirmed')
                                                <span class="status-badge bg-blue-600/10 text-blue-500 border border-blue-600/20">Đã xác nhận</span>
                                            @elseif($order->status == 'shipping')
                                                <span class="status-badge bg-purple-600/10 text-purple-500 border border-purple-600/20">Đang giao</span>
                                            @elseif($order->status == 'completed')
                                                <span class="status-badge bg-green-600/10 text-green-500 border border-green-600/20">Hoàn thành</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="status-badge bg-red-600 text-white border border-red-500 px-4 font-black shadow-[0_0_15px_rgba(220,38,38,0.4)]">● ĐÃ HỦY</span>
                                            @else
                                                <span class="status-badge bg-gray-600/10 text-gray-500 border border-gray-600/20 uppercase">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-6 rounded-r-2xl text-right">
                                            <div class="flex justify-end gap-2">
                                                @if(Auth::user()->role === 'admin')
                                                    @if($order->status == 'pending')
                                                        <button onclick="updateStep('{{ $order->id }}')" class="bg-white text-black px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:bg-orange-600 hover:text-white transition-all">Xác nhận đơn</button>
                                                        <button onclick="cancelOrder('{{ $order->id }}')" class="bg-red-600/20 text-red-500 border border-red-500/30 px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:bg-red-600 hover:text-white transition-all">Hủy</button>
                                                    @elseif($order->status == 'confirmed')
                                                        <button onclick="updateStep('{{ $order->id }}')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:scale-105 transition-all">Giao cho ĐVVC</button>
                                                    @elseif($order->status == 'shipping')
                                                        <button onclick="updateStep('{{ $order->id }}')" class="bg-green-600 text-white px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:scale-105 transition-all">Giao thành công</button>
                                                    @endif
                                                @else
                                                    @if($order->status == 'pending')
                                                        <button onclick="cancelOrder('{{ $order->id }}')" class="bg-red-600 text-white px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:bg-red-700 transition-all shadow-lg shadow-red-600/20">Hủy đơn</button>
                                                    @endif
                                                    <button onclick="showOrderDetails('{{ $order->id }}')" class="text-[9px] text-orange-500 border border-orange-500/30 px-3 py-1 rounded-full uppercase font-black hover:bg-orange-500 hover:text-white transition-all">Chi tiết</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>

                    @if(Auth::user()->role === 'admin')
                    <div id="tab-revenue" class="tab-content glass-card p-10 rounded-[3rem] hidden animate-fade-in">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-10 border-b border-white/5 pb-6 gap-4">
                            <div>
                                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 italic">Finance Overview</p>
                                <h3 class="text-3xl font-black text-white uppercase italic">Phân tích doanh thu</h3>
                            </div>
                            <select id="rev-period" onchange="fetchRevenue()" class="bg-white/5 border border-white/10 text-white text-[10px] font-black uppercase p-3 px-6 rounded-xl outline-none focus:border-orange-500 cursor-pointer">
                                <option value="day" class="bg-[#0a0a0a]">Hôm nay</option>
                                <option value="month" class="bg-[#0a0a0a]" selected>Tháng này</option>
                                <option value="year" class="bg-[#0a0a0a]">Năm nay</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-8 rounded-[2rem] bg-gradient-to-br from-orange-600/10 to-transparent border border-orange-600/20">
                                <p class="text-[9px] font-black text-orange-500 uppercase mb-4 tracking-widest italic">Tổng doanh thu</p>
                                <h4 id="rev-total" class="text-3xl font-black text-white italic">0 VNĐ</h4>
                            </div>
                            <div class="p-8 rounded-[2rem] bg-white/5 border border-white/10">
                                <p class="text-[9px] font-black text-gray-500 uppercase mb-4 tracking-widest italic">Đơn hoàn thành</p>
                                <h4 id="rev-count" class="text-3xl font-black text-white italic">0</h4>
                            </div>
                            <div class="p-8 rounded-[2rem] bg-white/5 border border-white/10">
                                <p class="text-[9px] font-black text-gray-500 uppercase mb-4 tracking-widest italic">Trung bình đơn</p>
                                <h4 id="rev-avg" class="text-3xl font-black text-white italic">0 VNĐ</h4>
                            </div>
                        </div>
                        <div class="mt-8 p-6 rounded-2xl bg-white/[0.02] border border-white/5 text-center">
                            <p class="text-[9px] text-gray-600 font-bold italic uppercase tracking-widest">Dữ liệu được cập nhật tự động dựa trên các đơn hàng có trạng thái "Hoàn thành"</p>
                        </div>
                    </div>
                    @endif

                    <div id="tab-profile" class="tab-content glass-card p-10 rounded-[3rem] hidden animate-fade-in">
                        <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-8 italic border-b border-white/5 pb-4">Cập nhật thông tin cá nhân</p>
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-2">Tên hiển thị</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="w-full p-4 input-field font-bold text-xs" placeholder="Nhập họ tên...">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-2">Số điện thoại</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}" class="w-full p-4 input-field font-bold text-xs" placeholder="Nhập số điện thoại...">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-2">Địa chỉ nhận hàng chi tiết</label>
                                <textarea name="address" rows="3" class="w-full p-4 input-field font-bold text-xs resize-none" placeholder="Số nhà, tên đường...">{{ $user->address }}</textarea>
                            </div>
                            <div class="pt-4 flex items-center justify-between">
                                <span class="text-[9px] text-gray-600 font-bold italic uppercase">Bảo mật bởi Sport Q&A Security</span>
                                <button type="submit" class="bg-white text-black px-8 py-4 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-orange-600 hover:text-white transition-all shadow-xl">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="orderModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md" onclick="closeModal()"></div>
        <div class="glass-card w-full max-w-2xl rounded-[3rem] p-10 relative z-10 border border-white/20 shadow-[0_0_50px_rgba(0,0,0,0.5)]">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic">Vận đơn chi tiết</p>
                    <h4 id="modalOrderId" class="text-3xl font-black text-white italic uppercase">#SQA-LOADING</h4>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-500 transition-all text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M6 18L18 6M6 6l12 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>  
            <div id="modalContent" class="space-y-4 max-h-[500px] overflow-y-auto custom-scroll pr-2"></div>
            <div class="mt-8 pt-6 border-t border-white/5 flex justify-between items-end">
                <div>
                    <p class="text-[9px] font-bold text-gray-500 uppercase italic">Tổng thanh toán</p>
                    <p id="modalTotal" class="text-2xl font-black text-orange-500 italic">0 VNĐ</p>
                </div>
                <button onclick="closeModal()" class="bg-white text-black px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-orange-600 hover:text-white transition-all">Đóng cửa sổ</button>
            </div>
        </div>
    </div>

    <script>
    const userRole = "{{ Auth::user()->role ?? 'user' }}";
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    function switchTab(tab) {
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(function(el) { el.classList.add('hidden'); });
        const targetTab = document.getElementById('tab-' + tab);
        if(targetTab) targetTab.classList.remove('hidden');
        
        const activeClass = "w-full text-left p-4 rounded-xl bg-orange-600 text-white font-black uppercase text-[9px] tracking-widest flex items-center gap-3 transition-all shadow-lg shadow-orange-600/20";
        const inactiveClass = "w-full text-left p-4 rounded-xl bg-white/5 text-gray-400 font-black uppercase text-[9px] tracking-widest flex items-center gap-3 hover:bg-white/10 transition-all";    
        
        const btnOrders = document.getElementById('btn-orders');
        const btnProfile = document.getElementById('btn-profile');
        const btnRevenue = document.getElementById('btn-revenue');
        if(btnOrders) btnOrders.className = (tab === 'orders') ? activeClass : inactiveClass;
        if(btnProfile) btnProfile.className = (tab === 'profile') ? activeClass : inactiveClass;
        if(btnRevenue) btnRevenue.className = (tab === 'revenue') ? activeClass : inactiveClass;
        if(tab === 'revenue') fetchRevenue();
    }

    function fetchRevenue() {
        const period = document.getElementById('rev-period').value;
        const totalEl = document.getElementById('rev-total');
        const countEl = document.getElementById('rev-count');
        const avgEl = document.getElementById('rev-avg');
        totalEl.innerHTML = '<span class="animate-pulse">ĐANG TÍNH...</span>';
        fetch(`/admin/revenue-stats?period=${period}`)
            .then(r => r.json())
            .then(res => {
                if(res.success) {
                    const fmt = new Intl.NumberFormat('vi-VN');
                    totalEl.innerText = fmt.format(res.data.total) + ' VNĐ';
                    countEl.innerText = res.data.count;
                    avgEl.innerText = fmt.format(res.data.avg) + ' VNĐ';
                }
            })
            .catch(err => { totalEl.innerText = "LỖI KẾT NỐI"; });
    }

    function showOrderDetails(id) {
        const modal = document.getElementById('orderModal');
        const content = document.getElementById('modalContent');
        const orderIdText = document.getElementById('modalOrderId');
        const totalText = document.getElementById('modalTotal');
        modal.classList.remove('hidden');
        orderIdText.innerText = `#SQA-${id}`;
        content.innerHTML = '<p class="text-center text-gray-500 py-10 animate-pulse font-black uppercase text-[10px]">Đang truy xuất dữ liệu từ Elite Server...</p>';
        
        fetch(`/order/details/${id}`)
            .then(r => r.json())
            .then(res => {
                if(res.success) {
                    const order = res.data;
                    const fmt = new Intl.NumberFormat('vi-VN');
                    totalText.innerText = fmt.format(order.total_price) + ' VNĐ';               
                    const methodRaw = (order.payment_method || '').toLowerCase();
                    const isBank = (methodRaw.includes('bank') || methodRaw.includes('transfer') || methodRaw.includes('casso') || methodRaw.includes('vnpay'));
                    const isPaid = (isBank || order.payment_status === 'paid' || order.payment_status === 'completed');
                    
                    let html = `
                        <div class="mb-6 p-5 rounded-3xl bg-white/[0.02] border border-white/10">
                            <p class="text-[9px] font-black text-orange-500 uppercase tracking-widest mb-4 italic">Thông tin vận đơn & Thanh toán</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3 text-[11px]">
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500 uppercase font-black">Người nhận:</span>
                                        <span class="text-white font-bold">${order.receiver_name || 'N/A'}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500 uppercase font-black">Liên hệ:</span>
                                        <span class="text-white font-bold">${order.phone || 'Chưa có SĐT'}</span>
                                    </div>
                                    <div class="pt-2 border-t border-white/5">
                                        <span class="text-gray-500 uppercase font-black block mb-1">Địa chỉ giao hàng:</span>
                                        <span class="text-gray-300 italic leading-relaxed">${order.address || 'Chưa cập nhật'}</span>
                                    </div>
                                </div>
                                <div class="space-y-3 text-[11px] bg-orange-600/5 p-4 rounded-2xl border border-orange-600/10">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500 uppercase font-black">Phương thức:</span>
                                        <span class="${isBank ? 'text-blue-400' : 'text-gray-400'} font-black uppercase">
                                            ${isBank ? '🏦 Chuyển khoản' : '💵 Tiền mặt'}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500 uppercase font-black">Trạng thái tiền:</span>
                                        <span class="${isPaid ? 'text-green-500' : 'text-red-500'} font-black uppercase">
                                            ${isPaid ? '● Đã thanh toán' : '○ Chờ thu tiền'}
                                        </span>
                                    </div>
                                    
                                    ${isBank ? `
                                    <div class="pt-2 mt-2 border-t border-white/10 flex justify-between items-center">
                                        <span class="text-gray-500 uppercase font-black">Nội dung CK:</span>
                                        <span class="text-orange-500 font-black tracking-widest uppercase italic">
                                            ${order.order_code || 'CHƯA CÓ MÃ'}
                                        </span>
                                    </div>
                                    ` : ''}

                                </div>
                            </div>
                        </div>`;

                    const items = order.order_items || order.orderItems || []; 
                    if (items.length > 0) {
                        items.forEach(item => {
                            let rawImg = item.image || (item.product ? item.product.image : '');
                            let finalImg = !rawImg ? 'https://via.placeholder.com/150' : (rawImg.startsWith('http') ? rawImg : `/storage/${rawImg.replace(/^public\//, '')}`);
                            let pName = item.product_name || (item.product ? item.product.name : 'Sản phẩm Elite');

                            html += `
                                <div class="flex items-center gap-6 p-4 rounded-2xl bg-white/5 border border-white/5 mb-3 group hover:bg-white/10 transition-all">
                                    <div class="relative w-14 h-14 flex-shrink-0">
                                        <img src="${finalImg}" class="w-full h-full object-cover rounded-xl shadow-2xl rotate-2 group-hover:rotate-0 transition-all" onerror="this.src='https://via.placeholder.com/150';">
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="text-white font-black uppercase italic text-[11px]">${pName}</h5>
                                        <p class="text-[9px] text-gray-500 font-bold uppercase italic">Số lượng: <span class="text-orange-500">${item.quantity}</span></p>
                                    </div>
                                    <p class="text-xs font-black text-white italic">${fmt.format(item.price)}đ</p>
                                </div>`;
                        });
                    } else {
                        html += '<p class="text-center text-gray-500 py-4 uppercase font-bold text-[10px]">Không tìm thấy sản phẩm trong vận đơn.</p>';
                    }
                    content.innerHTML = html;
                }
            })
            .catch(err => {
                content.innerHTML = '<p class="text-center text-red-500 py-4 uppercase text-[10px]">Lỗi hệ thống khi kết nối dữ liệu.</p>';
            });
    }

    function closeModal() { document.getElementById('orderModal').classList.add('hidden'); }

    function cancelOrder(id) {
        Swal.fire({
            title: 'BẠN MUỐN HỦY ĐƠN?',
            text: "Hành động này sẽ dừng quy trình vận hành mã #SQA-" + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#333',
            confirmButtonText: 'ĐỒNG Ý HỦY',
            cancelButtonText: 'QUAY LẠI',
            background: '#0a0a0a',
            color: '#fff',
            customClass: { popup: 'glass-card border border-white/10 rounded-[2rem]' }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/order/cancel/${id}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }
                })
                .then(r => r.json())
                .then(res => {
                    if(res.success) {
                        Swal.fire({ title: 'ĐÃ XỬ LÝ!', text: 'Trạng thái đơn hàng đã được cập nhật thành ĐÃ HỦY.', icon: 'success', background: '#0a0a0a', color: '#fff' }).then(() => location.reload());
                    } else {
                        Swal.fire('LỖI HỆ THỐNG', res.message || 'Không thể thực hiện lệnh hủy', 'error');
                    }
                })
                .catch(err => { Swal.fire('LỖI KẾT NỐI', 'Elite Server không phản hồi', 'error'); });
            }
        });
    }

    function updateStep(id) {
        if (userRole !== 'admin') return;
        Swal.fire({
            title: 'XÁC NHẬN THAO TÁC?',
            text: `Hệ thống sẽ cập nhật tiến độ vận hành cho đơn hàng #${id}`,
            icon: 'question',
            background: '#121212', color: '#fff',
            showCancelButton: true, confirmButtonColor: '#ea580c', cancelButtonColor: '#333',
            confirmButtonText: 'ĐỒNG Ý CẬP NHẬT', cancelButtonText: 'HỦY BỎ'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/order/update-status/${id}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json' }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({ title: 'THÀNH CÔNG!', text: 'Tiến độ vận đơn đã được cập nhật.', icon: 'success', background: '#121212', color: '#fff' }).then(() => location.reload());
                    } else {
                        Swal.fire({ title: 'THẤT BẠI!', text: data.message, icon: 'error', background: '#121212', color: '#fff' });
                    }
                })
                .catch(err => {
                    Swal.fire({ title: 'LỖI KẾT NỐI!', text: 'Không thể giao tiếp với Elite Server', icon: 'error', background: '#121212', color: '#fff' });
                });
            }
        });
    }

    const alertBox = document.getElementById('success-alert');
    if (alertBox) { setTimeout(() => { alertBox.style.display = 'none'; }, 5000); }
    </script>
</body>
</html>