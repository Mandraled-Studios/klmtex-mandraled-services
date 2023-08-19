<x-admin-layout>
    <x-slot name="pagescript">
        <script>
            if($("#has_offers").is(':checked')) {
                $("#offer_subsection").removeClass("hidden");
            } else {
                $("#offer_subsection").addClass("hidden");
            }
            // Open Offers
            $("#has_offers").on("change", function() {
                if($("#has_offers").is(':checked')) {
                    $("#offer_subsection").removeClass("hidden");
                } else {
                    $("#offer_subsection").addClass("hidden");
                }
            });

        </script>
    </x-slot>

    <x-dashview>  
        <x-slot name="heading">
            Run Offers On Product
        </x-slot>

        <x-slot name="goback">
            <a href="/products"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/products" class = "underline"> Products </a> / <a href="/products/{{$product->id}}/edit" class = "underline"> {{$product->name}} </a>  <span> / Banner Images </span>
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
                <div class="mb-6 border border-gray-200 shadow-md opacity-30 p-3 bg-gray-200">
                    
                </div>
                
                <!-- Banner -->
                <div class="mb-6 border border-gray-200 shadow-md opacity-30 p-3 bg-gray-200">
                    
                </div>

                <!-- Attributes -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    
                </div>

                <!-- Offers -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 bg-gray-200">
                    <label for="has_offers" class = "block mb-2 text-sm"> Add offers to product? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="has_offers" id="has_offers" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_offers') || $product->offers->count() > 0 == 1 ? "checked" : null}} />
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
                        <table class="bg-white shadow-md mb-6">
                            @foreach ($offers as $offer)
                                <tr class="p-4">
                                    <td class="w-1/3 p-2 text-center"> 
                                        @if ($offer->icon)
                                            <img class="w-full h-24 object-contain object-center" src="{{$offer->icon}}" />
                                        @else
                                            <img class="w-full h-24 object-contain object-center" src="https://ui-avatars.com/api/?name=Not+Applicable" />
                                        @endif 
                                    </td>
                                    <td class="w-2/3 p-2"> 
                                        <h3 class="capitalize font-bold text-lg mb-4"> {{$offer->title}} </h3>
                                        <p class="mb-4"> {{$offer->details}} </p>
                                        <p class="text-sm"> {{$offer->disclaimer}} </p>
                                        <a class="text-sm underline mb-4" href="{{$offer->link}}"> Read Offers T&C </a>
                                        <form class="mt-4" action="/products/{{$product->id}}/offers/{{$offer->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="px-2 py-1 bg-red-500 text-white" value="Delete" />
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <form action="/products/{{$product->id}}/offers" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="block" for=""> Add Offers </label>
                            <div class="flex flex-none">
                                <div class="w-full md:w-1/2">
                                    <input type="text" name="title" placeholder = "Add Offer Title" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                    @if($errors->has('title'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('title') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-full md:w-1/2">
                                    <input type="text" name="link" placeholder = "Add Offer Link" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                    @if($errors->has('link'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('link') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-none">            
                                <div class="w-full md:w-1/2">
                                    <input type="text" name="disclaimer" placeholder = "Add Offer Disclaimer" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                    @if($errors->has('disclaimer'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('disclaimer') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-full md:w-1/2">
                                    <input type="file" name="icon" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
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
                            </div>
                            <div class="flex flex-none">
                                <div class="w-full md:w-1/2">
                                    <input type="text" name="details" placeholder = "Add Offer Details" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                    @if($errors->has('details'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('details') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between pt-6">
                                <div class="flex justify-between">
                                    <a href = "/products/{{$product->id}}/attributes/create" class = "px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 mr-3"> Go Back To Previous Step </a>
                                    <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-gray-700 bg-amber-300 hover:bg-amber-400" value="Save & Add One More Offer">
                                </div>
                                <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Save & Proceed to Next Step">
                            </div>
                        </form>
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
                <x-sidebar_index pid="{{$product->id}}" step="7" newproduct="{{false}}"></x-sidebar_index>
            </div>
        </div>
    </x-dashview>
</x-admin-layout>