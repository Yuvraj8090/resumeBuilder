@props(['active', 'icon'])
@php
$classes = ($active ?? false)
            ? 'bg-indigo-50 text-indigo-600 border-l-4 border-indigo-600'
            : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 border-l-4 border-transparent';
@endphp
<a {{ $attributes->merge(['class' => 'group flex items-center px-3 py-2.5 text-sm font-medium transition-all duration-200 ' . $classes]) }}>
    <i data-lucide="{{ $icon }}" class="w-5 h-5 mr-3 {{ $active ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}"></i>
    {{ $slot }}
</a>