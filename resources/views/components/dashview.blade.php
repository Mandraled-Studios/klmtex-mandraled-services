<div class="flex h-screen overflow-scroll pt-16">
    <aside class = "min-h-screen sticky top-0 bg-white max-w-md flex-1">
        <!-- Head Card -->
        <div class="py-6 bg-gray-200">
            <div class="flex justify-between items-center px-4">
                <div class = "flex mr-2">
                    
                    <div x-data="{ open: false }" class = "relative">
                        <div x-on:click="open = !open" class="w-12 h-12 rounded-full bg-gray-400 cursor-pointer overflow-hidden">
                            <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>

                        <div x-show="open" class="p-3 bg-gray-100 absolute top-12">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link class="block w-48" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </div>
                    </div>

                    <div class = "px-4">
                        <h2 class = "text-lg font-bold"> Hi, {{auth()->user()->name}}! </h2>
                        <p class = "text-gray-600"> {{auth()->user()->email}} </p>
                    </div>
                </div>
                <div class = "relative">
                    <a href="/notifications">
                        <img class = "w-8 h-8" src="{{asset('images/icons/notification.svg')}}" alt="notifications">
                    </a>
                    <div class="absolute bg-red-500 text-white w-4 h-4 rounded-full top-0 -right-1 flex justify-center items-center">
                        <span class = "text-sm font-bold"> {{"1"}} </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Menu -->
        <nav class="py-6">
            <ul>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected1) {{$selected1}} @endif" href="/dashboard"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/dashboard.svg')}}" alt="dashboard"> My Dashboard </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected3) {{$selected3}} @endif" href="/categories"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/categories.svg')}}" alt="categories"> Categories </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected4) {{$selected4}} @endif" href="/subcategories"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/subcategories.svg')}}" alt="subcategories"> Primary Sub Categories </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected5) {{$selected5}} @endif" href="/secondary-subcategories"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/shopping-bag.svg')}}" alt="collections"> Secondary Sub Categories </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected6) {{$selected6}} @endif" href="/products"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/cart.svg')}}" alt="products"> Products </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected7) {{$selected7}} @endif" href="/inventory"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/inventory.svg')}}" alt="inventory"> Inventory </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected8) {{$selected8}} @endif" href="/orders"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/orders.svg')}}" alt="orders"> Orders </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected9) {{$selected9}} @endif" href="/payments"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/payments.svg')}}" alt="payments"> Payments </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected10) {{$selected10}} @endif" href="/reviews"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/ratings.svg')}}" alt="reviews"> Reviews </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected11) {{$selected11}} @endif" href="/support"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/support.svg')}}" alt="support"> Support </a>
                </li>
                <li class = "mb-4">
                    <a class = "flex items-center py-2 px-4 text-lg @isset($selected2) {{$selected2}} @endif" href="/store-setup"> <img class = "w-9 h-9 mr-4" src="{{asset('images/icons/store.svg')}}" alt="store"> My Shop Settings </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class = "flex-1 px-6">
        <div class="py-8">
            <div class="container mx-auto sm:px-6">
                <div class = "flex justify-between mb-6">
                    <div class="p-2 bg-gray-300 rounded-md"> {{$goback}} </div>
                    <p class = "p-2 bg-gray-300 rounded-md text-md"> You are here: {{$breadcrumb}} </p>
                </div>
                <h1 class = "text-3xl font-bold mb-6"> {{$heading}} </h1>
                <div class="w-full sm:rounded-lg">
                    {{$slot}}
                </div>
            </div>
        </div>
    </main>
</div>