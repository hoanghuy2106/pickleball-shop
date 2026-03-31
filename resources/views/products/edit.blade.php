<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm - SPORT Q&A Elite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; }
        /* Tùy chỉnh thanh cuộn cho sành điệu */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }
    </style>
</head>
<body class="antialiased py-10 px-6 overflow-x-hidden">

    <div class="blob absolute w-96 h-96 bg-orange-600/10 rounded-full blur-[100px] top-[-100px] left-[-100px] z-[-1]"></div>

    <div class="max-w-3xl mx-auto bg-[#111] p-10 rounded-[2.5rem] border border-white/5 shadow-2xl relative">
        <div class="flex justify-between items-center mb-10 pb-4 border-b border-white/5">
            <h2 class="text-3xl font-black text-white flex items-center gap-3 tracking-tighter uppercase italic">
                Cập nhật chiến vợt <span class="text-orange-500">🛠️</span>
            </h2>
            <span class="text-xs font-black font-mono text-gray-500 bg-white/5 px-4 py-1.5 rounded-full border border-white/10 tracking-widest">
                ID: #{{ $product->id }}
            </span>
        </div>
        
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="premium-input-group">
                <label class="block text-xs font-black mb-2.5 text-gray-400 uppercase tracking-widest">Tên sản phẩm hàng hiệu</label>
                <input type="text" name="name" value="{{ $product->name }}" 
                       class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-black mb-2.5 text-gray-400 uppercase tracking-widest">Thương hiệu</label>
                    <input type="text" name="brand" value="{{ $product->brand }}" 
                           class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium" placeholder="VD: JOOLA...">
                </div>
                
                <div>
                    <label class="block text-xs font-black mb-2.5 text-gray-400 uppercase tracking-widest">Màu sắc Elite</label>
                    <input type="text" name="color" value="{{ $product->color }}" 
                           class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium" placeholder="VD: Carbon Black...">
                </div>

                <div>
                    <label class="block text-xs font-black mb-2.5 text-gray-400 uppercase tracking-widest">Giá niêm yết (VNĐ)</label>
                    <input type="number" name="price" value="{{ $product->price }}" 
                           class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-orange-400 rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-bold text-lg tracking-tight" required>
                </div>
            </div>

            <div class="premium-input-group">
                <label class="block text-xs font-black mb-2.5 text-gray-400 uppercase tracking-widest">Thông số công nghệ & Mô tả</label>
                <textarea name="description" rows="5" 
                          class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium leading-relaxed italic" 
                          placeholder="VD: Công nghệ lõi Carbon Friction Surface...">{{ $product->description }}</textarea>
            </div>

            <div class="premium-input-group">
                <label class="block text-xs font-black mb-2.5 text-gray-400 uppercase tracking-widest">Hình ảnh siêu phẩm</label>
                
                <div class="flex items-center gap-8 p-6 border-2 border-dashed border-white/10 rounded-[2rem] bg-black/30 relative hover:border-orange-500/20 transition-colors">
                    <div class="w-32 h-32 bg-[#1a1a1a] rounded-2xl border border-white/10 flex items-center justify-center overflow-hidden shrink-0 relative shadow-inner group">
                        @if($product->image)
                            <img id="current-img" src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full opacity-80 group-hover:opacity-100 transition">
                        @else
                            <span id="placeholder-icon" class="text-4xl text-gray-700 font-bold">🏸</span>
                        @endif
                        <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-cover bg-[#1a1a1a]">
                    </div>

                    <div class="flex-1 space-y-3">
                        <p class="text-[11px] text-gray-500 font-bold uppercase tracking-widest">Thay áo mới cho vợt (PNG/JPG):</p>
                        <input type="file" name="image" accept="image/*" onchange="previewImage(event)"
                               class="block w-full text-xs text-gray-500 
                                      file:mr-5 file:py-2.5 file:px-5
                                      file:rounded-full file:border-white/10 file:border
                                      file:text-[10px] file:font-black file:uppercase file:tracking-widest
                                      file:bg-white/5 file:text-white
                                      hover:file:bg-orange-600 hover:file:border-orange-600 transition cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-white/5">
                <button type="submit" class="flex-1 bg-white text-black py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-orange-600 hover:text-white transition active:scale-95 shadow-xl hover:shadow-orange-500/20">
                    Cập nhật siêu phẩm →
                </button>
                <a href="{{ route('products.index') }}" 
                   class="flex-1 bg-[#1a1a1a] text-gray-400 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] text-center hover:bg-white/5 hover:text-white transition border border-white/10">
                    Hủy & Quay lại
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const currentImg = document.getElementById('current-img');
            const placeholder = document.getElementById('placeholder-icon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (currentImg) currentImg.classList.add('opacity-10'); 
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>