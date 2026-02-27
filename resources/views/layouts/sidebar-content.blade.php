@php
    $navItems = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'],
        ['label' => 'Documents', 'route' => 'documents.index', 'icon' => 'document'],
        ['label' => 'Employee Directory', 'route' => 'directory.index', 'icon' => 'users'],
        ['label' => 'Announcements', 'route' => 'announcements.index', 'icon' => 'megaphone'],
        ['label' => 'Quick Links', 'route' => 'links.index', 'icon' => 'link'],
    ];
    $adminItems = [
        ['label' => 'Manage Users', 'route' => 'admin.users.index', 'icon' => 'cog'],
        ['label' => 'Manage Employees', 'route' => 'admin.employees.index', 'icon' => 'users'],
        ['label' => 'Manage Departments', 'route' => 'admin.departments.index', 'icon' => 'building'],
        ['label' => 'Manage Categories', 'route' => 'admin.categories.index', 'icon' => 'document'],
        ['label' => 'Manage Announcements', 'route' => 'admin.announcements.index', 'icon' => 'megaphone'],
        ['label' => 'Manage Links', 'route' => 'admin.links.index', 'icon' => 'link'],
    ];
    $isAdmin = auth()->check() && in_array(auth()->user()->role ?? 'staff', ['admin', 'super_admin']);
@endphp
<div class="flex h-16 shrink-0 items-center px-4 {{ $mobile ?? false ? 'pt-4' : 'pt-6' }}">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
        @if(file_exists(public_path('images/logo.png')) && filesize(public_path('images/logo.png')) > 0)
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-10 w-auto" />
        @else
            <div class="h-10 w-10 rounded-lg bg-accent flex items-center justify-center">
                <span class="text-primary font-bold text-lg">IG</span>
            </div>
        @endif
        <span class="text-white font-semibold text-lg">{{ config('app.name') }}</span>
    </a>
</div>
<nav class="flex flex-1 flex-col px-2 py-4">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                @foreach ($navItems as $item)
                    @if(Route::has($item['route']))
                        <li>
                            <a href="{{ route($item['route']) }}"
                                class="{{ request()->routeIs($item['route'] . '*') || request()->routeIs(str_replace('.index','',$item['route']) . '*') ? 'bg-accent/20 text-accent' : 'text-white hover:bg-white/10' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-medium">
                                @include('layouts.icons.' . $item['icon'])
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
        @if($isAdmin)
            <li>
                <div class="text-xs font-semibold leading-6 text-white/60 uppercase tracking-wider">Admin</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">
                    @foreach ($adminItems as $item)
                        @if(Route::has($item['route']))
                            <li>
                                <a href="{{ route($item['route']) }}"
                                    class="{{ request()->routeIs('admin.' . explode('.', $item['route'])[1] . '*') ? 'bg-accent/20 text-accent' : 'text-white hover:bg-white/10' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-medium">
                                    @include('layouts.icons.' . $item['icon'])
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
        <li class="mt-auto">
            <div class="flex items-center gap-x-4 px-2 py-3 text-sm font-semibold leading-6 text-white">
                <div class="flex-auto">
                    <div class="truncate">{{ Auth::user()->name ?? 'User' }}</div>
                    <div class="text-xs text-white/60 truncate">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>
            <ul role="list" class="-mx-2 mt-2 space-y-1">
                <li>
                    <a href="{{ route('profile.edit') }}" class="text-white hover:bg-white/10 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-medium">
                        <i class="bi bi-person-fill h-6 w-6 shrink-0 text-inherit"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left text-white hover:bg-white/10 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-medium">
                            <i class="bi bi-box-arrow-right h-6 w-6 shrink-0 text-inherit"></i>
                            Log out
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
