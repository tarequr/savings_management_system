@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-50 border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm placeholder-gray-400 py-3 px-4']) }}>
