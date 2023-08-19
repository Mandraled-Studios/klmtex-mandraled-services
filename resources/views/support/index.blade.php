<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            Support
        </x-slot>
        <x-slot name="selected11">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            <a href="/dashboard"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <span> Support </span>
        </x-slot>
    </x-dashview>
</x-admin-layout>