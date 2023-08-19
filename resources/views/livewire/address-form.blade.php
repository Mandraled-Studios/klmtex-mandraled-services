<form class="w-1/2 px-4" wire:submit.prevent="save">
    <h2 class="text-lg font-bold mb-6"> Company Address </h2>
    @if ($saved)
    <div x-data="{ open: true }">
        <div x-show="open" class="p-3 bg-gray-200 text-gray-900 mb-8 relative">
            <p> Saved! </p>
            <button x-on:click="open=false" class="absolute top-2 right-4"> x </button>
        </div>
    </div>
    @endif

   
    <div class="grid gap-4 grid-cols-2">
        <!-- Door No -->
        <div class="mb-6">
            <x-jet-label for="building_no" value="{{ __('Door No') }}" />
            <x-jet-input id="building_no" type="text" class="mt-1 block w-full" wire:model.defer="address.building_no" />
            <x-jet-input-error for="building_no" class="mt-2" />
        </div>

        <!-- Floor -->
        <div class="mb-6">
            <x-jet-label for="floor" value="{{ __('Floor') }}" />
            <x-jet-input id="floor" type="text" class="mt-1 block w-full" wire:model.defer="address.floor" />
            <x-jet-input-error for="floor" class="mt-2" />
        </div>
    </div>

    <!-- Street -->
    <div class="mb-6">
        <x-jet-label for="street" value="{{ __('Street') }}" />
        <x-jet-input id="street" type="text" class="mt-1 block w-full" wire:model.defer="address.street" />
        <x-jet-input-error for="street" class="mt-2" />
    </div>

    <!-- Area -->
    <div class="mb-6">
        <x-jet-label for="area" value="{{ __('Area') }}" />
        <x-jet-input id="area" type="text" class="mt-1 block w-full" wire:model.defer="address.area" />
        <x-jet-input-error for="area" class="mt-2" />
    </div>

    <!-- Landmark -->
    <div class="mb-6">
        <x-jet-label for="landmark" value="{{ __('Landmark') }}" />
        <x-jet-input id="landmark" type="text" class="mt-1 block w-full" wire:model.defer="address.landmark" />
        <x-jet-input-error for="landmark" class="mt-2" />
    </div>

    <div class="grid gap-4 grid-cols-2">
        <!-- City -->
        <div class="mb-6">
            <x-jet-label for="city" value="{{ __('City') }}" />
            <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="address.city" />
            <x-jet-input-error for="city" class="mt-2" />
        </div>

        <!-- State -->
        <div class="mb-6">
            <x-jet-label for="state" value="{{ __('State') }}" />
            <x-jet-input id="state" type="text" class="mt-1 block w-full" wire:model.defer="address.state" />
            <x-jet-input-error for="state" class="mt-2" />
        </div>
    </div>

    <div class="grid gap-4 grid-cols-2">
        <!-- Country -->
        <div class="mb-6">
            <x-jet-label for="country" value="{{ __('Country') }}" />
            <x-jet-input id="country" type="text" class="mt-1 block w-full" wire:model.defer="address.country" />
            <x-jet-input-error for="country" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="mb-6">
            <x-jet-label for="zipcode" value="{{ __('Postal Code') }}" />
            <x-jet-input id="zipcode" type="text" class="mt-1 block w-full" wire:model.defer="address.zipcode" />
            <x-jet-input-error for="zipcode" class="mt-2" />
        </div>

        <div>
            <x-jet-button wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </div>
    </div>
</form>
