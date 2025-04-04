<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Laravel Application</title>

    <!-- Include appropriate CSS based on the user type -->
    @if(Auth::check())
        @if(Auth::user()->role == 'user')
            <link href="{{ asset('css/user.css') }}" rel="stylesheet">
        @elseif(Auth::user()->role == 'lgu')
            <link href="{{ asset('css/lgu.css') }}" rel="stylesheet">
        @elseif(Auth::user()->role == 'mdrrmo')
            <link href="{{ asset('css/mdrrmo.css') }}" rel="stylesheet">
        @elseif(Auth::user()->role == 'admin')
            <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        
        @endif
    @endif
</head>
<body>
    <header>
        <!-- Header content goes here (e.g., logo, navigation) -->
        <nav>
            <!-- Add links to your site -->
        </nav>
    </header>

    <!-- Main content area -->
    <div class="container">
        @yield('content') <!-- Content will be injected here -->
    </div>

    <!-- Footer content goes here -->
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
