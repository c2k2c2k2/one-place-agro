@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'min' => null,
    'max' => null,
    'step' => null
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
    
    <input 
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        @if($min !== null) min="{{ $min }}" @endif
        @if($max !== null) max="{{ $max }}" @endif
        @if($step !== null) step="{{ $step }}" @endif
        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition @error($name) border-red-500 @enderror"
    >
    
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
            <span class="material-symbols-outlined text-sm align-middle">error</span>
            {{ $message }}
        </p>
    @enderror
</div>
