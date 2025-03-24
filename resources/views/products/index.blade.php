<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Product Display</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6">Live Product List</h1>

        <div class="text-center mb-4">
            <a href="{{ route('products.fetch') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Fetch Products
            </a>
        </div>

        <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600 mt-2">{{ Str::limit($product->description, 80) }}</p>
                    <p class="text-blue-600 font-bold mt-3">${{ $product->price }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            encrypted: true
        });

        var channel = pusher.subscribe('products');
        channel.bind('product.updated', function(data) {
            let productHTML = `
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <h2 class="text-lg font-semibold">${data.product.name}</h2>
                    <p class="text-gray-600 mt-2">${data.product.description.substring(0, 80)}...</p>
                    <p class="text-blue-600 font-bold mt-3">$${data.product.price}</p>
                </div>
            `;
            $("#product-list").prepend(productHTML);
        });
    </script>

</body>
</html>