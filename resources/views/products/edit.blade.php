<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm - Pickleball Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                Chỉnh sửa sản phẩm 🛠️
            </h2>
            <span class="text-xs font-mono text-gray-400 bg-gray-100 px-3 py-1 rounded-full">ID: #{{ $product->id }}</span>
        </div>
        
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ $product->name }}" 
                       class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500 transition" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Thương hiệu</label>
                    <input type="text" name="brand" value="{{ $product->brand }}" 
                           class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500 transition" placeholder="VD: Joola, Selkirk...">
                </div>
                
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Màu sắc</label>
                    <input type="text" name="color" value="{{ $product->color }}" 
                           class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500 transition" placeholder="VD: Đen, Lime, Hồng...">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Giá tiền (VNĐ)</label>
                    <input type="number" name="price" value="{{ $product->price }}" 
                           class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500 transition" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Thông tin chi tiết của vợt</label>
                <textarea name="description" rows="4" 
                          class="w-full p-3 border rounded-xl outline-none focus:ring-2 focus:ring-orange-500 transition" 
                          placeholder="Nhập thông số kỹ thuật, công nghệ lõi, độ nhám mặt vợt...">{{ $product->description }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-700">Hình ảnh sản phẩm</label>
                
                <div class="flex items-center gap-6 p-4 border-2 border-dashed rounded-2xl bg-gray-50 relative">
                    <div class="w-24 h-24 bg-white rounded-lg border flex items-center justify-center overflow-hidden shrink-0 relative shadow-sm">
                        @if($product->image)
                            <img id="current-img" src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full">
                        @else
                            <span id="placeholder-icon" class="text-2xl text-gray-300 font-bold">🏓</span>
                        @endif
                        <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-cover bg-white">
                    </div>

                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-2 font-medium">Thay đổi hình ảnh (nếu cần):</p>
                        <input type="file" name="image" accept="image/*" onchange="previewImage(event)"
                               class="block w-full text-sm text-gray-500 
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-orange-50 file:text-orange-700
                                      hover:file:bg-orange-100 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all hover:-translate-y-0.5">
                    Cập nhật sản phẩm
                </button>
                <a href="{{ route('products.index') }}" 
                   class="flex-1 bg-gray-100 text-gray-600 py-3 rounded-xl font-bold text-center hover:bg-gray-200 transition">
                    Quay lại
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const currentImg = document.getElementById('current-img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (currentImg) currentImg.classList.add('opacity-30'); 
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>