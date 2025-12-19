@props([
    'name',
    'label',
    'options' => [],
    'selected' => '',
    'placeholder' => 'Select an option',
    'required' => false,
    'disabled' => false
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <select 
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition @error($name) border-red-500 @enderror"
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
            <span class="material-symbols-outlined text-sm align-middle">error</span>
            {{ $message }}
        </p>
    @enderror
</div>
