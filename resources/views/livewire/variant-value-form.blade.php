
<section>
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            @foreach ($addedVariants as $var)
            <div class="multi-wizard-step">
                <a href="#step-{{$loop->iteration}}" type="button"
                    class="btn {{ $currentStep != $loop->iteration ? 'ms-wizard-btn-default' : 'ms-wizard-btn-active' }}"> {{$loop->iteration}} </a>
                <p> Add {{$var['name']}}(s) </p>
            </div>
            @endforeach
        </div>
    </div>

    @foreach ($addedVariants as $var)
    <div class="row setup-content {{ $currentStep != $loop->iteration ? 'display-none' : '' }}">
        <div class="p-8">
            <label class="block font-semibold text-gray-600 mb-4" for=""> What are the available <span class="inline-block px-4 py-1 rounded-full font-bold text-black border border-gray-600"> {{$var['name']}}(s) </span> </label>
            
            <div class="flex flex-wrap py-3">
                @foreach ($addedVariantValues as $varVal)
                    @if ($var['name'] == $varVal['type'])
                        <div class="px-2 py-1 rounded bg-gray-700 text-white mr-2 mb-2"> 
                            {{$varVal['value']}} 
                            <button class="text-sm bg-gray-900 px-1 rounded-full" wire:click="removeVariantValue('{{$varVal['value']}}')"> x </button> 
                        </div>
                    @endif
                @endforeach
            </div>

            <div x-data="{open: false}" class="relative w-full">
                <form wire:submit.prevent="variantValueAdded">
                    <input wire:model="variantTypeHidden" type="hidden" value="{{$var['name']}}" />
                    <input class="w-full" x-on:click="open = true" wire:model.lazy="newVariantValue" type="text" placeholder="Start typing" />
                </form>
            </div>
            
            <div class="flex justify-between py-4">
                @if (!$loop->first)
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" type="button" wire:click="backToPreviousStep">Back to Previous Step</button>
                    <div class="empty"></div>
                @endif
                @if (!$loop->last)
                    <div class="empty"></div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" wire:click="proceedToNextStep"
                    type="button"> Next Step </button>
                @endif 
                @if($loop->last)
                    <div class="empty"></div>
                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" wire:click="finishVariantAddition" type="button">Finish!</button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</section>

