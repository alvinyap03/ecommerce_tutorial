<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Records</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .container {
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .back-button {
            background-color: #938f77;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px; /* Add some margin to separate from the table */
            display: block; /* Make the back button a block-level element */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Add a container div -->
        <h1>Purchase Records</h1>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Total Cost</th>
                    <th>Created At</th> <!-- Add this header for created time -->
                </tr>
            </thead>
            <tbody>
                @foreach($purchaseRecords as $record)
                <tr>
                    <td>{{ $record->user_id }}</td>
                    <td>{{ $record->user->username }}</td>
                    <td><a href="{{ route('product.show', ['id' => $record->product_id]) }}">{{ $record->product_id }}</a></td>
                    <td>{{ $record->product->name }}</td>
                    <td>{{ $record->amount }}</td>
                    <td>${{ $record->total_cost }}</td>
                    <td>{{ $record->created_at }}</td> <!-- Display the created time -->
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('main') }}" class="back-button">Back</a>
    </div> <!-- Close the container div -->
</body>
</html>
