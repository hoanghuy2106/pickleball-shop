<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm - Pickleball Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            Thêm sản phẩm mới 🏓
        </h2>
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Tên sản phẩm</label>
                <input type="text" name="name" class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500" placeholder="VD: Joola Perseus 16mm..." required>
            </div>

            <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Thương hiệu</label>
                    <input type="text" name="brand" class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500" placeholder="Joola, Selkirk..." required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Màu sắc</label>
                    <input type="text" name="color" class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500" placeholder="VD: Đen nhám, Hồng...">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Giá tiền (VNĐ)</label>
                    <input type="number" name="price" class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500" placeholder="5450000" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Thông tin chi tiết của vợt</label>
                <textarea name="description" rows="4" 
                          class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500" 
                          placeholder="Nhập thông số kỹ thuật: Trọng lượng, độ dày lõi, chất liệu bề mặt..."></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-700">Hình ảnh sản phẩm</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-orange-400 transition-colors relative group">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-orange-400 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none">
                                <span>Tải ảnh lên</span>
                                <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 italic">PNG, JPG tối đa 2MB</p>
                    </div>
                    <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-contain bg-white p-2 rounded-xl border">
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-orange-500 text-white py-3 rounded-xl font-bold hover:bg-orange-600 shadow-lg shadow-orange-200 transition-all hover:-translate-y-0.5">
                    Lưu sản phẩm
                </button>
                <a href="{{ route('products.index') }}" class="flex-1 bg-gray-100 text-gray-600 py-3 rounded-xl font-bold text-center hover:bg-gray-200 transition-colors">
                    Hủy
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
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>