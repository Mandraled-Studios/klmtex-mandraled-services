<div class="py-12 sm:px-6 lg:px-8 bg-white shadow-xl sm:rounded-lg">
    <form class="mb-12" enctype="multipart/form-data" wire:submit.prevent="save">
        <h2 class="text-lg font-bold mb-6"> Company Details </h2>
        @if ($saved)
        <div x-data="{ open: true }">
            <div x-show="open" class="p-3 bg-gray-200 text-gray-900 mb-8 relative">
                <p> Saved! </p>
                <button x-on:click="open=false" class="absolute top-2 right-4"> x </button>
            </div>
        </div>
        @endif
    
        <div class="flex w-full">
        <!-- Company Name -->
            <div class="sm:w-1/2 xl:w-5/12 px-4 mb-6">
                <x-jet-label for="company_name" value="{{ __('Company Name') }}" />
                <x-jet-input id="company_name" type="text" class="mt-1 block w-full" wire:model.defer="company.company_name" />
                @error('company_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('company.company_name')
                    <x-jet-input-error for="company_name" class="mt-2" :message="$errors->first('company.company_name')" />
                @enderror
            </div>

            <!-- GSTIN -->
            <div class="sm:w-1/2 xl:w-5/12 px-4 mb-6">
                <x-jet-label for="gstin" value="{{ __('GSTIN') }}" />
                <x-jet-input id="gstin" type="text" class="mt-1 block w-full" wire:model.defer="company.gstin" />
                <x-jet-input-error for="gstin" class="mt-2" />
            </div>
        </div>

        <!-- Company Logo -->
        <div class="flex w-full">
            <div class="sm:w-1/2 xl:w-5/12 px-4 mb-6">
                <x-jet-label for="logo" value="{{ __('Company Logo') }}" />
                
                <table class="w-1/2 max-w-sm">
                    <tr>
                        <td class="w-1/2">
                            <img src="{{$company->logo}}" class="h-14" alt="">
                            <label class="block font-medium text-sm text-gray-700"> {{ __('Current Logo') }} </label>
                        </td>
                        @if ($logo)
                        <td class="w-1/2">
                            <img src="{{ $logo->temporaryUrl() }}">
                            <label class="block font-medium text-sm text-gray-700">{{ __('Chosen Logo') }}</label>
                        </td>
                        @endif
                    </tr>
                </table>
                <input id="logo" type="file" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="logo" />
                @error('logo') <x-jet-input-error for="logo" class="mt-2">{{ $message }}</x-jet-input-error> @enderror
            </div>
        
            <!-- Website -->
            <div class="sm:w-1/2 xl:w-5/12 px-4 mb-6">
                <x-jet-label for="website" value="{{ __('Website') }}" />
                <x-jet-input id="website" type="text" class="mt-1 block w-full" wire:model.defer="company.website" />
                <x-jet-input-error for="website" class="mt-2" />
            </div>
        </div>
    
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="company.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    
        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4 mb-12">
            <x-jet-label for="phone" value="{{ __('Phone') }}" />
            <x-jet-input id="phone" type="tel" class="mt-1 block w-full" wire:model.defer="company.phone" />
            <x-jet-input-error for="phone" class="mt-2" />
        </div>

        <h2 class="text-lg font-bold mb-6"> Social Media Links </h2>

        <!-- Social -->
        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="facebook" value="{{ __('Facebook') }}" />
            <x-jet-input type="text" id="facebook" class="mt-1 block w-full" wire:model.defer="company.facebook" />
            <x-jet-input-error for="facebook" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="twitter" value="{{ __('Twitter') }}" />
            <x-jet-input type="text" id="twitter" class="mt-1 block w-full" wire:model.defer="company.twitter" />
            <x-jet-input-error for="twitter" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="instagram" value="{{ __('Instagram') }}" />
            <x-jet-input type="text" id="instagram" class="mt-1 block w-full" wire:model.defer="company.instagram" />
            <x-jet-input-error for="instagram" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="linkedin" value="{{ __('LinkedIn') }}" />
            <x-jet-input type="text" id="linkedin" class="mt-1 block w-full" wire:model.defer="company.linkedin" />
            <x-jet-input-error for="linkedin" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="youtube" value="{{ __('YouTube') }}" />
            <x-jet-input type="text" id="youtube" class="mt-1 block w-full" wire:model.defer="company.youtube" />
            <x-jet-input-error for="youtube" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="whatsapp" value="{{ __('WhatsApp') }}" />
            <x-jet-input type="text" id="whatsapp" class="mt-1 block w-full" wire:model.defer="company.whatsapp" />
            <x-jet-input-error for="whatsapp" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="social1" value="{{ __('Other Social Media Name') }}" />
            <x-jet-input type="text" id="social1" class="mt-1 block w-full mb-6" wire:model.defer="company.social1" placeholder="Example: Pinterest" />
            <x-jet-label for="social1_url" value="{{ __('Other Social Media URL') }}" />
            <x-jet-input type="text" id="social1_url" class="mt-1 block w-full" wire:model.defer="company.social1_url" />
            <table class="w-1/2 max-w-sm">
                <tr>
                    @if ($company->social1_icon)
                    <td class="w-1/2">
                        <img src="{{$company->social1_icon}}" class="h-14" alt="">
                        <label class="block font-medium text-sm text-gray-700"> {{ __('Current Icon') }} </label>
                    </td>
                    @endif
                    @if ($social1_icon)
                    <td class="w-1/2">
                        <img src="{{ $social1_icon->temporaryUrl() }}">
                        <label class="block font-medium text-sm text-gray-700">{{ __('Chosen Icon') }}</label>
                    </td>
                    @endif
                </tr>
            </table>
            <x-jet-input-error for="social1" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="social2" value="{{ __('Any Other Social Media Name') }}" />
            <x-jet-input type="text" id="social2" class="mt-1 block w-full mb-6" wire:model.defer="company.social2" placeholder="Example: Pinterest" />
            <x-jet-label for="social2_url" value="{{ __('Other Social Media URL') }}" />
            <x-jet-input type="text" id="social2_url" class="mt-1 block w-full" wire:model.defer="company.social2_url" />
            <table class="w-1/2 max-w-sm">
                <tr>
                    @if ($company->social2_icon)
                    <td class="w-1/2">
                        <img src="{{$company->social2_icon}}" class="h-14" alt="">
                        <label class="block font-medium text-sm text-gray-700"> {{ __('Current Icon') }} </label>
                    </td>
                    @endif
                    @if ($social2_icon)
                    <td class="w-1/2">
                        <img src="{{ $social2_icon->temporaryUrl() }}">
                        <label class="block font-medium text-sm text-gray-700">{{ __('Chosen Icon') }}</label>
                    </td>
                    @endif
                </tr>
            </table>
            <x-jet-input-error for="social1" class="mt-2" />
        </div>
    
        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </form>

    @livewire('address-form')
</div>
