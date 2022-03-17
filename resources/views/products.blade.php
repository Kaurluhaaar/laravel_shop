<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 items-center">
                {{__('Products') }}
            </h2>
            <a class="rounded font-bold px-3 py-3 bg-gray-800 text-white" href="{{route('products.add')}}">Add new product</a>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto flex flex-col justify-between bg-gray-50 px-4 rounded-lg my-3">
        <div class="flex my-8 justify-between items-center lg:grid lg:grid-cols-6">
            <span class="flex justify-center">Products</span><span class="flex justify-center">Name</span><span class="flex justify-center">Description</span><span class="flex justify-center">Price</span><span class="flex justify-center">Edit</span><span class="flex justify-center">Delete</span>
        </div>
        @foreach ($products as $product)
            <div class="flex justify-between my-8 items-center lg:grid lg:grid-cols-6">
                <img src="{{ $product->image }}" alt="image" class="flex justify-center w-40 h-40 object-contain">
                <div class=" flex justify-center"><td>{{ $product->name }}</td></div>
                <div class=" flex justify-center"><td>{{ $product->description }}</td></div>
                <div class=" flex justify-center rounded-lg bg-green-200 mx-2 px-4"><td>{{ $product->price }}€</td></div>
                <a href="{{ route('products.edit', $product->id) }}" class="flex justify-center rounded-lg bg-gray-700 text-white  mx-2 px-4"><td>Edit</td></a>
                <div class="flex justify-center">
                    <form action="{{route('products.destroy')}}" method="post" class="flex justify-center">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <button type="submit" class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
