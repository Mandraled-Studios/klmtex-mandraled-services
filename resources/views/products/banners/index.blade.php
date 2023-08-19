<x-admin-layout>
    <x-slot name="pagescript">
        <script>
            if($("#has_banner").is(':checked')) {
                $("#banner_subsection").removeClass("hidden");
            } else {
                $("#banner_subsection").addClass("hidden");
            }
            // Open Banner
            $("#has_banner").on("change", function() {
                if($("#has_banner").is(':checked')) {
                    $("#banner_subsection").removeClass("hidden");
                } else {
                    $("#banner_subsection").addClass("hidden");
                }
                
            });

        </script>
    </x-slot>

    <x-dashview>  
        <x-slot name="heading">
            Add Banner Images For Product - {{$product->name}}
        </x-slot>

        <x-slot name="goback">
            <a href="/products"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/products" class = "underline"> Products </a> / 
            <a href="/products/{{$product->id}}/edit" class = "underline"> {{$product->name}} </a>  
            <span> / Banner Images </span>
        </x-slot>

        <x-slot name="selected6">
            {{__("bg-blue-400 text-white")}}
        </x-slot>

        <div class="w-full h-screen overflow-y-scroll md:flex">
            <div class = "w-full min-h-screen md:w-8/12">
                <div id="general_subsection" class = "opacity-30 bg-gray-200 mb-6 p-4 border border-gray-200 shadow-md">
                    
                </div>

                <!------------- Booleans ------------>

                <!-- Variants -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    
                </div>

                <!-- Stock -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    
                </div>

                <!-- Highlights -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    
                </div>
                
                <!-- Banner -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 bg-gray-200">
                        <label for="has_banner" class = "block mb-2 text-sm"> Do you want to add a banner section? </label>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input type="checkbox" name="has_banner" id="has_banner" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_banner') || $product->banners->count() > 0 == 1 ? "checked" : null}} />
                            <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                        </div>
                        @if($errors->has('has_banner'))
                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                <ul>
                                @foreach ( $errors->get('has_banner') as $error)
                                    <li class = "text-sm"> {{$error}} </li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <div id = "banner_subsection" class = "hidden px-4 pb-3 py-9">
                            @foreach ($banners as $banner)
                                <div class="bg-white mb-4 shadow-md p-4">
                                    <img class="w-full object-fit object-center mb-4" src="{{$banner->banner}}" />
                                    <p class="capitalize text-center font-semibold mb-4"> {{$banner->position}} </p>
                                    <form action="/products/{{$product->id}}/banners/{{$banner->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="px-2 py-1 bg-red-500 text-white" value="Delete" />
                                    </form>
                                </div>
                            @endforeach
                            <form action="/products/{{$product->id}}/banners" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for=""> Add Banners </label>
                                <input type="file" name="banner" class="block mt-1 mb-6 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" />
                                @if($errors->has('banner'))
                                    <div class="bg-red-200 text-red-700 p-3 mb-6">
                                        <ul>
                                        @foreach ( $errors->get('banner') as $error)
                                            <li class = "text-sm"> {{$error}} </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <label for=""> Position of banner </label>
                                <select name="position" class="block mt-1 mb-6 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm">
                                    <option value="Page_Top"> Top of the page </option>
                                    <option value="Below_Description"> Below Product Description </option>
                                    <option value="Below_Highlights"> Below Highlights </option>
                                    <option value="Below_Specification"> Below Specifications </option>
                                    <option value="Page_End"> At the end of page </option>
                                </select>
                                @if($errors->has('position'))
                                    <div class="bg-red-200 text-red-700 p-3 mb-6">
                                        <ul>
                                        @foreach ( $errors->get('position') as $error)
                                            <li class = "text-sm"> {{$error}} </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="flex justify-between pt-6">
                                    <div class="flex justify-between">
                                        <a href = "/products/{{$product->id}}/highlights/create" class = "px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 mr-3"> Go Back To Previous Step </a>
                                        <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-gray-700 bg-amber-300 hover:bg-amber-400" value="Save & Add One More Banner">
                                    </div>
                                    <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Save & Proceed to Next Step">
                                </div>
                            </form>
                        </div>
                </div>

                <!-- Attributes -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    <label for="has_attributes" class = "block mb-2 text-sm"> Do you want to add spec / additional attributes about product? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input disabled type="checkbox" name="has_attributes" id="has_attributes" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_attributes') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>
                    @if($errors->has('has_attributes'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('has_attributes') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Offers -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    <label for="has_offers" class = "block mb-2 text-sm"> Add offers to product? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input disabled type="checkbox" name="has_offers" id="has_offers" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_offers') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>
                    @if($errors->has('has_offers'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('has_offers') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id = "offer_subsection" class = "hidden px-4 pb-3 py-9">
                        <label for=""> Offers </label>
                        <input type="text" placeholder = "Enter offers" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                    </div>
                </div>

                <!-- Attachments -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    <label for="has_attachments" class = "block mb-2 text-sm"> Do you want to add any attachment? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input disabled type="checkbox" name="has_attachments" id="has_attachments" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_attachments') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>
                    @if($errors->has('has_attachments'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('has_attachments') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id = "attachment_subsection" class = "hidden px-4 pb-3 py-9">
                        <label for=""> Attachments </label>
                        <input type="text" placeholder = "Enter attachments" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                    </div>
                </div>
                    
            </div>
            <div class = "w-full pt-28 md:w-4/12 sticky top-0"> 
                <x-sidebar_index pid="{{$product->id}}" step="5" newproduct="{{false}}"></x-sidebar_index>
            </div>
        </div>
    </x-dashview>
</x-admin-layout>