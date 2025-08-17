@props(['active' => false])

<a {{ $attributes }}
    class="{{ $active ? 'bg-[#009991] text-white' : 'text-gray-300 hover:bg-[#009991] hover:text-white' }} rounded-full px-3 py-2 text-sm font-medium "
    aria-current="{{ $active ? 'page' : false }}">{{ $slot }}</a>
