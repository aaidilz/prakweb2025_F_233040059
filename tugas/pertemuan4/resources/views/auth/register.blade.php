<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Create account</h1>
            <p class="text-sm text-gray-600 mb-6">Join us to start exploring content.</p>

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-50 text-red-800 px-3 py-2 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
                <button type="submit" class="w-full inline-flex justify-center items-center rounded-md bg-blue-600 px-4 py-2 text-white font-medium hover:bg-blue-700">Create account</button>
            </form>

            <p class="mt-6 text-sm text-gray-600">Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in</a>
            </p>
        </div>
    </div>
</body>
</html>
