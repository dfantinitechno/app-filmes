<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      De sua opinião ou acompanhe as recomendações sobre filmes e séries
    </h2>
  </x-slot>
  <div class="py-2">

    <div class="container mx-auto grid gap-4 grid-cols-3 p-8">

      @foreach($posts as $post)

      <div class="w-full h-full">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full">
          <div class="p-4">
            <h2 class="font-bold text-xl mb-2">{{$post->title}}</h2>
            <p class="text-gray-700 text-base truncate mb-2">{{$post->content}}</p>
            <p class="text-gray-700 text-base truncate mb-2">Criador: {{$post->name}}</p>
            <p class="text-gray-700 text-base truncate">Data: {{date('d/m/Y H:i', strtotime($post->created_at))}}</p>

            @if($post->finished_at)

            <div class="mt-8 flex justify-center">
              Post Finalizado, não é mais possível interagir.
            </div>

            @else

            <div class="mt-4 flex justify-center">
              <form method="POST" action="{{ route('new_vote', $post->id) }}">
                @csrf
                <button class="bg-green-500 hover:bg-green-700 text-sm text-white font-bold h-7 px-4 rounded mr-2" name="type" value="1">Gostei</button>
                <button class="bg-red-500 hover:bg-red-700 text-sm text-white font-bold h-7 px-4 rounded mr-2" name="type" value="2">Não gostei</button>
                <button class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold h-7 px-4 rounded mr-2" name="type" value="3">Seguir</button>
              </form>
            </div>

            <div class="mt-4 flex justify-center">
              <form method="POST" action="{{ route('delete', $post->id) }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-700 text-sm text-white font-bold h-7 px-4 rounded mr-2">Excluir</button>
              </form>
              <form method="POST" action="{{ route('finish', $post->id) }}">
                @csrf
                @method('PUT')
                <button class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold h-7 px-4 rounded mr-2">Finalizar</button>
              </form>
            </div>

            @endif

          </div>
        </div>
      </div>

      @endforeach

    </div>
  </div>
</x-app-layout>