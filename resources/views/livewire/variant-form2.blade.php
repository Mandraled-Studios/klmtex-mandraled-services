<div>
    
    <div class="border relative">
        <form  action="/products/{{$product->id}}/variants" method="POST">
            @csrf
            <div id="product-variant-container">
                <div class = "product-variant mb-5">
                    <div class="flex">
                        <div class="w-1/2 p-3">
                            <label class="block mb-2"> How does the product vary? </label>
                            <div class="relative">
                                <input readonly class="triggerDropDown w-full p-2 block hover:bg-gray-100 cursor-pointer h-12" placeholder = "Choose an option" />
                                <div class="dropOption hidden rounded bg-white shadow-md my-2 absolute top-12 left-0 w-full z-10">
                                    <ul class="list-reset cursor-pointer">
                                        <li class="p-2 block text-black hover:bg-gray-200"> Size </li>
                                        <li class="p-2 block text-black hover:bg-gray-200"> Color </li>
                                        <li class="p-2 block text-black hover:bg-gray-200"> Material </li>
                                        <li class="p-2"><input type = "text" placeholder = "Or type your own" class="variantType border-2 rounded h-8 w-full"><br></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="w-1/2 p-3" placeholder = "Comma separated values">
                            <label class="block mb-2"> Values </label>
                            <div class="w-full">
                                <input id="tags" type="text" class="w-full p-2 block hover:bg-gray-200" data-role="tagsinput">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type = "button" id = "addVariant" class = "px-4 py-2 bg-green-500 text-white hover:bg-green-600 mt-5 mr-3"> + Add another variant type </button>
            
            <div class="flex justify-between pt-6">
                <div class="flex justify-between">
                    <a href = "/products/{{$product->id}}/edit" class = "px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 mr-3"> Go Back To Previous Step </a>
                    <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-gray-700 bg-amber-300 hover:bg-amber-400" value="Save & Quit">
                </div>
                <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Save & Proceed to Next Step">
            </div>
        </form>
    </div>
    {{-- 
    <div class="border relative">
        <form  action="/products/{{$product->id}}/variants" method="POST">
            @csrf
            <div id="product-variant-container">
                <div class = "product-variant mb-5">
                    <label class="block mb-2"> How does the product vary? </label>
                    <input readonly class="triggerDropDown w-full p-2 block hover:bg-gray-100 cursor-pointer mb-4" placeholder = "Choose an option" />

                    <div class="hidden variableValue" placeholder = "Comma separated values">
                        <label class="block mb-2"> Values </label>
                        <div>
                            <select class = "w-full p-2 block" multiple data-role="tagsinput">
                              <option value="Amsterdam">Amsterdam</option>
                              <option value="Washington">Washington</option>
                              <option value="Sydney">Sydney</option>
                              <option value="Beijing">Beijing</option>
                              <option value="Cairo">Cairo</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="dropOption hidden rounded bg-white shadow-md my-2 absolute top-8 left-0 w-full z-10">
                        <ul class="list-reset cursor-pointer">
                            <li class="p-2 block text-black hover:bg-gray-200"> Size </li>
                            <li class="p-2 block text-black hover:bg-gray-200"> Color </li>
                            <li class="p-2 block text-black hover:bg-gray-200"> Material </li>
                            <li class="p-2"><input type = "text" placeholder = "Or type your own" class="variantType border-2 rounded h-8 w-full"><br></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <button type = "button" id = "addVariant" class = "px-4 py-2 bg-green-500 text-white hover:bg-green-600 mt-5 mr-3"> + Add another variant type </button>
            
            <div class="flex justify-between pt-6">
                <div class="flex justify-between">
                    <a href = "/products/{{$product->id}}/edit" class = "px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 mr-3"> Go Back To Previous Step </a>
                    <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-gray-700 bg-amber-300 hover:bg-amber-400" value="Save & Quit">
                </div>
                <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Save & Proceed to Next Step">
            </div>
        </form>
    </div>
    
    <form action="/products/{{$product->id}}/variants" method="POST">
        @csrf
        <div class="max-w-sm mb-6">
            <p class = "mb-2"> Choose the product attribute that varies </p>
            <div class="flex flex-wrap mr-8">
                <div class="border relative">
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
                <button type = "button" class = "add_variant px-4 py-2 bg-blue-500 text-white hover:bg-blue-500 mb-4"> + Add variation </button>
            </div>
        </div>
        
        <div class="flex justify-between">
            <div class="flex justify-between">
                <a href = "/products/{{$product->id}}/edit" class = "px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 mr-3"> Go Back To Previous Step </a>
                <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-gray-700 bg-amber-300 hover:bg-amber-400" value="Save & Quit">
            </div>
            <input type="submit" name = "submit" class = "px-4 py-2 cursor-pointer text-white bg-blue-400 hover:bg-blue-500" value="Save & Proceed to Next Step">
        </div>
    </form>
    --}}
</div>
