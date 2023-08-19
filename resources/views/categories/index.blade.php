<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Categories
            @isset($term)
               containing "{{$term}}"
            @endisset
        </x-slot>

        <x-slot name="selected3">
            {{__("bg-blue-400 text-white")}}
        </x-slot>

        <x-slot name="goback">
            @isset ($_GET['term'])
                <a href="/categories"> &lt; Go back </a>
            @else
                <a href="/dashboard"> &lt; Go back </a>
            @endisset
        </x-slot>

        <x-slot name="breadcrumb">
            <span> Categories </span>
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
                <a href="/categories/create" class="py-2 px-4 bg-green-500 text-white hover:bg-green-600"> + Create New Category </a>
            </div>
            <div class = "mr-4 flex-1 text-center">
                <h4 class = "text-base"> @if(count($categories) != 0) {{ count($categories) != 1 ? count($categories)." categories found" : count($categories)." category found" }} @else No categories found @endif </h4>
            </div>
            <form class = "flex flex-1 w-max-md" action="/categories/search" method = "GET">
                @csrf
                <input type="text" name = "term" placeholder = "Search for a category" class = "block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-tl-md rounded-bl-md shadow-sm" value = "{{$term??''}}">
                <input type="submit" class="px-4 bg-green-500 text-white" value="Search" />
            </form>
        </div>

        <div class="py-2 flex flex-wrap">
            @foreach ($categories as $category)
               <div class="py-1 pr-1 w-full lg:w-1/2">
                    <div class = "bg-white shadow-md p-3 md:flex">
                        <div class = "flex-1">
                            <h3 class="text-xl font-bold mb-2"> {{$category->name}} </h3> 
                            <p class = "text-gray-600 text-sm mb-2"> {{$category->is_active ? "Published in menu":"Unpublished in menu"}} </p> 
                        </div>
                        <div class = "w-20 flex items-center">
                            <a href="/categories/{{$category->id}}/edit" class="edit-btn inline-block w-6 h-6 bg-amber-400 hover:bg-amber-500 mr-2"></a>
                            <form action="/categories/{{$category->id}}" class = "flex items-center" method = "POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class = "delete-btn cursor-pointer inline-block w-6 h-6 bg-red-400 hover:bg-red-500" value="">
                            </form>
                        </div>  
                    </div>
                </div> 
            @endforeach
        </div>
    </x-dashview>
</x-admin-layout>