<x-filament-panels::page.simple>

    {{ $this->content }}

    <a href="{{ config('app.url') }}"
        class="w-full justify-center p-4 mt-3 text-sm font-medium text-center
           text-gray-900 bg-white border border-gray-200 rounded-lg
           hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100
           dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600
           dark:hover:bg-gray-700 dark:hover:border-gray-500 dark:focus:ring-gray-700
           transition-all duration-200">
        Volver
    </a>



</x-filament-panels::page.simple>
