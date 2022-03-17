<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit product') }}
        </h2>
    </x-slot>
    <div class="max-w-screen-sm mx-auto mt-16">
        <form method="POST" action="{{route('products.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}" >
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value=" old('name') ?? $product->name" autofocus />
                @error('name')
                <p class="text-xs text-red-600">{{$message}}</p>
                @enderror
            <x-label for="description" :value="__('Description')" />
            <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value=" old('description') ?? $product->description" autofocus />
                @error('description')
                <p class="text-xs text-red-600">{{$message}}</p>
                @enderror
            <x-label for="price" :value="__('Price')" />
            <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value=" old('price') ?? $product->price" autofocus />
                @error('price')
                <p class="text-xs text-red-600">{{$message}}</p>
                @enderror
            <x-label for="image">Add image</x-label>
            <input name="image" id="image" class="mt-1" type="file">

            <button class="px-2 py-1" type="submit">Submit</button>
        </form>
    </div>
</x-app-layout>
