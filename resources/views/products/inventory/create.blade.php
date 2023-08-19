<x-admin-layout>
    <x-slot name="pagescript">
        <script>
            // Creating slug
            $("#name").on("input", function(){
                let slug_str = $(this).val().replace(/[^a-zA-Z0-9]/g,'-').toLowerCase();
                $("#slug").val(slug_str);
            });

    
            // ----------------------------------------------------------

            // Open Stocks
            if($("#is_stock_monitored").is(':checked')) {
                $("#stock_subsection").removeClass("hidden");
            } else {
                $("#stock_subsection").addClass("hidden");
            }

            $("#is_stock_monitored").on("change", function() {
                if($("#is_stock_monitored").is(':checked')) {
                    $("#stock_subsection").removeClass("hidden");
                } else {
                    $("#stock_subsection").addClass("hidden");
                }
                
            });

            // ----------------------------------------------------------

            $("#package_type").on("change", function() {
                if($("#package_type").val() == "digital") {
                    $("#length").parent().hide();
                    $("#length").parent().parent().append("<p class='p-2'> Not Applicable </p>")
                    $("#width").parent().hide();
                    $("#width").parent().parent().append("<p class='p-2'> Not Applicable </p>")
                    $("#height").parent().hide();
                    $("#height").parent().parent().append("<p class='p-2'> Not Applicable </p>")
                    $("#dimension_unit").parent().hide();
                    $("#dimension_unit").parent().parent().append("<p class='p-2'> Not Applicable </p>")
                    $("#weight").parent().hide();
                    $("#weight").parent().parent().append("<p class='p-2'> Not Applicable </p>")
                    $("#weight_unit").parent().hide();
                    $("#weight_unit").parent().parent().append("<p class='p-2'> Not Applicable </p>")
                } else {
                    $("#length").parent().show();
                    $("#width").parent().show();
                    $("#height").parent().show();
                    $("#dimension_unit").parent().show();
                    $("#weight").parent().show();
                    $("#weight_unit").parent().show();
                    $("#stock_subsection p").filter(":contains('Not Applicable')").remove();
                }
            });

        </script>
    </x-slot>

    <x-dashview>  
        <x-slot name="heading">
            Add Product SKUs For {{$product->name}}
        </x-slot>

        <x-slot name="goback">
            <a href="/products"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/products" class = "underline">Products</a> 
            <span> / </span> 
            <a href="/products/{{$product->id}}/edit" class = "underline"> {{$product->name}} </a>
            <span> / </span> 
            <span> / Add Product SKUs </span>
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
                    <label for="has_variants" class = "block mb-2 text-sm"> Does the product have variants? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input disabled type="checkbox" name="has_variants" id="has_variants" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_variants') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>
                </div>

                <!-- Stock -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 bg-gray-200">
                    <h3 class="text-lg font-bold mb-6"> Manage SKUs</h3>
                    @if($errors->has('is_stock_monitored'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('is_stock_monitored') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <label for="is_stock_monitored" class = "block mb-2 text-sm"> Want to monitor stocks for this product? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="is_stock_monitored" id="is_stock_monitored" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('is_stock_monitored') == 1 || $product->skus->count() > 0  ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>

                    <div id = "stock_subsection" class = "px-4 pb-3 py-9 hidden">
                        @if ($product->skus->count() > 0)
                            <div class="py-1 px-2 mb-8">
                                <h4 class="font-semibold mb-2"> Available SKUs</h4>
                                @foreach ($skus as $sku)
                                    <span class="inline-block px-4 py-2 bg-gray-900 text-white rounded-md mb-4 mr-3"> {{ $sku->sku_code }} </span>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{route('products.stock.store', ['id' => $product->id ])}}" method="POST">
                            @csrf
                            <table class="w-full border border-gray-900 border-collapse mb-8">
                                @foreach ($product->variants as $variant)
                                    <tr>
                                        <th class="text-left border border-gray-900 p-2"> {{$variant->name}} </th>
                                        <td class="text-center border border-gray-900 p-2">
                                            <input type="hidden" name="variant[]" value="{{$variant->id}}">
                                            <select class="w-full p-2" name="variantValue[]">
                                                @foreach ($variant->variantValues as $varValue)
                                                    <option value="{{ $varValue->id }}"> {{ $varValue->variant_value }} </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Enter SKU Number </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <input type="text" name = "sku_code" placeholder = "To uniquely identify variant" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" value="{{old('sku_code')}}" />
                                        @if($errors->has('sku_code'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('sku_code') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Enter Available Stock </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        @if($errors->has('total_stock'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('total_stock') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <input type="number" name= "total_stock" min="0" max="100000" placeholder = "Available stock quantity (in nos. or weight)" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" value="{{old('total_stock')}}" />
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Max Price </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        @if($errors->has('max_price'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('max_price') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <input type="number" name="max_price" min="0" placeholder = "Maximum Retail Price of the variant" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" value="{{old('max_price')}}" />
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Offer Price </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <input type="number" name="offer_price" min="0" placeholder = "Offer Price of the variant" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" value="{{old('offer-price')}}" />
                                        @if($errors->has('offer_price'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('offer_price') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Package Type </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <select id="package_type" name = "package_type" class="w-full p-2">
                                            <option {{ old('package_type') ==  'delivery-partner' ? 'selected' : null }} value="delivery-partner"> Physical (Delivered by Partner) </option>
                                            <option {{ old('package_type') ==  'courier' ? 'selected' : null }} value="courier"> Physical (Delivered by Courier) </option>
                                            <option {{ old('package_type') ==  'pick-up' ? 'selected' : null }} value="pick-up"> Physical (Pickup from Outlet) </option>
                                            <option {{ old('package_type') ==  'digital' ? 'selected' : null }} value="digital"> Digital </option>
                                        </select>
                                        @if($errors->has('package_type'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('package_type') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Length </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <input id="length" name="length" type="number" min="0" placeholder = "Length of the product variant" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" />
                                        @if($errors->has('length'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('length') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Width </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <input id="width" name="breadth" type="number" min="0" placeholder = "Width of the product variant" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" />
                                        @if($errors->has('width'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('width') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Height </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <input id="height" name="height" type="number" min="0" placeholder = "Height of the product variant" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" />
                                        @if($errors->has('height'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('height') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Dimensions Unit </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <select id="dimension_unit" name="dimension_unit" class="w-full p-2">
                                            <option value=""> mm (millimetre) </option>
                                            <option value=""> cm (centimetre) </option>
                                            <option value=""> m (metre) </option>
                                            <option value=""> inches </option>
                                            <option value=""> feet </option>
                                            <option value=""> yards </option>
                                        </select>
                                        @if($errors->has('dimension_unit'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('dimension_unit') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Weight </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <input id="weight" name="weight" type="number" min="0" placeholder = "Weight of the product variant" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" />
                                        @if($errors->has('weight'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('weight') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-left border border-gray-900 p-2"> Weight Unit </th>
                                    <td class="text-center border border-gray-900 p-2">
                                        <select id="weight_unit" name="weight_unit" class="w-full p-2">
                                            <option value=""> g </option>
                                            <option value=""> kg </option>
                                            <option value=""> ml </option>
                                            <option value=""> l </option>
                                            <option value=""> tonnes </option>
                                        </select>
                                        @if($errors->has('weight_unit'))
                                            <div class="bg-red-200 text-red-700 p-3 mb-6">
                                                <ul>
                                                @foreach ( $errors->get('weight_unit') as $error)
                                                    <li class = "text-sm"> {{$error}} </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            @foreach ($product->variants as $variant)
                                <input type="hidden" name="" value="{{$variant->id}}">
                            @endforeach
                            <input type="hidden" name="variant_value_id" value="">

                            <input type="submit" name="submit" class="px-4 py-2 bg-green-500 text-white rounded cursor-pointer hover:bg-green-600" value="Save SKU Details" />

                            <input type="submit" name="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded" value="Save &amp; Add New SKU Details" /> 
                        </form> 
                    </div>
                </div>

                <!-- Highlights -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    <label for="has_highlights" class = "block mb-2 text-sm"> Do you want to add highligts for product? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input disabled type="checkbox" name="has_highlights" id="has_highlights" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_highlights') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>
                    @if($errors->has('has_highlights'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('has_highlights') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id = "highlights_subsection" class = "hidden px-4 pb-3 py-9">
                        <label for=""> Highlights </label>
                        <input type="text" placeholder = "Enter highlights" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                    </div>
                </div>
                
                <!-- Banner -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    <label for="has_banner" class = "block mb-2 text-sm"> Do you want to add a banner section? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input disabled type="checkbox" name="has_banner" id="has_banner" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_banner') == 1 ? "checked" : null}} />
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
                        <label for=""> Banners </label>
                        <input type="text" placeholder = "Enter banner" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
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
                    <div id = "attribute_subsection" class = "hidden px-4 pb-3 py-9">
                        <label for=""> Attributes </label>
                        <input type="text" placeholder = "Enter attributes" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                    </div>
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
                <x-sidebar_index pid="{{$product->id}}" step="3" newproduct="{{false}}"></x-sidebar_index>
            </div>
        </div>
    </x-dashview>
</x-admin-layout>