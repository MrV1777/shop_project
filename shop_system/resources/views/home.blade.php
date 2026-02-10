<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    @include('components.header')

    <div class="container">
        <div class="welcome-card">
            <div class="welcome-icon">🎉</div>
            <h2>Welcome to Shop System</h2>
            <p>You have successfully logged in to the system.</p>
            
            <div class="mongodb-status">
                <h3><span class="check-icon">✓</span> MongoDB Connected</h3>
                <p>Database: project_shop</p>
                <p>Collection: users</p>
            </div>
        </div>
    </div>
</body>
</html>
