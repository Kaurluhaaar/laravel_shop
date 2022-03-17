<x-guest-layout>
    <div class="bg-gray-100 dark:bg-gray-900">
                @if (Route::has('login'))
                    <div class="flex justify-between mx-10 top-5 right-0 px-6 py-4 lg:mx-20">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                        <a href="{{route('cart')}}">View cart {{count($cart)}}</a>
                    </div>

                @endif
            <div class="flex flex-col lg:grid lg:grid-cols-4 bg-white">
                @foreach ($products as $product)
                <form method="POST" action="{{ route('addcart') }}" class="btn btn-primary btn-block">
                    @csrf
                    <input name="id" type="hidden" value="{{$product->id}}">
                <div class="mx-10 my-4 p-4 rounded bg-pink-300 text-white shadow-lg">
                    <div class="h-56">
                        <img src="{{ $product->image }}" alt="image" class="object-fill h-full w-full">
                    </div>
                    <div class="flex py-3 justify-center">
                        <p class="text-2xl font-bold">{{ $product->name }}</p>

                    </div>

                    <div class="flex justify-between">
                        <div class="text-white-400 m-4">{{ $product->description }}</div>
                        <span class=" rounded-lg bg-red-600 h-8 text-white p-1 m-4 ">{{ $product->price }} €</span>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">

                            <button class="text-white rounded-lg bg-red-600 p-1 my-2" type="submit">Add to cart</button>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>
    </x-guest-layout>
