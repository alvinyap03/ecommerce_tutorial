<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
<div class="container">
<title>Update User</title>
    <div class="update-form">
        <h2>Update User</h2>
        
        <form action="{{ route('update.post', ['user' => $user]) }}" method="post">
            @csrf <!-- Include CSRF token for security -->
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            
            <div>
                <label for="new_username">New Username:</label>
                <input type="text" name="new_username" value="{{ $user->username }}" required>
            </div>
            
            <div>
                <label for="new_fullname">New Full Name:</label>
                <input type="text" name="new_fullname" value="{{ $user->fullname }}" required>
            </div>
            
            <div>
                <label for="new_gmail">New Gmail:</label>
                <input type="text" name="new_gmail" value="{{ $user->gmail }}" required>
            </div>
            
            <!-- Include this field only if the user wants to update the password -->
            <div>
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password">
            </div>

            <input type="submit" name="update" value="Update" class="update-button">

            <!-- Use a form with method="get" to redirect back -->
            <form action="{{ route('main') }}" method="get">
            <input type="submit" value="Back" class="back-button"> 
            </form>
        </form>
    </div>
    </div>

</body>
</html>