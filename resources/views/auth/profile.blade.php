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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .input-field { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 1rem; color: white; transition: all 0.3s; }
        .input-field:focus { border-color: #ea580c; background: rgba(234, 88, 12, 0.08); outline: none; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; }
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
    </style>
</head>
<body class="antialiased">
    <div class="max-w-[1440px] mx-auto py-16 px-8 md:px-16">
        
        @if(session('success'))
        <div class="fixed top-5 right-5 z-50 bg-orange-600 text-white px-6 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-2xl animate-bounce">
            {{ session('success') }}
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
                <span class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-2">Trạng thái hệ thống</span>
                <div class="flex items-center gap-2 justify-end">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-[12px] font-bold text-white uppercase">Đang hoạt động</span>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto">
            <h2 class="text-6xl font-black tracking-tighter mb-12 text-white italic uppercase leading-none">
                {{ Auth::user()->role === 'admin' ? 'Quản trị' : 'Hồ sơ' }} <span class="text-orange-600">Elite .</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-3 space-y-6">
                    <div class="glass-card p-8 rounded-[3rem] text-center relative overflow-hidden">
                        <div class="w-24 h-24 rounded-[2rem] bg-gradient-to-br from-orange-600 to-red-600 flex items-center justify-center shadow-2xl mx-auto mb-6 transform -rotate-3">
                            <span class="text-4xl font-black text-white italic uppercase">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <h3 class="text-xl font-black text-white italic uppercase mb-1">{{ $user->name }}</h3>
                        <p class="text-orange-500 text-[9px] font-bold uppercase tracking-widest mb-8 italic">
                            {{ Auth::user()->role === 'admin' ? 'Super Admin Badge' : 'Thành viên Elite' }}
                        </p>

                        <div class="space-y-2">
                            <button onclick="switchTab('orders')" id="btn-orders" class="w-full text-left p-4 rounded-xl bg-orange-600 text-white font-black uppercase text-[9px] tracking-widest flex items-center gap-3 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2"/></svg>
                                {{ Auth::user()->role === 'admin' ? 'Vận đơn hệ thống' : 'Đơn hàng của tôi' }}
                            </button>
                            <button onclick="switchTab('profile')" id="btn-profile" class="w-full text-left p-4 rounded-xl bg-white/5 text-gray-400 font-black uppercase text-[9px] tracking-widest flex items-center gap-3 hover:bg-white/10 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                                Thiết lập hồ sơ
                            </button>
                            <form action="{{ route('logout') }}" method="POST" class="pt-4"> @csrf
                                <button type="submit" class="w-full text-red-500/50 hover:text-red-500 text-[9px] font-black uppercase tracking-widest transition-all italic underline">Đăng xuất hệ thống</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-9 space-y-8">
                    <div id="tab-orders" class="glass-card p-8 rounded-[3rem]">
                        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4 border-b border-white/5 pb-6">
                            <div>
                                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 italic">Tiến độ vận hành</p>
                                <h3 class="text-3xl font-black text-white uppercase italic">
                                    {{ Auth::user()->role === 'admin' ? 'Danh sách vận đơn' : 'Lịch sử mua hàng' }}
                                </h3>
                            </div>
                        </div>

                        <div class="custom-scroll overflow-x-auto">
                            <table class="w-full text-left border-separate border-spacing-y-4">
                                <thead class="text-gray-500 text-[9px] font-black uppercase tracking-widest">
                                    <tr>
                                        <th class="px-6 py-2">Mã đơn</th>
                                        <th class="px-6 py-2">Khách hàng / Thông tin</th>
                                        <th class="px-6 py-2 text-center">Trạng thái</th>
                                        <th class="px-6 py-2 text-right">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="text-xs font-bold">
                                    @foreach($orders as $order)
                                    <tr class="glass-card group hover:bg-white/[0.05] transition-all">
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
                                            @php
                                                $badges = [
                                                    'pending' => ['label' => 'Chờ xác nhận', 'class' => 'bg-orange-600/10 text-orange-500 border-orange-600/20'],
                                                    'confirmed' => ['label' => 'Đã xác nhận', 'class' => 'bg-blue-600/10 text-blue-500 border-blue-600/20'],
                                                    'shipping' => ['label' => 'Đang giao', 'class' => 'bg-purple-600/10 text-purple-500 border-purple-600/20'],
                                                    'completed' => ['label' => 'Hoàn thành', 'class' => 'bg-green-600/10 text-green-500 border-green-600/20'],
                                                    'cancelled' => ['label' => 'Đã hủy', 'class' => 'bg-red-600/10 text-red-500 border-red-600/20']
                                                ];
                                                $current = $badges[$order->status] ?? $badges['pending'];
                                            @endphp
                                            <span class="status-badge {{ $current['class'] }} border">{{ $current['label'] }}</span>
                                        </td>
                                        <td class="px-6 py-6 rounded-r-2xl text-right">
                                            <div class="flex justify-end gap-2">
                                                @if(Auth::user()->role === 'admin')
                                                    @if($order->status == 'pending')
                                                        <button onclick="updateStep('{{ $order->id }}')" class="bg-white text-black px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:bg-orange-600 hover:text-white transition-all">Xác nhận đơn</button>
                                                    @elseif($order->status == 'confirmed')
                                                        <button onclick="updateStep('{{ $order->id }}')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:scale-105 transition-all">Giao cho ĐVVC</button>
                                                    @elseif($order->status == 'shipping')
                                                        <button onclick="updateStep('{{ $order->id }}')" class="bg-green-600 text-white px-4 py-2 rounded-lg text-[9px] font-black uppercase hover:scale-105 transition-all">Giao thành công</button>
                                                    @endif
                                                @else
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

                    <div id="tab-profile" class="glass-card p-10 rounded-[3rem] hidden">
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
                                <span class="text-[9px] text-gray-600 font-bold italic uppercase">Bảo mật bởi Sport Q&A</span>
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
        <div class="glass-card w-full max-w-2xl rounded-[3rem] p-10 relative z-10">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic">Vận đơn chi tiết</p>
                    <h4 id="modalOrderId" class="text-3xl font-black text-white italic uppercase">#SQA-LOADING</h4>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-500 transition-all text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12" stroke-width="3"/></svg>
                </button>
            </div>
            <div id="modalContent" class="space-y-4 max-h-[400px] overflow-y-auto custom-scroll pr-2">
                </div>
            <div class="mt-8 pt-6 border-t border-white/5 flex justify-between items-end">
                <div>
                    <p class="text-[9px] font-bold text-gray-500 uppercase italic">Tổng thanh toán</p>
                    <p id="modalTotal" class="text-2xl font-black text-orange-500 italic">0 VNĐ</p>
                </div>
                <button onclick="closeModal()" class="bg-white text-black px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-orange-600 transition-all">Đóng cửa sổ</button>
            </div>
        </div>
    </div>

    <script>
    // 1. Khai báo Role hệ thống - Sử dụng null coalescing để tránh lỗi Blade
    const userRole = "{{ Auth::user()->role ?? 'user' }}";

    // 2. Chức năng Chuyển Tab (Hồ sơ / Đơn hàng)
    function switchTab(tab) {
        document.getElementById('tab-orders').classList.toggle('hidden', tab !== 'orders');
        document.getElementById('tab-profile').classList.toggle('hidden', tab !== 'profile');
        
        const activeClass = "w-full text-left p-4 rounded-xl bg-orange-600 text-white font-black uppercase text-[9px] tracking-widest flex items-center gap-3 transition-all";
        const inactiveClass = "w-full text-left p-4 rounded-xl bg-white/5 text-gray-400 font-black uppercase text-[9px] tracking-widest flex items-center gap-3 hover:bg-white/10 transition-all";
        
        document.getElementById('btn-orders').className = (tab === 'orders') ? activeClass : inactiveClass;
        document.getElementById('btn-profile').className = (tab === 'profile') ? activeClass : inactiveClass;
    }

    // 3. Chức năng Xem chi tiết đơn hàng & Xử lý logic ảnh phức tạp
    function showOrderDetails(id) {
        const modal = document.getElementById('orderModal');
        const content = document.getElementById('modalContent');
        const orderIdText = document.getElementById('modalOrderId');
        const totalText = document.getElementById('modalTotal');

        modal.classList.remove('hidden');
        orderIdText.innerText = `#SQA-${id}`;
        content.innerHTML = '<p class="text-center text-gray-500 py-10 animate-pulse font-black uppercase text-[10px]">Đang tải dữ liệu...</p>';

        fetch(`/order/details/${id}`)
            .then(r => r.json())
            .then(res => {
                if(res.success) {
                    const order = res.data;
                    totalText.innerText = new Intl.NumberFormat('vi-VN').format(order.total_price) + ' VNĐ';
                    
                    let html = '';
                    // Hỗ trợ cả 2 cách đặt tên biến của Laravel (camelCase và snake_case)
                    const items = order.order_items || order.orderItems || []; 
                    
                    if (items.length > 0) {
                        items.forEach(item => {
                            // LOGIC XỬ LÝ ẢNH THÔNG MINH
                            let rawImg = item.image || (item.product ? item.product.image : '');
                            let finalImg = '';

                            if (!rawImg) {
                                finalImg = 'https://via.placeholder.com/150';
                            } else if (rawImg.startsWith('http')) {
                                finalImg = rawImg;
                            } else {
                                // Loại bỏ "public/" nếu tồn tại và đảm bảo có prefix /storage/
                                let cleanPath = rawImg.replace(/^public\//, '');
                                finalImg = `/storage/${cleanPath}`;
                            }

                            let pName = item.product_name || (item.product ? item.product.name : 'Sản phẩm Elite');

                            html += `
                                <div class="flex items-center gap-6 p-4 rounded-2xl bg-white/5 border border-white/5 mb-3 group hover:bg-white/10 transition-all">
                                    <div class="relative w-16 h-16 flex-shrink-0">
                                        <img src="${finalImg}" 
                                             class="w-full h-full object-cover rounded-xl shadow-2xl rotate-2 group-hover:rotate-0 transition-all"
                                             onerror="this.src='https://via.placeholder.com/150'; this.onerror=null;">
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="text-white font-black uppercase italic text-sm">${pName}</h5>
                                        <p class="text-[10px] text-gray-500 font-bold uppercase italic">Số lượng: <span class="text-orange-500">${item.quantity}</span></p>
                                    </div>
                                    <p class="text-sm font-black text-white italic">${new Intl.NumberFormat('vi-VN').format(item.price)}đ</p>
                                </div>`;
                        });
                    } else {
                        html = '<p class="text-center text-gray-500 py-4 uppercase font-bold text-[10px]">Đơn hàng trống.</p>';
                    }
                    content.innerHTML = html;
                }
            })
            .catch(err => {
                content.innerHTML = '<p class="text-center text-red-500 py-4 uppercase text-[10px]">Lỗi kết nối dữ liệu.</p>';
            });
    }

    // 4. Đóng Modal
    function closeModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    // 5. Chức năng Cập nhật trạng thái (Dành cho Admin)
    function updateStep(id) {
        if (userRole !== 'admin') return;

        Swal.fire({
            title: 'XÁC NHẬN THAO TÁC?',
            text: `Cập nhật tiến độ cho đơn hàng #${id}`,
            icon: 'question',
            background: '#121212', color: '#fff',
            showCancelButton: true, confirmButtonColor: '#ea580c', confirmButtonText: 'ĐỒNG Ý'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/order/update-status/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({ title: 'THÀNH CÔNG!', icon: 'success', background: '#121212', color: '#fff' })
                        .then(() => location.reload());
                    } else {
                        Swal.fire({ title: 'THẤT BẠI!', text: data.message, icon: 'error', background: '#121212', color: '#fff' });
                    }
                })
                .catch(err => {
                    Swal.fire({ title: 'LỖI!', text: 'Không thể kết nối server', icon: 'error', background: '#121212', color: '#fff' });
                });
            }
        });
    }

    // 6. Chức năng Hủy đơn hàng (Dành cho Admin)
    function cancelOrder(id) {
        if (userRole !== 'admin') return;

        Swal.fire({
            title: 'HỦY ĐƠN HÀNG?',
            text: "Thao tác này sẽ dừng vận chuyển đơn hàng này!",
            icon: 'warning',
            showCancelButton: true, background: '#121212', color: '#fff',
            confirmButtonColor: '#ef4444', confirmButtonText: 'XÁC NHẬN HỦY'
        }).then((result) => {
            if (result.isConfirmed) {
                // Logic xử lý hủy của bạn ở đây (hiện tại đang reload)
                location.reload();
            }
        });
    }
</script>
</body>
</html>