<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="product">
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="Product Image">
            @endif
            <label>Uploaded Time: {{ $product->created_at }}</label>
            <label>Seller: {{ $product->user->username }}</label>
            <label>Product Name: {{ $product->name }}</label>
            <label>Price: ${{ $product->price }}</label>
            <label>Description: {{ $product->description }}</label>
            <label>Quantity: {{ $product->quantity }}</label>
        </div>
        <div class="product-button">
            <form action="{{ route('add.to.cart', ['id' => $product->id]) }}" method="post">
                @csrf
                <label class="inline-label-input">Amount:</label>
                <input type="number" id="amount" name="amount" value="1" min="1" max="{{ $product->quantity }}">

                <div>
                    <button type="submit">Add to Cart</button>
                </div>
                
            </form>
            <a href="{{ route('browse') }}"><button class="back-button">Back</button></a>
        </div>
    </div>
</body>
</html>
