<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <div class="flex-1">
                <h2 class="text-lg font-semibold tracking-tight text-gray-950 dark:text-white">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Ini adalah dashboard utama untuk aplikasi Forecasting ATM Anda.
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
