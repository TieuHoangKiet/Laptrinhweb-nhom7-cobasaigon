<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Cô Ba Sài Gòn') - Cô Ba Sài Gòn</title>
  
    @vite(['resources/css/app.css'])
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Alpine.js (nếu bạn dùng dropdown trong header) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- CSS tùy chỉnh khác nếu có -->
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col">
    <x-header /> <!-- Sử dụng component header -->

    <main class="flex-grow">
        @yield('content')
    </main>

    <x-footer /> <!-- Sử dụng component footer -->

    <!-- JS tùy chỉnh khác nếu có -->
    @yield('scripts')
</body>
</html>