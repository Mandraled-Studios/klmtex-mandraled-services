<x-admin-layout>
    <x-dashview> 
        <x-slot name="heading">
            Inventory
        </x-slot> 
        <x-slot name="selected7">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            <a href="/dashboard"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <span> Inventory </span>
        </x-slot>
    </x-dashview>
</x-admin-layout>