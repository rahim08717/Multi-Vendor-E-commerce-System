<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .sidebar { min-height: 100vh; background: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: #cfd2d6; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background: #495057; color: white; }
        .sidebar .active { background: #0d6efd; color: white; }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">My E-Commerce (Admin)</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 sidebar">
                    <h5 class="text-center">Seller Panel</h5>
                    <hr>
                    <a href="{{ route('seller.dashboard') }}">Dashboard</a>
                    <a href="{{ route('seller.product.create') }}">Add New Product</a>
                   <a href="{{ route('seller.products.index') }}" class="{{ request()->routeIs('seller.products.index') ? 'active' : '' }}">My Products</a>
                    <a href="{{ route('seller.orders.index') }}" class="{{ request()->routeIs('seller.orders.index') ? 'active' : '' }}">My Orders</a>
                </div>

                <div class="col-md-10 p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
