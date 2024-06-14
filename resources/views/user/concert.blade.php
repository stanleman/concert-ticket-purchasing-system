<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/f623712ea0.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css', 'resources/js/script.js' ])
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

    <h1 class="title text-left mt-24 ml-4 mb-8 !text-white">{{$concert->name}}</h1>

    <div class="flex justify-center w-full">
        
        <div class="w-[80%] max-[1100px]:w-full px-8 sm:px-0 flex ">
            <div class="w-full">
              <div 
                role="tablist"
                aria-label="tabs"
                class="relative w-full h-[44px] grid grid-cols-3 items-center text-white overflow-hidden transition"
              >
                <div class="absolute indicator h-11 top-0 bottom-0 left-0  bg-indigo-600 border-b-[5px] border-indigo-600 w-full "></div>
                <button
                  role="tab"
                  aria-selected="true"
                  aria-controls="panel-1"
                  id="tab-1"
                  tabindex="0"
                  class="relative block h-11 px-6 tab w-full"
                >
                  <span class="text-white">
                    <i class="fa-solid fa-ticket mr-1"></i>
                    Ticket
                  </span>
                </button>
                <button
                  role="tab"
                  aria-selected="false"
                  aria-controls="panel-2"
                  id="tab-2"
                  tabindex="-1"
                  class="relative block h-11 px-6 tab w-full"
                >
                  <span class="text-white">
                    <i class="fa-solid fa-circle-info mr-1"></i>
                    Details
                  </span>
                </button>
                <button
                  role="tab"
                  aria-selected="false"
                  aria-controls="panel-3"
                  id="tab-3"
                  tabindex="-1"
                  class="relative block h-11 px-6 tab rounded-full w-full"
                >
                  <span class="text-white">
                    <i class="fa-solid fa-user-tie mr-1"></i>
                    Organiser
                  </span>
                </button>
              </div>
              <div class="relative bg-transparent ">
                <div
                  role="tabpanel"
                  id="panel-1"
                  class="tab-panel py-6 transition duration-300"
                >
                  <div class="flex max-[860px]:flex-col max-[860px]:items-center max-[1100px]:px-3 mb-4">
                    <img src="{{$concert->venue->image}}" alt="" class="w-[600px] h-[350px] object-fill">
                    <div class="cool-form ml-3 max-[860px]:ml-0 max-[860px]:mt-3 w-full !rounded-2xl p-5 flex flex-col justify-center text-xl max-[1176px]:text-base max-[900px]:text-sm">
                        <h1 class="text-3xl max-[900px]:text-2xl font-bold text-indigo-500 mb-4">Concert Information</h1>

                        <div class="flex items-center mb-3 font-bold">
                            <i class="fa-solid fa-calendar-days mr-3"></i>
                            {{$concert->date}} , {{$concert->time}}
                        </div> 

                        <div class="flex flex-col max-[1176px]:flex-row max-[1176px]:items-center">
                            <div class="flex items-center mb-3 max-[1176px]:mb-4">
                                <i class="fa-solid fa-user mr-3"></i>
                                {{$concert->artist}}
                            </div>
    
                            <div class="flex items-center mb-4 max-[1176px]:ml-4">
                                <i class="fa-solid fa-tags mr-3"></i>
                                {{$concert->genre}}
                            </div>
                        </div>

                        <div class="flex">
                            <i class="fa-solid fa-location-dot mr-3"></i>
                            {{$concert->venue->name}}
                            <br>
                            {{$concert->venue->address}}
                        </div>
                    </div>
                  </div>

                  <div class="w-full flex justify-center">
                    <div class="w-[60%] max-[860px]:w-full max-[860px]:px-3">
                        @php
                            $sections = $concert->venue->seats->pluck('section')->unique();
                        @endphp
                
                        <div id="section-buttons" class="flex flex-wrap">
                            @foreach ($sections as $index => $section)
                                @if ($section)
                                    <button class="section-button primary-btn border-gray-900 hover:bg-indigo-950  mx-2 my-2 @if ($index === 0) selected @endif" data-section="{{ $section }}" @if ($index === 0) data-default="true" @endif>{{ $section }}</button>
                                @endif
                            @endforeach
                        </div>
                
                        <form id="purchase-form" method="POST" action="{{ route('order.store') }}" onsubmit="validateForm(event)">
                            @csrf
                            <input type="hidden" name="concert_id" value="{{ $concert->id }}">
                            <ul id="seat-list">
                                @foreach ($concert->venue->seats as $seat)
                                    <li class="seat-item w-full border border-neutral-700  px-4 py-6 my-2" data-section="{{ $seat->section }}">
                                        <div class="flex w-full justify-between items-center">
                                            <div>
                                                <p class="font-bold text-2xl">{{ $seat->seat }}</p>
                                                <p class="">MYR {{ $seat->price }}</p>
                                            </div>
                                            <div>
                                                @if ($seat->quantity == 0)
                                                  <p class="text-red-700 mt-1 text-lg font-bold">Sold out</p>
                                                @else
                                                  <label for="quantity_{{ $seat->id }}">Quantity:</label>
                                                  <select name="seats[{{ $seat->id }}]" id="quantity_{{ $seat->id }}">
                                                      <option value="0">0</option>
                                                      @php
                                                          $maxQuantity = $seat->quantity > 10 ? 10 : $seat->quantity;
                                                      @endphp
                                                      @for ($i = 1; $i <= $maxQuantity; $i++)
                                                          <option value="{{ $i }}">{{ $i }}</option>
                                                      @endfor
                                                  </select>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="w-full flex justify-center">
                              <button type="submit" class="bg-indigo-600 hover:bg-indigo-900 text-white px-4 py-2 rounded-lg mt-4">Purchase tickets</button>
                            </div>
                        </form>
                        
                        @if ($errors->any())
                            <div class="text-red-700 my-4 relative w-full text-center" role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ $errors->first('seats') }}</span>
                            </div>
                        @endif
                    </div>
                </div>


                </div>
    
                <div
                  role="tabpanel"
                  id="panel-2"
                  class="absolute top-0 invisible opacity-0 tab-panel p-6 transition duration-300"
                >
                  <div class="flex flex-col items-center w-full">
                    <h1 class="text-3xl text-center font-semibold">Concert description</h1>
                    <div class="cool-form px-8 py-6 mt-4 w-[80%] max-[800px]:w-full">
                      <p class="text-white text-lg max-[640px]:text-base max-[450px]:text-sm text-center">{{$concert->description}}</p>
                    </div>
                  </div>

                </div>
    
                <div
                  role="tabpanel"
                  id="panel-3"
                  class="absolute top-0 invisible opacity-0 tab-panel p-6 transition duration-300"
                >
                  <div class="flex flex-col items-center w-full">
                    <div class="w-full flex flex-col items-center">
                      <h2 class="text-sm font-semibold text-neutral-400">Organiser</h2>
                      <h1 class="text-3xl">{{$concert->organiser->name}}</h1>
                    </div>
                    <div class="cool-form px-8 py-6 mt-4 w-[80%]">
                      <p class="text-white text-lg text-center">{{$concert->organiser->description}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    
</body>
</html>