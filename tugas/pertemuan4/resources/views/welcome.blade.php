<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-6">Welcome to Our Blog</h1>
            <p class="text-lg text-gray-600 mb-8">Discover amazing articles and categories</p>
            <div class="space-x-4">
                <a href="/posts" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                    View Posts
                </a>
                <a href="/categories" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-300">
                    View Categories
                </a>
                @guest
                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-300">
                    Login
                </a>
                <a href="{{ route('register.form') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors duration-300">
                    Register
                </a>
                @else
                <a href="{{ route('dashboard.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-300">
                    Go to Dashboard
                </a>
                @endguest
            </div>
        </div>
    </div>
</body>
</html>