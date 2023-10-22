<nav x-data="{ open: false }" class="fixed w-full top-0 z-50 bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{$company->logo??}}" class="h-14" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
