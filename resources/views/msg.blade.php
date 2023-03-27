<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ $mensagem }}
        </h2>

        <a class="bg-green-500 hover:bg-green-700 text-sm text-white font-bold h-7 px-4 pw-4 rounded mr-2" name="type" value="1" href="{{ route('feed') }}">voltar</a>
    </x-slot>
</x-app-layout>