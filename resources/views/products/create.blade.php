<x-admin-layout>
    <x-slot name="pagescript">
        <script>
            // Creating slug
            $("#name").on("input", function(){
                let slug_str = $(this).val().replace(/[^a-zA-Z0-9]/g,'-').toLowerCase();
                $("#slug").val(slug_str);
            });

            // ----------------------------------------------------------

            // Product assigned to?
            $(document).ready(function(){
                console.log("I am in");
                let choice = $("#productable_type").val();

                $("#optionalColumn1").addClass("hidden");
                $("#optionalColumn2").addClass("hidden");

                // Product assigned to categories
                if(choice == "categories") {
                    $.ajax({
                    url: '/api/products/choices/categories',
                    type: 'GET',
                    data: "under="+choice,
                    success: function(result) {
                                $("#productable_id").html("<option value = '0'> Choose an option </option>")
                                for(res of result) {
                                    let opt = document.createElement("option");
                                    $(opt).attr("value", res['id']);
                                    $(opt).html(res['name']);
                                    $("#productable_id").append(opt);
                                }
                            }
                        }
                    );
                } // Product assigned to subcategories
                else if(choice == "subcategories") {
                    console.log("I am in");
                    $("#productable_id").html("<option value = '0'> Please answer the previous question </option>");
                    $("#optionalColumn1").removeClass("hidden");
                    $.ajax({
                    url: '/api/products/choices/categories',
                    type: 'GET',
                    data: "under="+choice,
                    success: function(result) {
                                $("#main_category").html("<option value = '0'> Choose an option </option>");
                                for(res of result) {
                                    let opt = document.createElement("option");
                                    $(opt).attr("value", res['id']);
                                    $(opt).html(res['name']);
                                    $("#main_category").append(opt);
                                }
                            }
                        }
                    );
                    $("#main_category").on("change", function() {
                        let mcChoice = $("#main_category").val();
                        $.ajax({
                                url: '/api/products/choices/subcategories/'+mcChoice,
                                type: 'GET',
                                success: function(result) {
                                            $("#productable_id").html("<option value = '0'> Choose an option </option>")
                                            for(res of result) {
                                                let opt = document.createElement("option");
                                                $(opt).attr("value", res['id']);
                                                $(opt).html(res['name']);
                                                $("#productable_id").append(opt);
                                            }
                                        }
                                }
                            );
                    });
                } // Product assigned to secondary sub categories
                else if (choice == "secondary_subcategories") {
                    $("#productable_id").html("<option value = '0'> Please answer the previous question </option>");
                    $("#optionalColumn2").removeClass("hidden");

                    $.ajax({
                    url: '/api/products/choices/categories',
                    type: 'GET',
                    data: "under="+choice,
                    success: function(result) {
                                $("#main_category2").html("<option value = '0'> Choose an option </option>");
                                for(res of result) {
                                    let opt = document.createElement("option");
                                    $(opt).attr("value", res['id']);
                                    $(opt).html(res['name']);
                                    $("#main_category2").append(opt);
                                }
                            }
                        }
                    );
                    $("#main_category2").on("change", function() {
                        let mcChoice = $("#main_category2").val();
                        $.ajax({
                                url: '/api/products/choices/subcategories/'+mcChoice,
                                type: 'GET',
                                success: function(result) {
                                            $("#sub_category2").html("<option value = '0'> Choose an option </option>")
                                            for(res of result) {
                                                let opt = document.createElement("option");
                                                $(opt).attr("value", res['id']);
                                                $(opt).html(res['name']);
                                                $("#sub_category2").append(opt);
                                            }

                                            $("#sub_category2").on("change", function(){
                                                let scChoice = $("#sub_category2").val();
                                        
                                                $.ajax({
                                                        url: '/api/products/choices/secondary-subcategories/'+scChoice,
                                                        type: 'GET',
                                                        success: function(result) {
                                                                    $("#productable_id").html("<option value = '0'> Choose an option </option>")
                                                                    for(res of result) {
                                                                        let opt = document.createElement("option");
                                                                        $(opt).attr("value", res['id']);
                                                                        $(opt).html(res['name']);
                                                                        $("#productable_id").append(opt);
                                                                    }
                                                                }
                                                        }
                                                    );
                                                });
                                        }
                                }
                            );
                    });
                }
            });


            $("#productable_type").on('change', function(){
                let choice = $("#productable_type").val();

                $("#optionalColumn1").addClass("hidden");
                $("#optionalColumn2").addClass("hidden");

                // Product assigned to categories
                if(choice == "categories") {
                    $.ajax({
                    url: '/api/products/choices/categories',
                    type: 'GET',
                    data: "under="+choice,
                    success: function(result) {
                                $("#productable_id").html("<option value = '0'> Choose an option </option>")
                                for(res of result) {
                                    let opt = document.createElement("option");
                                    $(opt).attr("value", res['id']);
                                    $(opt).html(res['name']);
                                    $("#productable_id").append(opt);
                                }
                            }
                        }
                    );
                } // Product assigned to subcategories
                else if(choice == "subcategories") {
                    $("#productable_id").html("<option value = '0'> Please answer the previous question </option>");
                    $("#optionalColumn1").removeClass("hidden");
                    $.ajax({
                    url: '/api/products/choices/categories',
                    type: 'GET',
                    data: "under="+choice,
                    success: function(result) {
                                $("#main_category").html("<option value = '0'> Choose an option </option>");
                                for(res of result) {
                                    let opt = document.createElement("option");
                                    $(opt).attr("value", res['id']);
                                    $(opt).html(res['name']);
                                    $("#main_category").append(opt);
                                }
                            }
                        }
                    );
                    $("#main_category").on("change", function() {
                        let mcChoice = $("#main_category").val();
                        $.ajax({
                                url: '/api/products/choices/subcategories/'+mcChoice,
                                type: 'GET',
                                success: function(result) {
                                            $("#productable_id").html("<option value = '0'> Choose an option </option>")
                                            for(res of result) {
                                                let opt = document.createElement("option");
                                                $(opt).attr("value", res['id']);
                                                $(opt).html(res['name']);
                                                $("#productable_id").append(opt);
                                            }
                                        }
                                }
                            );
                    });
                } // Product assigned to secondary sub categories
                else if (choice == "secondary_subcategories") {
                    $("#productable_id").html("<option value = '0'> Please answer the previous question </option>");
                    $("#optionalColumn2").removeClass("hidden");

                    $.ajax({
                    url: '/api/products/choices/categories',
                    type: 'GET',
                    data: "under="+choice,
                    success: function(result) {
                                $("#main_category2").html("<option value = '0'> Choose an option </option>");
                                for(res of result) {
                                    let opt = document.createElement("option");
                                    $(opt).attr("value", res['id']);
                                    $(opt).html(res['name']);
                                    $("#main_category2").append(opt);
                                }
                            }
                        }
                    );
                    $("#main_category2").on("change", function() {
                        let mcChoice = $("#main_category2").val();
                        $.ajax({
                                url: '/api/products/choices/subcategories/'+mcChoice,
                                type: 'GET',
                                success: function(result) {
                                            $("#sub_category2").html("<option value = '0'> Choose an option </option>")
                                            for(res of result) {
                                                let opt = document.createElement("option");
                                                $(opt).attr("value", res['id']);
                                                $(opt).html(res['name']);
                                                $("#sub_category2").append(opt);
                                            }

                                            $("#sub_category2").on("change", function(){
                                                let scChoice = $("#sub_category2").val();
                                        
                                                $.ajax({
                                                        url: '/api/products/choices/secondary-subcategories/'+scChoice,
                                                        type: 'GET',
                                                        success: function(result) {
                                                                    $("#productable_id").html("<option value = '0'> Choose an option </option>")
                                                                    for(res of result) {
                                                                        let opt = document.createElement("option");
                                                                        $(opt).attr("value", res['id']);
                                                                        $(opt).html(res['name']);
                                                                        $("#productable_id").append(opt);
                                                                    }
                                                                }
                                                        }
                                                    );
                                                });
                                        }
                                }
                            );
                    });
                }
            });

        </script>
    </x-slot>

    <x-dashview>  
        <x-slot name="heading">
            Add A New Product
        </x-slot>

        <x-slot name="goback">
            <a href="/products"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/products" class = "underline">Products</a> <span> / Create a new product </span>
        </x-slot>

        <x-slot name="selected6">
            {{__("bg-blue-400 text-white")}}
        </x-slot>

        <div class="w-full h-screen overflow-y-scroll md:flex">
            <div class = "w-full min-h-screen md:w-8/12">
                <div id="general_subsection" class = "bg-white mb-6 p-4 border border-gray-200 shadow-md">
                    <form action="{{route('products')}}" method = "POST" enctype="multipart/form-data">
                        @csrf 
                        <!-- General Details -->                   
                        <h2 class="font-semibold mb-4"> General Product Details </h2>
                        <div class="mb-6">
                            <label for="name" class = "block mb-2 text-sm"> Product Name </label>
                            <input type="text" name = "name" id = "name" placeholder = "Enter a new product name (eg. Smart Phones)" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('name')}}" required />
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
                            <label for="short_description" class = "block mb-2 text-sm"> Short Description </label>
                            <textarea name = "short_description" id = "short_description" placeholder = "Enter a short description for product" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{old('short_description')}}</textarea>
                            @if($errors->has('short_description'))
                                <div class="bg-red-200 text-red-700 p-3 mb-6">
                                    <ul>
                                    @foreach ( $errors->get('short_description') as $error)
                                        <li class = "text-sm"> {{$error}} </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label for="long_description" class = "block mb-2 text-sm"> Long Description </label>
                            <textarea rows="10" name = "long_description" id = "long_description" placeholder = "Enter a long description for product" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{old('long_description')}}</textarea>
                            @if($errors->has('long_description'))
                                <div class="bg-red-200 text-red-700 p-3 mb-6">
                                    <ul>
                                    @foreach ( $errors->get('long_description') as $error)
                                        <li class = "text-sm"> {{$error}} </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label for="thumbnail_path" class = "block mb-2 text-sm"> Thumbnail Image For Product </label>
                            <input type="file" name = "thumbnail_path" id = "thumbnail_path" class = "block mt-1 w-full" />
                            @if($errors->has('thumbnail_path'))
                                <div class="bg-red-200 text-red-700 p-3 mb-6">
                                    <ul>
                                    @foreach ( $errors->get('thumbnail_path') as $error)
                                        <li class = "text-sm"> {{$error}} </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label for="tag1" class = "block mb-2 text-sm"> Add an optional label </label>
                            <select name = "tag1" id = "tag1" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                <option value="0"> Choose an option </option>
                                <option value="bestselling" {{ old('tag1') == "bestselling" ? 'selected' : null }}> Best Selling </option>
                                <option value="editorchoice" {{ old('tag1') == "editorchoice" ? 'selected' : null }}> Editor's Choice </option>
                            </select>
                            @if($errors->has('tag1'))
                                <div class="bg-red-200 text-red-700 p-3 mb-6">
                                    <ul>
                                    @foreach ( $errors->get('tag1') as $error)
                                        <li class = "text-sm"> {{$error}} </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label for="tag2" class = "block mb-2 text-sm"> Add an optional second label </label>
                            <select name = "tag2" id = "tag2" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                <option value="0"> Choose an option </option>
                                <option value="bestselling" {{ old('tag2') == "bestselling" ? 'selected' : null }}> Best Selling </option>
                                <option value="editorchoice" {{ old('tag2') == "editorchoice" ? 'selected' : null }}> Editor's Choice </option>
                            </select>
                            @if($errors->has('tag2'))
                                <div class="bg-red-200 text-red-700 p-3 mb-6">
                                    <ul>
                                    @foreach ( $errors->get('tag2') as $error)
                                        <li class = "text-sm"> {{$error}} </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label for="tax_slab" class = "block mb-2 text-sm"> Tax Slab </label>
                            <input type="text" name = "tax_slab" id = "tax_slab" placeholder = "Enter the tax slab of product (eg. 12 for 12%) " class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('tax_slab')}}" required />
                            @if($errors->has('tax_slab'))
                                <div class="bg-red-200 text-red-700 p-3 mb-6">
                                    <ul>
                                    @foreach ( $errors->get('tax_slab') as $error)
                                        <li class = "text-sm"> {{$error}} </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label for="allows_questions" class = "block mb-2 text-sm"> Allow customers to ask questions on product page? </label>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" name="allows_questions" id="allows_questions" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('allows_questions') == 1 ? "checked" : null}} />
                                <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                            @if($errors->has('allows_questions'))
                                <div class="bg-red-200 text-red-700 p-3 mb-6">
                                    <ul>
                                    @foreach ( $errors->get('allows_questions') as $error)
                                        <li class = "text-sm"> {{$error}} </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label for="is_active" class = "block mb-2 text-sm"> Is Product Published? </label>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" name="is_active" id="is_active" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" {{old('is_active') == 1 ? "checked" : null}} />
                                <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>
                        <div class="mb-6">
                            <h2 class="font-semibold mb-4"> Assign Product To </h2>
                            <div class="mb-6">
                                <label for="productable_type" class = "block mb-2 text-sm"> Create Product Under Main Category, Sub Category or Secondary Sub Category? </label>
                                <select name = "productable_type" id = "productable_type" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                    <option value="0"> Choose an option </option>
                                    <option {{ old('productable_type') == "categories" ? 'selected' : null }} value="categories"> Main Category </option>
                                    <option {{ old('productable_type') == "subcategories" ? 'selected' : null }} value="subcategories"> Sub Category </option>
                                    <option {{ old('productable_type') == "secondary_subcategories" ? 'selected' : null }} value="secondary_subcategories"> Secondary Sub Category </option>
                                </select>
                                @if($errors->has('productable_type'))
                                    <div class="bg-red-200 text-red-700 p-3 mb-6">
                                        <ul>
                                        @foreach ( $errors->get('productable_type') as $error)
                                            <li class = "text-sm"> {{$error}} </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="hidden" id = "optionalColumn1">
                                <div class="mb-6">
                                    <label for="main_category" class = "block mb-2 text-sm"> The sub category is under which main category? </label>
                                    <select name = "main_category" id = "main_category" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                        <option value="0"> Please answer the previous question </option>
                                    </select>
                                    @if($errors->has('main_category'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('main_category') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="hidden" id = "optionalColumn2">
                                <div class="mb-6">
                                    <label for="main_category2" class = "block mb-2 text-sm"> The secondary sub category is under which main category? </label>
                                    <select name = "main_category2" id = "main_category2" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                        <option value="0"> Please answer the previous question </option>
                                    </select>
                                    @if($errors->has('main_category2'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('main_category2') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-6">
                                    <label for="sub_category2" class = "block mb-2 text-sm"> The secondary sub category is under which sub cateopry? </label>
                                    <select name = "sub_category2" id = "sub_category2" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                        <option value="0"> Please answer the previous question </option>
                                    </select>
                                    @if($errors->has('sub_category2'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('sub_category2') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="productable_id" class = "block mb-2 text-sm"> Choose option below which product should appear </label>
                                <select name = "productable_id" id = "productable_id" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                    <option value="0"> Choose an option for the first question </option>
                                </select>
                                @if($errors->has('productable_id'))
                                    <div class="bg-red-200 text-red-700 p-3 mb-6">
                                        <ul>
                                        @foreach ( $errors->get('productable_id') as $error)
                                            <li class = "text-sm"> {{$error}} </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-6">
                            <h2 class="font-semibold mb-4"> SEO </h2>
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
                                <label for="metatitle" class = "block mb-2 text-sm"> Product Metatitle </label>
                                <input type="text" name = "metatitle" id = "metatitle" placeholder = "Enter a new product metatitle (eg. Smart Phones)" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('metatitle')}}" required />
                                @if($errors->has('metatitle'))
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
                                <label for="keywords" class = "block mb-2 text-sm"> Keywords For Products </label>
                                <input type="text" name = "keywords" id = "keywords" placeholder = "Enter keywords for products" class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value = "{{old('keywords')}}" required />
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
                        </div>
                        <div class="mb-6">
                            <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-gray-700 bg-blue-400 hover:bg-blue-500" value="Create Product & Exit">
                            <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Save & Proceed to Next Step">
                        </div>
                    </form>
                </div>

                    <!------------- Booleans ------------>

                    <!-- Variants -->
                    <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                        <label for="has_variants" class = "block mb-2 text-sm"> Does the product have variants? </label>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input disabled type="checkbox" name="has_variants" id="has_variants" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_variants') == 1 ? "checked" : null}} />
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

                        <div id = "variant_subsection" class = "hidden px-4 pb-3 py-9">
                            <div class="max-w-sm mb-6">
                                <p class = "mb-2"> Choose the product attribute that varies </p>
                                <div class="mr-8">
                                <div class="border border-gray-400 relative">
                                    <input readonly class="triggerDropDown w-full p-2 block hover:bg-gray-200 cursor-pointer" placeholder = "Choose an option" />
                                    <div class="dropOption hidden rounded bg-white shadow-md my-2 absolute top-8 left-0 w-full z-10">
                                        <ul class="list-reset cursor-pointer">
                                            <li class="p-2 block text-black hover:bg-gray-200"> Size </li>
                                            <li class="p-2 block text-black hover:bg-gray-200"> Color </li>
                                            <li class="p-2 block text-black hover:bg-gray-200"> Material </li>
                                            <li class="p-2"><input type = "text" placeholder = "Or type your own" class="border-2 rounded h-8 w-full"><br></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                            
                            <button type = "button" class = "add_variant px-4 py-2 bg-blue-500 text-white hover:bg-blue-500"> Add another variation </button>
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
                <x-sidebar_index pid="{{NULL}}" step="1" newproduct="{{true}}"></x-sidebar_index>
            </div>
        </div>
    </x-dashview>
</x-admin-layout>