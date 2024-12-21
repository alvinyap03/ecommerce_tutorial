<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Link to your external CSS file -->
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/Maxunity.png') }}" class="logo">
        <h2>Login</h2>
        
        <form action="{{ route('login') }}" method="post">
        @csrf <!-- Include Laravel CSRF token -->
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
        
        <Label for="password">Password:</Label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        
        <input type="submit" value="Login" class="login-button">
        </form>
        
    </div>
</body>
</html>