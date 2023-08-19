<x-admin-layout>
    <x-dashview>  
        <x-slot name="heading">
            My Dashboard
        </x-slot>
        <x-slot name="selected1">
            {{__("bg-blue-400 text-white")}}
        </x-slot>
        <x-slot name="goback">
            <a class = "text-gray-400" href="#"> &lt; Go back </a>
        </x-slot>

        <x-slot name="breadcrumb">
            <span> My Dashboard </span>
        </x-slot>
    </x-dashview>
</x-admin-layout>
