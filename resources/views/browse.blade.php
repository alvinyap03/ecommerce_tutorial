<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .header-container {
            overflow: hidden; /* Clear floats */
            margin-bottom: 20px; /* Optional: Add some margin between the header and the content */
        }

        .header-container h2 {
            float: left;
            font-size: 24px; /* Increase font size */
            color: #333; /* Change text color */
            margin-right: 20px; /* Add some margin between the text and buttons */
        }

        .header-container .buttons-container {
            float: right;
        }

        .header-container .buttons-container > * {
            margin-left: 10px; /* Optional: Add some spacing between the buttons */
        }

        /* Button styles */
        .post-button button {
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cart-button button {
            background-color: #008CBA; /* Blue */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button button {
            background-color: #f44336; /* Red */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Adjust button styles for admin button */
        .admin-button button {
            background-color: #ff9800; /* Orange */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h2>Welcome Back! {{ $username }}</h2>

        <div class="buttons-container">
            <!-- Admin Button -->
            <a href="{{ route('admin') }}" class="admin-button"><button>Admin</button></a>

            <!-- Button for Posting -->
            <a href="{{ route('create') }}" class="post-button"><button>Post</button></a>

            <!-- Cart Button -->
            <a href="{{ route('cart') }}" class="cart-button"><button>Cart</button></a>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;" class="logout-button">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
    <img src="{{ asset('images/shopnow.jpg') }}" class="logo">

        <!-- Display Products -->
        @foreach($products as $product)
            <div class="product-container">
                <div class="product">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="Product Image">
                    @endif
                    <p>Uploaded Time: {{ $product->created_at }}</p>
                    <p>Seller: {{ $product->user->username }}</p>
                    <p>Product Name: {{ $product->name }}</p>
                    <p>Price: ${{ $product->price }}</p>
                </div>
                <div class="product-button">
                    <a href="{{ route('product.show', ['id' => $product->id]) }}"><button>View Product</button></a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
