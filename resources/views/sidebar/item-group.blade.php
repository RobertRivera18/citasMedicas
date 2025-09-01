<div x-data="{
open:{{ $active ? 'true' : 'false'}},

}">

    <button @click="open = !open"
        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
        <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500">
            <i class="{{ $icon }}"></i>
        </span>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $title }}</span>
        {{-- <svg :class="{'rotate-180': open}" class="w-3 h-3 transition-transform"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg> --}}

            <i :class="{
                'fa-solid fa-chevron-up':open,
                'fa-solid fa-chevron-down':!open,

            }"></i>

    </button>
    <ul x-show="open" x-collapse class="py-2 space-y-2">
        @foreach ($items as $item)
            <li class="pl-4">
                {{!! $item->render()!!}}
                </a>
            </li>
        @endforeach
    </ul>

</div>
