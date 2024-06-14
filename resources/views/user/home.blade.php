<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/f623712ea0.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])
</head>
<body class="bg-[#141414] text-white">

    <header class="absolute top-0 w-full py-4 flex justify-between items-center z-20">
        <nav class="navbar flex justify-between items-center w-full">
            
          @auth
              <a href="/"><img src="/storage/concertmaster.png" alt="Logo" width="200" height="200"></a>
              <div class="relative grid place-items-center" x-data="{open: false}">
                  <div class="flex items-center">
                      
                      {{-- dropdown --}}
                      <button x-on:click="open = !open" type="button" class="avatar">
                          <i class="fa-solid fa-bars"></i>
                      </button>
                  </div>

                  {{-- dropdown menu --}}
                  <div x-show="open" x-on:click.outside="open = false" class="bg-[#4c4c4c] z-50 shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light px-3">
                      
                      @if(auth()->user()->usertype == 'admin')
                          <a href="{{route('admin.dashboard.index')}}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Dashboard</a>
                          <a href="{{route('admin.dashboard.create')}}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Create</a>
                      @elseif(auth()->user()->usertype == 'user')
                          <a href="{{route('user.index')}}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Home</a>
                          <a href="{{route('my.tickets')}}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Tickets</a>
                          <a href="{{route('profile.edit')}}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Profile</a>
                      @endif

                      <form action="{{route('logout')}}" method="POST">
                          @csrf
                          <button class="block text-center w-full font-bold text-red-400 hover:text-red-700 px-4 py-2 mb-2">Logout</button>
                      </form>
                  </div>
              </div>
          @endauth
      </nav>
    </header>

    <h1 class="title mt-24">Browse featured concerts</h1>

    <div class="grid grid-cols-3 max-[930px]:grid-cols-2 max-[600px]:grid-cols-1 max-[1010px]:px-4 max-[1125px]:px-12 px-28">
        @foreach ($concerts as $concert)
            <div class="rounded-xl cool-form m-3">
                <div class="flex items-center gap-3 p-4">
                    <p class="w-full text-center font-bold">{{ $concert->name }}</p>
                </div>

                <img src="{{ $concert->image }}" alt="" class="w-full h-40 object-cover object-top">

                <div class="flex items-center gap-3 px-4 py-2 pt-4">
                    <i class="fa-solid fa-calendar-days"></i>
                    <p>{{ $concert->date }}</p>
                </div>

                <div class="flex items-center gap-3 px-4 py-2">
                    <i class="fa-solid fa-clock"></i>
                    <p>{{ $concert->time }}</p>
                </div>

                <div class="flex items-center gap-3 px-4 py-2">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>{{ $concert->venue->name}}</p>
                </div>

                <div class="w-full p-3">
                    <a href="{{route('concerts.show', $concert->id)}}"><button class="w-full mt-3 py-2 bg-indigo-600 hover:bg-indigo-900 rounded-lg">Learn More</button></a>
                </div>

            </div>
        @endforeach
    </div>
</body>
</html>