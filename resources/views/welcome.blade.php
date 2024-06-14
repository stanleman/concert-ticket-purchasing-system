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
    <div class="relative w-full h-screen">
        <video
            src="/storage/guitar.mp4"
            class="absolute top-0 left-0 w-full h-full object-cover -z-10"
            autoplay
            muted
            loop
        ></video>
    
        <header class="absolute top-0 w-full px-8 py-4 flex justify-between items-center z-20">
            <div class="flex items-center">
                <img src="/storage/concertmaster.png" alt="Logo" width="200" height="200">
            </div>
        </header>

        <div class="absolute inset-0 flex items-center justify-center z-10">
            @if (Route::has('login'))
                @auth
                    <div>
                        <h1 class="text-6xl max-[675px]:text-4xl max-[415px]:text-2xl font-bold">Welcome back, {{auth()->user()->name}}!</h1>
                        <div class="flex justify-center items-center">
                            @if (auth()->user()->usertype === 'admin')
                                <a
                                    href="{{ route('admin.dashboard.index') }}"
                                    class="rounded-md px-8 py-2 primary-btn ml-1 bg-transparent flex justify-center items-center text-lg"
                                >
                                    Go back to dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('user.index') }}"
                                    class="rounded-md px-8 py-2 primary-btn ml-1 bg-transparent flex justify-center items-center text-lg"
                                >
                                    Get back to browsing
                                </a>
                                
                            @endif
                        </div>
                        
                    </div>
                
                @else
                    <div>
                        <h1 class="text-6xl max-[650px]:text-4xl max-[520px]:text-center font-bold">Hey there! We're so excited to have you!</h1>
                        <div class="flex max-[520px]:flex-col justify-start items-center">
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-8 py-2 primary-btn ml-1 bg-transparent flex justify-center items-center text-lg"
                            >
                                Get Started
                            </a>
                            <p>or if you are already a user,</p>
                            <a
                            href="{{ route('login') }}"
                            class="ml-2 text-indigo-400 hover:text-indigo-700 font-bold"
                        >
                            log in here
                        </a>
                        </div>
                        
                    </div>
                @endif
            @endauth    
        </div>
    </div>


</body>
</html>
