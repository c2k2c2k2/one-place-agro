@props([
    'name' => 'images',
    'label' => 'Upload Images',
    'maxFiles' => 5,
    'maxSize' => 5, // MB
    'existingImages' => [],
    'required' => false
])

<div class="mb-4">
    @if($label)
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
            <span class="text-xs font-normal text-gray-500">(Max {{ $maxFiles }} images, {{ $maxSize }}MB each)</span>
        </label>
    @endif
    
    <!-- Existing Images -->
    @if(count($existingImages) > 0)
        <div class="mb-3">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Current Images:</p>
            <div class="grid grid-cols-3 gap-2" id="existingImagesContainer">
                @foreach($existingImages as $index => $image)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $image) }}" alt="Image {{ $index + 1 }}" class="w-full h-24 object-cover rounded-lg">
                        <button type="button" 
                                onclick="removeExistingImage(this, '{{ $image }}')"
                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                        <input type="hidden" name="existing_images[]" value="{{ $image }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!-- File Input -->
    <div class="relative">
        <input 
            type="file"
            id="{{ $name }}"
            name="{{ $name }}[]"
            accept="image/jpeg,image/png,image/jpg,image/webp"
            multiple
            @if($required && count($existingImages) === 0) required @endif
            onchange="previewImages(this, {{ $maxFiles }}, {{ $maxSize }})"
            class="hidden"
        >
        
        <label for="{{ $name }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">cloud_upload</span>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Click to upload</span> or drag and drop
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">PNG, JPG, JPEG, WEBP (MAX. {{ $maxSize }}MB each)</p>
            </div>
        </label>
    </div>
    
    <!-- Preview Container -->
    <div id="imagePreviewContainer" class="grid grid-cols-3 gap-2 mt-3 hidden"></div>
    
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
            <span class="material-symbols-outlined text-sm align-middle">error</span>
            {{ $message }}
        </p>
    @enderror
    
    @error($name . '.*')
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
            <span class="material-symbols-outlined text-sm align-middle">error</span>
            {{ $message }}
        </p>
    @enderror
</div>

@push('scripts')
<script>
function previewImages(input, maxFiles, maxSize) {
    const container = document.getElementById('imagePreviewContainer');
    const files = Array.from(input.files);
    
    // Clear previous previews
    container.innerHTML = '';
    
    // Check file count
    if (files.length > maxFiles) {
        alert(`You can only upload maximum ${maxFiles} images`);
        input.value = '';
        container.classList.add('hidden');
        return;
    }
    
    // Check file sizes and create previews
    let validFiles = true;
    files.forEach((file, index) => {
        // Check file size (convert MB to bytes)
        if (file.size > maxSize * 1024 * 1024) {
            alert(`${file.name} is larger than ${maxSize}MB`);
            validFiles = false;
            return;
        }
        
        // Create preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-24 object-cover rounded-lg">
                <button type="button" 
                        onclick="removePreviewImage(this, ${index})"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            `;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
    
    if (!validFiles) {
        input.value = '';
        container.classList.add('hidden');
        return;
    }
    
    if (files.length > 0) {
        container.classList.remove('hidden');
    }
}

function removePreviewImage(button, index) {
    const input = document.getElementById('{{ $name }}');
    const container = document.getElementById('imagePreviewContainer');
    
    // Remove the preview
    button.parentElement.remove();
    
    // Clear the input (can't selectively remove files from input)
    input.value = '';
    
    // Hide container if no previews left
    if (container.children.length === 0) {
        container.classList.add('hidden');
    }
}

function removeExistingImage(button, imagePath) {
    if (confirm('Are you sure you want to remove this image?')) {
        button.parentElement.remove();
    }
}
</script>
@endpush
