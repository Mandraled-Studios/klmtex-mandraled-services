<x-admin-layout>
    <x-slot name="pagescript">
        <script>
            if($("#has_attachments").is(':checked')) {
                $("#attachment_subsection").removeClass("hidden");
            } else {
                $("#attachment_subsection").addClass("hidden");
            }

            // Open Attachment
            $("#has_attachments").on("change", function() {
                if($("#has_attachments").is(':checked')) {
                    $("#attachment_subsection").removeClass("hidden");
                } else {
                    $("#attachment_subsection").addClass("hidden");
                }
            });

            // Switch Tabs

            const tabs = Array.from(document.querySelectorAll("ul.ms-tabs li"));
            const tabTypes = ["prodImage", "prodVideo", "prodFile", "prodURL"];
            const tabContents = Array.from(document.querySelectorAll(".ms-tab-content"));

            tabs.forEach((tab, i) => {
                tab.addEventListener("click", function(){
                    tabs.forEach(t => {
                        t.classList.remove("active");
                    });
                    tab.classList.add("active");
                    
                    tabContents.forEach(tc => {
                        tc.classList.remove("active");
                    });
                    tabContents[i].classList.add("active");
                    document.getElementById("attachment_type").value = tabTypes[i];
                
                }, false);
            });

            // Delete Attachment

            function deleteAttachment(atid) {
                document.getElementById("attachmentId").value = atid;
                document.getElementById("deleteAttachment").submit();
            }

        </script>

        <style>
            ul.ms-tabs {
                display: grid;
                grid-template-columns: 49% 49%;
                column-gap: 2%;
                padding: 30px 0;
            }

            ul.ms-tabs li {
                padding: 8px 12px;
                border-radius: 6px;
                border: 1px solid transparent;
                cursor: pointer;
                background-color: rgba(155, 165, 155, 0.25);
            }

            ul.ms-tabs li.active {
                background-color: rgba(96, 165, 250, 0.5);
                border: 2px solid rgba(96, 165, 250, 1);
            }

            .ms-tab-content-image {
                width: 100%; 
            }

            .ms-tab-content {
                display: none; 
            }

            .ms-tab-content.active {
                display: block !important;
                flex-wrap: wrap;
            }

            .ms-tab-content-icon {
                width: 72px;
                height: 72px;
                margin-bottom: 20px;
                align-self: flex-start;
            }

            .ms-tab-content-title {
                font-size: 24px;
                margin-bottom: 20px;
                line-height: 32px;
                margin-left: 8px;
            }

            .ms-tab-content-description {
                font-size: 16px;
                line-height: 26px;
                margin-bottom: 24px;
            }

            @media only screen and (min-width:768px) {

                .ms-tab-content.active {
                    flex-wrap: nowrap;
                }
                    
                ul.ms-tabs {
                    display: flex;
                    width: 100%;
                    justify-content: space-between;
                }
                
                .ms-tab-content-title {
                    font-size: 36px;
                }
            }
        </style>
    </x-slot>

    <x-dashview>  
        <x-slot name="heading">
            Add Attachments To Product Description
        </x-slot>

        <x-slot name="goback">
            <a href="/products"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <a href="/products" class = "underline"> Products </a> / <a href="/products/{{$product->id}}/edit" class = "underline"> {{$product->name}} </a>  
            <span> / Attachments </span>
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
                <div class="mb-6 border border-gray-200 shadow-md p-3 opacity-30 bg-gray-200">
                
                </div>

                <!-- Attachments -->
                <div class="mb-6 border border-gray-200 shadow-md p-3 bg-gray-200">
                    <label for="has_attachments" class = "block mb-2 text-sm"> Do you want to add any attachment? </label>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="has_attachments" id="has_attachments" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none" {{old('has_attachments') == 1 || $attachments->count() > 0 ? "checked" : null}} />
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
                    <div id = "attachment_subsection" class = "hidden px-2 pb-3 py-9">
                        <ul class="ms-tabs">
                            <li class="active"> Add product images </li>
                            <li class=""> Add product videos </li>
                            <li class=""> Add files to be attached </li>
                            <li class=""> Add links </li>
                        </ul>
                        
                        <form action="/products/{{$product->id}}/attachments" method="POST" class="ms-all-tab-contents" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="attachment_type" name="attachment_type" value="prodImage" />
                            <div class="ms-tab-content active">
                                <div class="ms-flex">
                                    @foreach ( $attachments as $attachment )
                                        @if($attachment->attachment_type == "prodImage")
                                            <div class="relative inline-block w-48 h-32 mr-4 bg-white border border-2 border-gray-900 p-4 mb-6">
                                                <img src="{{$attachment->file}}" class="inline-block w-40 h-24 mb-5 mr-3 overflow-hidden object-contain object-center" />
                                                <button type="button" class="absolute top-0 right-0 inline-block px-2 bg-red-500 text-white" onclick="deleteAttachment({{$attachment->id}})">x</button>
                                            </div> 
                                        @endif
                                    @endforeach
                                    <h4 class="ms-tab-content-title ms-zenon ms-bold ms-accent"> Add product images </h4>
                                    <input type="file" name="prodImage" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4" />
                                    @if($errors->has('prodImage'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('prodImage') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    {{--
                                    <!-- Work in progress -->
                                    <select name="setting1" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4">
                                        <option value="mix"> Add to the mix </option>
                                        <option value="first"> Default First Image </option>
                                    </select>
                                    <select name="setting2" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4">
                                        <option value="optimize"> Optimize image after upload </option>
                                        <option value="no-optimize"> Don't optimize image after upload </option>
                                    </select>
                                    <select name="setting3" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4">
                                        <option value="webp"> Convert to webp </option>
                                        <option value="original"> Keep Original </option>
                                    </select>
                                    --}}
                                </div>
                            </div>
                        
                            <div class="ms-tab-content">
                                <div class="ms-flex">
                                    @foreach ( $attachments as $attachment )
                                        @if($attachment->attachment_type == "prodVideo")
                                            <div class="relative inline-block w-48 h-32 mr-4 bg-white border border-2 border-gray-900 p-4 mb-6">
                                                <iframe src="{{$attachment->file}}" class="inline-block w-40 h-24 mb-5 mr-3 overflow-hidden object-contain object-center"></iframe>
                                                <button type="button" class="absolute top-0 right-0 inline-block px-2 bg-red-500 text-white" onclick="deleteAttachment({{$attachment->id}})">x</button>
                                            </div> 
                                        @endif
                                    @endforeach

                                    <h4 class="ms-tab-content-title ms-zenon ms-bold ms-accent"> Add product videos </h4>
                                    <input type="text" name="prodVideo" placeholder="Enter YouTube or Vimeo emded code" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4" />
                                    @if($errors->has('prodVideo'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('prodVideo') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    {{--
                                    <!-- Work in progress -->
                                    <select name="setting4" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4">
                                        <option value="autoplay"> Autoplay on visit </option>
                                        <option value="onclick"> Play after click </option>
                                    </select>
                                    <select name="setting5" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4">
                                        <option value="loop"> Loop Video </option>
                                        <option value="once"> Play once & stop </option>
                                    </select>
                                    --}}
                                </div>
                            </div>
                        
                            <div class="ms-tab-content">
                                <div class="ms-flex">
                                    @foreach ( $attachments as $attachment )
                                        @if($attachment->attachment_type == "prodFile")
                                            @if($attachment->setting1 == "link")
                                                <div class="inline-block p-2 text-blue-500 underline hover:text-blue-700 mb-3"> 
                                                    <a class="mr-2" href="{{$attachment->file}}"> {{$attachment->setting2}} </a>
                                                    <button type="button" class="inline-block px-2 py-1 bg-red-500 text-white" onclick="deleteAttachment({{$attachment->id}})">x</button>
                                                </div>
                                            @else 
                                                <div class="inline-block p-2 bg-blue-500 text-white hover:bg-blue-700 mb-3 rounded"> 
                                                    <a class="mr-2" href="{{$attachment->file}}"> {{$attachment->setting2}} </a>
                                                    <button type="button" class="inline-block px-2 py-1 bg-red-500 text-white" onclick="deleteAttachment({{$attachment->id}})">x</button>
                                                </div>
                                            @endif   
                                        @endif
                                    @endforeach

                                    <h4 class="ms-tab-content-title ms-zenon ms-bold ms-accent"> Add files for download </h4>
                                    <p class="mb-4"> (shown below product description) </p>
    
                                    <input type="file" name="prodFile" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4" />
                                    @if($errors->has('prodFile'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('prodFile') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <select name="setting7" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4">
                                        <option value="button"> Display as button </option>
                                        <option value="link"> Display as link </option>
                                    </select>
                                    <label> Button (or) Link Text </label>
                                    <input type="text" name="setting8" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                </div>
                            </div>
                        
                            <div class="ms-tab-content">    
                                <div class="ms-flex">
                                    @foreach ( $attachments as $attachment )
                                        @if($attachment->attachment_type == "prodURL")
                                            @if($attachment->setting1 == "link")
                                                <div class="inline-block p-2 text-blue-500 underline hover:text-blue-700 mb-3"> 
                                                    <a class="mr-2" href="{{$attachment->file}}"> {{$attachment->setting2}} </a>
                                                    <button type="button" class="inline-block px-2 py-1 bg-red-500 text-white" onclick="deleteAttachment({{$attachment->id}})">x</button>
                                                </div>
                                            @else 
                                                <div class="inline-block p-2 bg-blue-500 text-white hover:bg-blue-700 mb-3 rounded"> 
                                                    <a class="mr-2" href="{{$attachment->file}}"> {{$attachment->setting2}} </a>
                                                    <button type="button" class="inline-block px-2 py-1 bg-red-500 text-white" onclick="deleteAttachment({{$attachment->id}})">x</button>
                                                </div>
                                            @endif   
                                        @endif
                                    @endforeach
                                    <h4 class="ms-tab-content-title ms-zenon ms-bold ms-accent"> Add links </h4>
                                    <input type="text" name="prodURL" placeholder="Add links to internal or external pages" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                    @if($errors->has('prodURL'))
                                        <div class="bg-red-200 text-red-700 p-3 mb-6">
                                            <ul>
                                            @foreach ( $errors->get('prodURL') as $error)
                                                <li class = "text-sm"> {{$error}} </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <select name="setting10" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4">
                                        <option value="button"> Display as button </option>
                                        <option value="link"> Display as link </option>
                                    </select>
                                    <label> Button (or) Link Text </label>
                                    <input type="text" name="setting11" class="inline-block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                </div>
                            </div>

                            <div class="flex justify-between pt-6">
                                <div class="flex justify-between">
                                    <a href = "/products/{{$product->id}}/offers/create" class = "px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 mr-3"> Go Back To Previous Step </a>
                                    <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-gray-700 bg-amber-300 hover:bg-amber-400" value="Save & Add One More Attachment">
                                </div>
                                <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Save & Complete">
                            </div>
                        </form>

                        <form id="deleteAttachment" class="hidden" action="/products/{{$product->id}}/attachments" method="POST">
                            @csrf
                            @method('DELETE')
                            <input id="attachmentId" type="hidden" name="attachmentId" value="">
                        </form>
                    </div>
                </div>
                    
            </div>
            <div class = "w-full pt-28 md:w-4/12 sticky top-0"> 
                <x-sidebar_index pid="{{$product->id}}" step="8" newproduct="{{false}}"></x-sidebar_index>
            </div>
        </div>
    </x-dashview>
</x-admin-layout>