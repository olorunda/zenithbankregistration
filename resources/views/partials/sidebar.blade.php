<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed z-30 inset-y-0 left-0 w-60 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 border-r border-r-main shadow-lg">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <a href="{{ route('portal.dashboard') }}">
                <img src="/assets/images/logo.png" alt="" class="w-16">
            </a>
        </div>
    </div>

    <nav class="flex flex-col mt-10 text-center">
        <a href="{{ route('portal.dashboard') }}"
            class="font-Poppins py-3 text-sm flex items-center space-x-3 {{ request()->is('portal/admin/dashboard') ? 'bg-red-600 text-white' : 'text-red-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('portal.attendances') }}"
            class="font-Poppins py-3 text-sm flex items-center space-x-3 {{ request()->is('portal/admin/attendances') ? 'bg-red-600 text-white' : 'text-red-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 ml-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
              </svg>

            <span>Attendances</span>
        </a>
    </nav>
</div>
