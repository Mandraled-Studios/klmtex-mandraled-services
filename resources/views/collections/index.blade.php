<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Collections
        </x-slot>
        <x-slot name="selected5">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            <a href="/dashboard"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <span> Collections </span>
        </x-slot>

        <div class="w-full py-2 px-3 bg-gray-200 text-gray-700 flex justify-between items-center">
            <div class = "mr-4">
                <a href="/collections/create" class="py-2 px-4 bg-green-500 text-white hover:bg-green-600"> + Create New Collection </a>
            </div>
            <div class = "mr-4 flex-1 text-center">
                <h4 class = "text-base"> {{ "0" }} collection(s) found </h4>
            </div>
            <form class = "flex flex-1 w-max-md" action="/collections/search" method = "GET">
                @csrf
                <input type="text" placeholder = "Search for a collection" class = "block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-tl-md rounded-bl-md shadow-sm">
                <input type="submit" class="px-4 bg-green-500 text-white" value="Search" />
            </form>
        </div>
    </x-dashview>
</x-admin-layout>