<x-guest-layout>
    <h1 class="w-12 mx-auto text-2xl mt-8">Ostukorv</h1>
    @if (empty($cart))
        <p>The cart is empty</p>
    @else
    <div class="p-3">
        <div class="overflow-x-auto">
            <table class="table-auto w-screen-lg mx-auto">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Product</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Description</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Price</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Total</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">

                        </th>
                        <th class="p-2 whitespace-nowrap">

                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($cart as $product)
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img src="{{$product['image']}}" class="w-12 h-12 border-md"></div>
                                <div class="font-medium text-gray-800">{{$product['name']}}</div>
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="text-left">{{$product['description']}}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">{{$product['price']}}€</div>
                        </td>

                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">{{$product['price']*$product['quantity']}}€</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-lg text-center">
                                <form action="{{route('update.cart')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product['id']}}">
                                    <input type="number" value="{{$product['quantity']}}" name="quantity" class="w-16 h-8">
                                    <button type="submit" class="bg-blue-500 rounded-full text-white px-4 mx-8">Update cart</button>
                                </form>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <form action="{{route('remove.cart')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$product['id']}}">
                                <button type="submit" class="bg-red-500 rounded-full text-white px-4 bg-opacity-80">Delete item</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <div class="w-72 mx-auto py-6 border-2 p-8 bg-gray-50">
        <input id="card-holder-name" placeholder="Name" type="text" class="my-2">
        <input id="" placeholder="E-mail" type="text" class="my-2">
        <input id="" placeholder="Phone number" type="text" class="my-2">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element"></div>

        <button id="card-button" class="flex w-full bg-blue-700 my-2 rounded-lg text-white cursor-pointer border-dotted border-2">
            <p class="flex justify-center items-center mx-auto">Process Payment</p>
        </button>
    </div>

<!-- Stripe Elements Placeholder -->
<div id="card-element"></div>
</div>
</x-guest-layout>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('pk_test_51KH681BdusJTerzAWwgX5kKm5doTQRFNE9mCa5HL0FDPcCpGMuTsXQf8UdXe2uMAuCPZ9g2ylJZYx4dcjsIMaldi00tFEhNpIt');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');

cardButton.addEventListener('click', async (e) => {
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );

    if (error) {
        // Display "error.message" to the user...
    } else {
        axios.post('/subscribe',{
            payment_method: paymentMethod.id,
        }).then((data)=>{
            stripe.confirmCardPayment(data.data.paymentIntent.client_secret,
            {
                payment_method: {
                    card: cardElement
                }
            })
        });
    }
});
cardElement.mount('#card-element');
</script>
