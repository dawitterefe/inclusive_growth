<div class="lg:hidden" x-data @click.self="$store.sidebar.open = false">
    <!-- Mobile overlay -->
    <div x-show="$store.sidebar.open" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-gray-900/80" @click="$store.sidebar.open = false" style="display: none;"></div>

    <!-- Sidebar - Mobile -->
    <div x-show="$store.sidebar.open" x-transition
        class="fixed inset-y-0 left-0 z-50 w-64 bg-primary overflow-y-auto lg:hidden">
        @include('layouts.sidebar-content', ['mobile' => true])
    </div>
</div>

<!-- Sidebar - Desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-64 lg:flex-col">
    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-primary px-6 pb-4">
        @include('layouts.sidebar-content', ['mobile' => false])
    </div>
</div>
