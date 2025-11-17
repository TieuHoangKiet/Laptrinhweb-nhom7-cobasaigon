<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hồ Sơ - Cỏ Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; }
    </style>
</head>
<body>

    <x-header />

    <main class="container py-5">
        <h1 class="text-center mb-4 fw-bold">Quản lý Hồ Sơ</h1>

        <div class="row justify-content-center g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4 p-md-5">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                 <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>