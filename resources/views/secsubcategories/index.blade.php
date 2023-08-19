<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Secondary Sub Categories
            @isset($term)
               containing "{{$term}}"
            @endisset
        </x-slot>
        <x-slot name="selected5">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            @isset ($_GET['term'])
                <a href="/secondary-subcategories"> &lt; Go back </a>
            @else
                <a href="/dashboard"> &lt; Go back </a>
            @endisset
        </x-slot>

        <x-slot name="breadcrumb">
            <span> Secondary sub categories </span>
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
                <a href="/secondary-subcategories/create" class="py-2 px-4 bg-green-500 text-white hover:bg-green-600"> + Create New Sec. Subcategory </a>
            </div>
            <div class = "mr-4 flex-1 text-center">
                <h4 class = "text-base"> @if(count($sec_subcategories) != 0) {{ count($sec_subcategories) != 1 ? count($sec_subcategories)." sec. subcategories found" : count($sec_subcategories)." sec. subcategory found" }} @else No sec. subcategories found @endif </h4>
            </div>
            <form class = "flex flex-1 w-max-md" action="/secondary-subcategories/search" method = "GET">
                @csrf
                <input name = "term" type="text" placeholder = "Search for a sec. subcategory" class = "block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-tl-md rounded-bl-md shadow-sm">
                <input type="submit" class="px-4 bg-green-500 text-white" value="Search" />
            </form>
        </div>

        <div class="py-2 px-3 flex flex-wrap">
            @foreach ($sec_subcategories as $sec_subcategory)
               <div class="p-4 w-full lg:w-1/2">
                    <div class = "bg-white shadow-md p-3 md:flex">
                        <div class = "flex-1">
                            <h3 class="text-xl font-bold mb-1"> {{$sec_subcategory->name}} </h3> 
                            <p class="text-base text-blue-600 font-semibold mb-1"> Category: {{$sec_subcategory->categoryName}} </h3> 
                            <p class="text-base text-blue-600 font-semibold mb-1"> Sub Category: {{$sec_subcategory->subcatName}} </h3> 
                            <p class = "text-gray-600 text-sm mb-2"> {{$sec_subcategory->is_active ? "Published in menu":"Unpublished in menu"}} </p> 
                        </div>
                        <div class = "w-20 flex items-center">
                            <a href="/secondary-subcategories/{{$sec_subcategory->id}}/edit" class="edit-btn inline-block w-8 h-8 bg-amber-400 hover:bg-amber-500 mr-2"></a>
                            <form action="/secondary-subcategories/{{$sec_subcategory->id}}" class = "flex items-center" method = "POST">
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