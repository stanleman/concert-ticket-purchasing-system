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
<body class="bg-[#141414] text-white overflow-x-hidden">
    <header class="absolute top-0 w-full py-4 flex justify-between items-center z-20">
        <nav class="navbar flex justify-between items-center w-full">
            @auth
                <a href="/"><img src="/storage/concertmaster.png" alt="Logo" width="200" height="200"></a>
                <div class="relative grid place-items-center" x-data="{open: false}">
                    <div class="flex items-center">
                        <button x-on:click="open = !open" type="button" class="avatar">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                    </div>
                    <div x-show="open" x-on:click.outside="open = false" class="bg-[#4c4c4c] z-50 shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light px-3">
                        @if(auth()->user()->usertype == 'admin')
                            <a href="{{ route('admin.dashboard.index') }}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Dashboard</a>
                            <a href="{{ route('admin.dashboard.create') }}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Create</a>
                        @elseif(auth()->user()->usertype == 'user')
                            <a href="{{ route('user.index') }}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Home</a>
                            <a href="{{ route('my.tickets') }}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Tickets</a>
                            <a href="{{ route('profile.edit') }}" class="block text-center w-full hover:text-gray-300 px-4 py-2 mb-1 mt-2">Profile</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="block text-center w-full font-bold text-red-400 hover:text-red-700 px-4 py-2 mb-2">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
        </nav>
    </header>

    <h1 class="title mt-24">My Tickets</h1>

    <div class="grid grid-cols-4 max-[550px]:grid-cols-2 max-[375px]:grid-cols-1">
        <a href="{{ route('my.tickets', ['sort_field' => 'created_at', 'sort_order' => 'asc']) }}" class="btn btn-primary mx-2 @if ($sortField == 'created_at' && $sortOrder == 'asc') bg-indigo-700 hover:bg-indigo-900 text-white @endif">Sort by Earliest</a>
        <a href="{{ route('my.tickets', ['sort_field' => 'created_at', 'sort_order' => 'desc']) }}" class="btn btn-primary mx-2 @if ($sortField == 'created_at' && $sortOrder == 'desc') bg-indigo-700 hover:bg-indigo-900 text-white @endif">Sort by Latest</a>
        <a href="{{ route('my.tickets', ['sort_field' => 'total_price', 'sort_order' => 'asc']) }}" class="btn btn-primary mx-2 @if ($sortField == 'total_price' && $sortOrder == 'asc') bg-indigo-700 hover:bg-indigo-900 text-white @endif">Sort by Lowest Price</a>
        <a href="{{ route('my.tickets', ['sort_field' => 'total_price', 'sort_order' => 'desc']) }}" class="btn btn-primary mx-2 @if ($sortField == 'total_price' && $sortOrder == 'desc') bg-indigo-700 hover:bg-indigo-900 text-white @endif">Sort by Highest Price</a>
    </div>
    </div>

    <div class="mt-3 grid grid-cols-3 max-[730px]:grid-cols-2 max-[500px]:grid-cols-1">
        @if ($tickets->isEmpty())
            <p class="text-center w-screen">No tickets purchased as of now.</p>
        @else
            @foreach ($tickets as $ticket)
                <div class="flex flex-col cool-form p-5 m-2 !rounded-lg hover:border-neutral-400 hover:duration-200 duration-200 hover:scale-[1.02]">
                    <p><span class="font-bold">Concert:</span> {{ $ticket->concert->name }}</p>
                    <p><span class="font-bold">Seat:</span> {{ $ticket->seat->seat }}</p>
                    <p><span class="font-bold">Quantity:</span> {{ $ticket->quantity }}</p>
                    <p><span class="font-bold">Date purchased:</span> {{ $ticket->purchased_date }}</p>
                    <p><span class="font-bold">Total:</span> MYR {{ $ticket->total_price }}</p>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
