<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Add A New Collection
        </x-slot>

        <x-slot name="goback">
            <a href="/collections"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/collections" class = "underline">Collections</a> <span> / Create a new collection </span>
        </x-slot>

        <x-slot name="selected5">
            {{__("bg-blue-400 text-white")}}
        </x-slot>

        <div class="w-full p-4">
            <form class = "w-full md:w-3/4 px-4" action="/collections" method = "POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="name" class = "block mb-2 text-sm"> Collection Name </label>
                    <input type="text" name = "name" id = "name" placeholder = "Enter a new collection name (eg. Smart Phones)" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('name')}}" required />
                    @if($errors->has('name'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('name') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="slug" class = "block mb-2 text-sm"> Slug </label>
                    <input type="text" name = "slug" id = "slug" placeholder = "Enter a slug to show in the URL (eg. smart-phones-and-tablets)" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('slug')}}" required />
                    @if($errors->has('slug'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('slug') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="hero" class = "block mb-2 text-sm"> Hero Image (Optional) </label>
                    <input type="file" name = "hero" id = "hero" placeholder = "Enter a slug to show in the URL (eg. smart-phones-and-tablets)" class = "block mt-1 w-full" value = "{{old('hero')}}" />
                    @if($errors->has('hero'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('hero') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="icon" class = "block mb-2 text-sm"> Icon (Optional) </label>
                    <input type="file" name = "icon" id = "icon" placeholder = "Enter a slug to show in the URL (eg. smart-phones-and-tablets)" class = "block mt-1 w-full" value = "{{old('icon')}}" />
                    @if($errors->has('icon'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('icon') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="isActive" class = "block mb-2 text-sm"> Is Collection Visible Under Subcategory In Dropdown? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="isActive" id="isActive" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" {{old('isActive') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                </div>
                <div class="mb-6">
                    <input type="submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Create Collection">
                </div>
            </form>
        </div>
    </x-dashview>
</x-admin-layout>