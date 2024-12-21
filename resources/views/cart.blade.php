<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .delete-link {
            color: #f44336; /* Red */
            text-decoration: underline;
            cursor: pointer;
        }
        .delete-link:hover {
            color: #d32f2f; /* Darker red on hover */
        }
        .buy-button {
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px; /* Adjust padding */
            cursor: pointer;
            font-size: 18px; /* Adjust font size */
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                {{-- Loop through cart items here --}}
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['amount'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>${{ $item['totalPrice'] }}</td>
                    <td>
                        <form action="{{ route('remove.from.cart', ['id' => $item['id']]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="delete-link" onclick="event.preventDefault(); this.closest('form').submit();">Remove</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total-price">
            <p>Total Price: ${{ $totalPrice }}</p>
        </div>
        <form action="{{ route('buy') }}" method="post">
            @csrf
            <button type="submit" class="buy-button">Buy</button>
        </form>
        <a href="{{ route('browse') }}">Continue Shopping</a>
    </div>
</body>
</html>
