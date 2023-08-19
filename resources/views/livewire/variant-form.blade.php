<section class="relative pb-12">
    <label for=""> How does the product vary?</label>
    <div class="flex flex-wrap py-3">
        @foreach ($addedVariants as $var)
            <div class="px-2 py-1 rounded bg-gray-700 text-white mr-2 mb-2"> {{$var}} <button wire:click="removeVariant('{{$var}}')" class="text-sm bg-gray-900 px-1 rounded-full"> x </button> </div>
        @endforeach
    </div>
    <div x-data="{open: false}" class="relative w-full">
        <form wire:submit.prevent="variantAdded">
            <input class="w-full" x-on:click="open = true" wire:model="newVariant" type="text" placeholder="Eg. Color, Size, Material" />
        </form>
        <div x-show="open" @click.outside="open=false" class="absolute max-w-xs top-12 left-0 bg-gray-100 z-10 p-3">
            <p class="py-2 border-b border-gray-500"> Type your own or choose an existing option </p>
            @foreach ($variantTypesAvailable as $vt)
                <button wire:click="variantSelected('{{$vt}}')" class="block w-full text-left px-4 py-2 bg-transparent hover:bg-gray-300"> {{$vt}} </button>
            @endforeach
        </div>
    </div>
    <div class="clear-both absolute bottom-0 right-0">
        @if ($changed)
            <button wire:click="addVariantsToProduct" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"> Save & Proceed to Next Step </button>
        @else
            <button wire:click="gotoNextStep" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"> Proceed to Next Step </button>
        @endif
    </div>
    
</section>
