<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Products 
            @isset($term)
               containing "{{$term}}"
            @endisset
        </x-slot>
        <x-slot name="selected6">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            <a href="/dashboard"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <span> Products </span>
        </x-slot>

        @if (session()->has('success'))
            <div class="p-3 bg-green-200 text-green-700 mb-6">
                {{ session()->get('success') }}
            </div>
        @elseif (session()->has('danger'))
            <div class="p-3 bg-red-200 text-red-700 mb-6">
                {{ session()->get('danger') }}
            </div>
        @endif

        <div class="w-full py-2 px-3 bg-gray-200 text-gray-700 flex justify-between items-center">
            <div class = "mr-4">
                <a href="/products/create" class="py-2 px-4 bg-green-500 text-white hover:bg-green-600"> + Create New Product </a>
            </div>
            <div class = "mr-4 flex-1 text-center">
                <h4 class = "text-base"> @if(count($products) != 0) {{ count($products) != 1 ? count($products)." products found" : count($products)." products found" }} @else No products found @endif </h4>
            </div>
            <form class = "flex flex-1 w-max-md" action="/products/search" method = "GET">
                @csrf
                <input type="text" name = "term" placeholder = "Search for a product" class = "block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-tl-md rounded-bl-md shadow-sm">
                <input type="submit" class="px-4 bg-green-500 text-white" value="Search" />
            </form>
        </div>

        <div class="py-2 flex flex-wrap">
            @foreach ($products as $product)
               <div class="p-1 w-full lg:w-1/2">
                    <div class = "bg-white shadow-md p-3 md:flex">
                        <div class="w-24 h-24 mr-3">
                            <img src="{{$product->thumbnail_path}}" alt="">
                        </div>
                        <div class = "flex-1">
                            <h3 class="text-xl font-bold mb-1"> {{$product->name}} </h3> 
                            @php
                                $under = $product->productable->name ? $product->productable->name : "(Invalid Mapping)";
                                $prod_type = $product->productable_type == "secondary_subcategories" ? "Secondary Subcategory" : $product->productable_type;
                            @endphp
                            <p class="text-base text-blue-600 font-semibold mb-1"> Available under: {{ $under." (".$prod_type.")" }} </h3> 
                            <p class = "text-gray-600 text-sm mb-2"> {{$product->is_active ? "Published":"Unpublished"}} </p> 
                        </div>
                        <div class = "w-20 flex items-center">
                            <a href="/products/{{$product->id}}/edit" class="edit-btn inline-block w-8 h-8 bg-amber-400 hover:bg-amber-500 mr-2"></a>
                            <form action="/products/{{$product->id}}" class = "flex items-center" method = "POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class = "delete-btn inline-block w-8 h-8 bg-red-400 hover:bg-red-500" value="">
                            </form>
                        </div>  
                    </div>
                </div> 
            @endforeach
        </div>

    </x-dashview>
</x-admin-layout>