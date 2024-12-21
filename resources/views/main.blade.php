<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Adjustments for button positioning */
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="top-right">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>

        <form method="GET" action="{{ route('purchase') }}">
            <button type="submit" class="record-button">Record</button>
        </form>

        <!-- Button to go to the browse page -->
        <form method="GET" action="{{ route('browse') }}">
            <button type="submit" class="browse-button">Browse</button>
        </form>
    </div>

    <h2>Welcome Back! {{ $username }}</h2>

    <div class="container">
        <h2>Insert User</h2>
        <form action="{{ route('insert') }}" method="post">
            @csrf
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" required>

            <label for="gmail">Gmail:</label>
            <input type="text" name="gmail" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Insert" class="insert-button">
        </form>
    </div>

    <div class="container">
        <h2>User List</h2>
        <div class="container2">
            @foreach($users as $user)
                <div class="user-entry">
                    <div>
                        User ID: {{ $user->id }} | Username: {{ $user->username }}
                    </div>
                    <div class="user-actions">
                        <form action="{{ route('delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button type="submit" class="delete-button" name="delete">Delete</button>
                        </form>
                        <form action="{{ route('gotoupdate', ['user_id' => $user->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="update-button" name="gotoupdate">Update</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
