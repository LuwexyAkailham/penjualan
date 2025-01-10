<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Agen Penjualan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white">
        <div class="container mx-auto px-4 flex items-center justify-between h-16">
            <a href="dashboard" class="text-lg font-bold">Luwexy</a>
            <div class="flex items-center space-x-4">
                <form class="hidden md:flex items-center">
                    <input type="text" class="form-input px-4 py-2 rounded-l-md" placeholder="Search for..." />
                    <button type="button" class="bg-blue-700 px-4 py-2 rounded-r-md hover:bg-blue-800">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="relative">
                    <button class="flex items-center focus:outline-none" id="userMenuButton" onclick="toggleDropdown('userMenu')">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white">
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg hidden" id="userMenu">
                        <a href="{{ route('users.settings') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                            Setting Account
                        </a>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar and Content -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-700 text-white min-h-screen">
            <div class="p-4">
                <h2 class="text-lg font-semibold">Menu</h2>
                <nav class="mt-4">
                    <a href="dashboard" class="block px-4 py-2 hover:bg-blue-800 rounded-md">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <div>
                        <button class="w-full text-left px-4 py-2 hover:bg-blue-800 rounded-md flex items-center justify-between" onclick="toggleDropdown('productDropdown')">
                            <span><i class="fas fa-cube"></i> Produk</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="productDropdown" class="hidden mt-2 space-y-2 pl-6">
                            <a href="{{ route('products.index') }}" class="block px-4 py-2 hover:bg-blue-800 rounded-md">Tambah Produk</a>
                        </div>
                    </div>
                    <div>
                        <button class="w-full text-left px-4 py-2 hover:bg-blue-800 rounded-md flex items-center justify-between" onclick="toggleDropdown('categoryDropdown')">
                            <span><i class="fas fa-list"></i> Kategori</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="categoryDropdown" class="hidden mt-2 space-y-2 pl-6">
                            @foreach(App\Models\Category::all() as $category)
                                <a href="{{ route('categories.show', $category->id) }}" class="block px-4 py-2 hover:bg-blue-800 rounded-md">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </nav>
            </div>
            <div class="p-4 mt-auto">
                <p class="text-sm">Logged in as: Luwexy</p>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <main>
                @yield('content')
            </main>
            <footer class="mt-8 text-center text-gray-600">
                <p>&copy; 2023 Your Website. <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a> &middot; <a href="#" class="text-blue-600 hover:underline">Terms &amp; Conditions</a></p>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleDropdown(id) {
            const element = document.getElementById(id);
            element.classList.toggle('hidden');
        }
    </script>
</body>
</html>
