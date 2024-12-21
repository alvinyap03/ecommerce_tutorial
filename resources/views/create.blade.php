<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .container form div {
            margin-bottom: 15px;
        }
        .container form label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
            vertical-align: top; /* Align label text to the top */
        }
        .container form input[type="text"],
        .container form input[type="file"],
        .container form input[type="number"],
        .container form textarea {
            width: calc(100% - 180px); /* Adjust width based on label width */
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            vertical-align: top; /* Align input fields to the top */
        }
        .container form textarea {
            height: 150px; /* Adjust height */
        }
        .container form button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .container form button[type="submit"] {
            background-color: #4CAF50; /* Green */
            color: white;
        }
        .container form button[type="button"] {
            background-color: #f44336; /* Red */
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Product</h1>
        
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('create.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="price">Price (RM) :</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" step="0.01">
            </div>
            <div>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" required min="1">
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            </div>
            <div>
                <!-- Back button -->
                <a href="{{ route('browse') }}"><button type="button">Back</button></a>
                
                <!-- Submit button -->
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
