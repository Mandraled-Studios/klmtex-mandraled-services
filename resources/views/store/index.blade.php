<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Store Setup
        </x-slot>
        <x-slot name="selected2">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            <a href="/dashboard"> &lt; Go back </a>
        </x-slot>
        <x-slot name="breadcrumb">
            <span> Setup Store </span>
        </x-slot>

        @if (session()->has('success'))
            <div class="p-3 bg-green-200 text-green-700 mb-6">
                {{ session()->get('success') }}
            </div>
        @elseif (session()->has('danger'))
            <div class="p-3 bg-red-200 text-red-700 mb-6">
                {{ session()->get('danger') }}
            </div>
        @endif

        @livewire('store-manager')
    </x-dashview>
</x-admin-layout>