<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Acompanhe as recomendações sobre filmes e séries que você interagiu
    </h2>
  </x-slot>
  <div class="py-2">
    <section class="container mx-auto grid gap-4 grid-cols-3 p-8">
      
      @foreach($posts as $post)

      <div class="w-full h-full">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full">
          <div class="p-4">
            <h2 class="font-bold text-xl mb-2">{{$post->title}}</h2>
            <p class="text-gray-700 text-base truncate mb-3">{{$post->content}}</p>
            <p class="text-green-700 font-bold text-base truncate">Gostaram: {{$post->count_liked}}</p>
            <p class="text-red-700 font-bold text-base truncate">Não gostaram: {{$post->count_unliked}}</p>
            <p class="text-blue-700 font-bold text-base truncate">Seguindo: {{$post->count_followed}}</p>
          </div>
        </div>
      </div>

      @endforeach
    </section>
  </div>
</x-app-layout>