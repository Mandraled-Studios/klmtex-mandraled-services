<x-admin-layout>
    <x-slot name="pagescript">
        <!-- Stylesheet -->
        
        <script>

            // ----------------------------------------------------------

            // Open Variants
            $("#has_variants").on("change", function() {
                if($("#has_variants").is(':checked')) {
                    $("#variant_subsection").removeClass("hidden");
                } else {
                    $("#variant_subsection").addClass("hidden");
                }
                
            });

            // Add Variants
            $("button.addVariant").on("click", function(){
                let tr = document.createElement("tr");
                let td14_1 = document.createElement("td");
                $(td14_1).addClass("w-1/4");
                let td14_2 = document.createElement("td");
                $(td14_2).addClass("w-1/4");
                let td12 = document.createElement("td");
                $(td12).addClass("w-1/2");
                
                let lbl = document.createElement("label");
                $(lbl).html("Attribute");
                $(td14_1).append($(lbl));

                let txtFld = document.createElement("input");
                $(txtFld).attr("type", "text");
                $(txtFld).attr("placeholder", "Eg. size, material, color");
                $(txtFld).addClass("block mt-1 mb-6 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm");
                $(td14_1).append($(txtFld));

                let lbl2 = document.createElement("label");
                $(lbl2).html("Variation values");
                $(td12).append($(lbl2));

                let txtFld2 = document.createElement("input");
                $(txtFld2).attr("type", "text");
                $(txtFld2).attr("placeholder", "Eg. red, green, blue");
                $(txtFld2).addClass("block mt-1 mb-6 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm");
                $(td12).append($(txtFld2));

                let deleteBtn = document.createElement("button");
                $(deleteBtn).attr("type", "button");
                $(deleteBtn).addClass("delete-btn w-8 h-8 bg-red-400 hover:bg-red-500");
                $(td14_2).append($(deleteBtn));

                $(tr).append($(td14_1));
                $(tr).append($(td12));
                $(tr).append($(td14_2));
                
                $("#variant_subsection table").append($(tr));

                
            });

            $(".triggerDropDown").on("click", function() {
                $(".dropOption").toggle();
                $('.dropOption .variantType').focus();
            });

            $(".dropOption li:not(li:last-child)").on("click", function() {
                $(this).parent().parent().parent().find(".triggerDropDown").val($(this).html());
                $(".dropOption").hide();
                $(".variableValue").show();
            });

            $(".variantType").on("keydown", function(event){
                let keycode = (event.keyCode ? event.keyCode : event.which);
                
                if(keycode == '13'){
                    $(this).parent().parent().parent().parent().find(".triggerDropDown").val($(this).val());  
                    $(".dropOption").hide();
                }
            });

            $("#addVariant").on("click", function(){
                $( ".product-variant:first-child" ).clone().appendTo( "#product-variant-container" );
            });

            // ----------------------------------------------------------

        </script>
        <script src="/js/tags.js"></script>
    </x-slot>

    <x-dashview>  
        <x-slot name="heading">
            Add A Product Variant
        </x-slot>

        <x-slot name="goback">
            <a href="/products/{{$product->id}}/edit"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/products" class = "underline"> Products </a> 
            <span> / </span> 
            <a href="/products/{{$product->id}}/edit" class = "underline"> {{$product->name}} </a>  
            <span> / Variant Types </span>
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
                <div class="mb-6 border border-gray-200 shadow-md p-3 bg-gray-200">
                    <label for="has_variants" class = "block mb-2 text-sm"> Does the product have variants? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="has_variants" id="has_variants" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_variants') == 1 || $hasVariants ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>
                    @if($errors->has('has_variants'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('has_variants') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <div id = "variant_subsection" class = "hidden px-4 pb-3 py-4">
                        @livewire('variant-form', ['product' => $product])
                    </div>
                </div>

                <!-- Stock -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                    <label for="is_stock_monitored" class = "block mb-2 text-sm"> Want to monitor stocks for this product? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input disabled type="checkbox" name="is_stock_monitored" id="is_stock_monitored" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('is_stock_monitored') == 1 ? "checked" : null}} />
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300"></label>
                    </div>
                    @if($errors->has('is_stock_monitored'))
                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                            <ul>
                            @foreach ( $errors->get('is_stock_monitored') as $error)
                                <li class = "text-sm"> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <div id = "stock_subsection" class = "hidden px-4 pb-3 py-9">
                        <label for=""> Stock Quantity </label>
                        <input type="text" placeholder = "Enter stock quantity" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
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
                <x-sidebar_index pid="{{$product->id}}" step="2" newproduct="{{false}}"></x-sidebar_index>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/assets/bootstrap-tagsinput.min.js"></script>
    </x-dashview>
</x-admin-layout>