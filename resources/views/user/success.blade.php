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
    <div class="flex w-full min-h-screen max-[740px]:flex-col">
        <div class="w-[70%] max-[740px]:w-full max-h-screen px-4 py-8 flex justify-center items-center">
            <div class=" flex flex-col text-center items-center gap-2 py-8 px-[50px] ">
                <i class="fa-solid fa-circle-check text-indigo-500 text-[50px]"></i>
                <h1 class="text-3xl font-bold text-indigo-500">Order Success</h1>
                <p>Thank you, {{ $user->name }}! Your order has been placed successfully.</p>
                <a href="{{ route('user.index') }}" class="primary-btn w-full">Return to Home</a>
            </div>
        </div>
    
        <div class="w-[30%] max-[740px]:w-full px-6 py-8 cool-form !rounded-none flex flex-col">
            <h2 class="text-2xl font-semibold mb-2 text-indigo-500">Concert Details</h2>
            <p><strong>Concert Name:</strong> {{ $concert->name }}</p>
            <p><strong>Date:</strong> {{ $concert->date }}</p>
            <p><strong>Time:</strong> {{ $concert->time }}</p>
            <p><strong>Venue:</strong> {{ $concert->venue->name }}</p>
            
            <h2 class="text-2xl font-semibold mt-4 mb-2 text-indigo-500">Order Details</h2>
            <ul class="mb-4">
                @foreach ($orderDetails as $orderDetail)
                    <li class="mb-3">
                        <p><strong>Seat:</strong> {{ $orderDetail['seat'] }}</p>
                        <p><strong>Price:</strong> MYR {{ $orderDetail['price'] }}</p>
                        <p><strong>Quantity:</strong> {{ $orderDetail['quantity'] }}</p>
                        <p><strong>Total Price:</strong> MYR {{ $orderDetail['total_price'] }}</p>
                    </li>
                @endforeach
            </ul>
            
            <h2 class="text-2xl font-semibold mb-2 text-indigo-500">Total Price</h2>
            <p>MYR {{ $totalPrice }}</p>
        </div>
    </div>

    
</body>
</html>