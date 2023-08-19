<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Add A New Category
        </x-slot>

        <x-slot name="goback">
            <a href="/categories"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/categories" class = "underline">Categories</a> <span> / Create a new category </span>
        </x-slot>

        <x-slot name="selected3">
            {{__("bg-blue-400 text-white")}}
        </x-slot>

        <div class="w-full p-4">
            <form class = "w-full md:w-3/4 px-4" action="/categories" method = "POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="name" class = "block mb-2 text-sm"> Category Name </label>
                    <input type="text" name = "name" id = "name" placeholder = "Enter a new category name (eg. Smart Phones)" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('name')}}" required />
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
                    <label for="metatitle" class = "block mb-2 text-sm"> Category Meta Title </label>
                    <input type="text" name = "metatitle" id = "metatitle" placeholder = "Enter a meta title for the category (eg. Smart Phones)" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('metatitle')}}" />
                    @if($errors->has("metatitle"))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('metatitle') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="keywords" class = "block mb-2 text-sm"> Category Keywords </label>
                    <input type="text" name = "keywords" id = "keywords" placeholder = "Enter keywords for the category separated by commas (eg. smartphone, feature phone, mobile phone, android phone)" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('keywords')}}" />
                    @if($errors->has('keywords'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('keywords') as $error)
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
                    <label for="description" class = "block mb-2 text-sm"> Description (Optional) </label>
                    <textarea name = "description" id = "description" placeholder = "Enter a description for category" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{old('description')}}</textarea>
                    @if($errors->has('description'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('description') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="isActive" class = "block mb-2 text-sm"> Is Category Visible In Main Menu? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="isActive" id="isActive" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" {{old('isActive') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                </div>
                <div class="mb-6">
                    <input type="submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Create Category">
                </div>
            </form>
        </div>
    </x-dashview>
</x-admin-layout>