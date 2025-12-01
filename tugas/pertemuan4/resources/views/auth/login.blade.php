<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Sign in</h1>
            <p class="text-sm text-gray-600 mb-6">Welcome back! Please enter your details.</p>

            @if (session('success'))
                <div class="mb-4 rounded bg-green-50 text-green-800 px-3 py-2 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-50 text-red-800 px-3 py-2 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
                <button type="submit" class="w-full inline-flex justify-center items-center rounded-md bg-blue-600 px-4 py-2 text-white font-medium hover:bg-blue-700">Sign in</button>
            </form>

            <p class="mt-6 text-sm text-gray-600">Don't have an account?
                <a href="{{ route('register.form') }}" class="text-blue-600 hover:underline">Create one</a>
            </p>
        </div>
    </div>
</body>
</html>
