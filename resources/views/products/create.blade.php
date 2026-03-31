<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm mới - SPORT Q&A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0a0a; color: #eee; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }
    </style>
</head>
<body class="antialiased py-10 px-6">

    <div class="absolute w-[500px] h-[500px] bg-orange-600/5 rounded-full blur-[120px] top-[-250px] right-[-100px] z-[-1]"></div>

    <div class="max-w-3xl mx-auto bg-[#111] p-10 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden">
        <div class="mb-10 pb-4 border-b border-white/5">
            <h2 class="text-3xl font-black text-white flex items-center gap-3 tracking-tighter uppercase italic">
                Khai kho báu mới <span class="text-orange-500 text-4xl">🏓</span>
            </h2>
            <p class="text-gray-500 text-xs font-bold mt-2 uppercase tracking-widest italic">SPORT Q&A - Add New Product</p>
        </div>
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="group">
                <label class="block text-[10px] font-black mb-2.5 text-gray-500 uppercase tracking-[0.2em] group-focus-within:text-orange-500 transition-colors">Tên siêu phẩm</label>
                <input type="text" name="name" 
                       class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium" 
                       placeholder="" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-black mb-2.5 text-gray-500 uppercase tracking-[0.2em]">Thương hiệu</label>
                    <input type="text" name="brand" 
                           class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium" 
                           placeholder="" required>
                </div>
                
                <div>
                    <label class="block text-[10px] font-black mb-2.5 text-gray-500 uppercase tracking-[0.2em]">Màu sắc</label>
                    <input type="text" name="color" 
                           class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium" 
                           placeholder="">
                </div>

                <div>
                    <label class="block text-[10px] font-black mb-2.5 text-gray-500 uppercase tracking-[0.2em]">Giá (VNĐ)</label>
                    <input type="number" name="price" 
                           class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-orange-500 rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-black text-lg" 
                           placeholder="" required>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black mb-2.5 text-gray-500 uppercase tracking-[0.2em]">Thông số kỹ thuật</label>
                <textarea name="description" rows="4" 
                          class="w-full p-4 bg-[#1a1a1a] border border-white/10 text-white rounded-2xl outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 transition font-medium italic" 
                          placeholder=""></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-black mb-2.5 text-gray-500 uppercase tracking-[0.2em]">Hình ảnh Profile</label>
                <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-[#222] border-dashed rounded-[2rem] hover:border-orange-500/40 transition-all relative group bg-white/0 hover:bg-white/[0.02]">
                    <div class="space-y-2 text-center">
                        <div class="mx-auto h-12 w-12 text-gray-600 group-hover:text-orange-500 transition-transform group-hover:scale-110 duration-500">
                            <svg stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="flex text-sm text-gray-400 justify-center">
                            <label for="file-upload" class="relative cursor-pointer rounded-md font-black text-orange-500 hover:text-orange-400 transition uppercase tracking-widest text-[11px]">
                                <span>Tải ảnh lên hệ thống</span>
                                <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                            </label>
                        </div>
                        <p class="text-[10px] text-gray-600 font-bold uppercase tracking-tighter"></p>
                    </div>
                    <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-cover bg-[#0a0a0a] rounded-[2rem] border border-orange-500/20">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-white/5">
                <button type="submit" class="flex-1 bg-white text-black py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:bg-orange-600 hover:text-white transition-all active:scale-95 shadow-xl hover:shadow-orange-500/20">
                    Lưu siêu phẩm ngay
                </button>
                <a href="{{ route('products.index') }}" class="flex-1 bg-[#1a1a1a] text-gray-500 py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] text-center hover:bg-white/5 hover:text-white transition border border-white/10">
                    Hủy bỏ
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    preview.classList.add('animate-in', 'fade-in', 'duration-500');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>