<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Payments
        </x-slot>
        <x-slot name="selected9">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            <a href="/dashboard"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <span> Payments </span>
        </x-slot>
    </x-dashview>
</x-admin-layout>