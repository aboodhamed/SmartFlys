@props(['active' => false])

@if(isset($dropdown))
<div class="relative">
    <button id="{{ $attributes['id'] }}" class="relative font-poppins font-medium text-sm px-4 py-2 rounded-full {{ $active ? 'text-orange-400 bg-white/10' : 'text-white hover:bg-white/10' }} transition duration-200 group" aria-haspopup="true" aria-expanded="false">
        <span class="{{ $active ? 'text-orange-400' : 'text-white group-hover:text-orange-400' }} transition duration-200">
            {{ $slot }}
            <svg class="mr-2 h-4 w-4 inline transition-transform duration-200 transform group-[.dropdown-open]:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </span>
        <span class="absolute bottom-0 right-1/2 transform translate-x-1/2 w-0 h-0.5 bg-orange-400 {{ $active ? 'w-1/2' : 'group-hover:w-1/2' }} transition-all duration-300"></span>
    </button>
    {{ $dropdown }}
</div>
@else
<a href="{{ $attributes['href'] }}" class="relative font-poppins font-medium text-sm px-4 py-2 rounded-full {{ $active ? 'text-orange-400 bg-white/10' : 'text-white hover:bg-white/10' }} transition duration-200 group" aria-current="{{ $active ? 'page' : 'false' }}">
    <span class="{{ $active ? 'text-orange-400' : 'text-white group-hover:text-orange-400' }} transition duration-200">
        {{ $slot }}
    </span>
    <span class="absolute bottom-0 right-1/2 transform translate-x-1/2 w-0 h-0.5 bg-gorange-400 {{ $active ? 'w-1/2' : 'group-hover:w-1/2' }} transition-all duration-300"></span>
</a>
@endif