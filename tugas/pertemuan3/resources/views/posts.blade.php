<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Daftar Posts</h1>
                <p class="text-lg text-gray-600">Baca artikel-artikel menarik kami</p>
                <div class="mt-6">
                    <a href="/categories" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-300">
                        Lihat Kategori
                    </a>
                </div>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <article class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-linear-to-br from-blue-400 to-purple-500"></div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded-full">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition-colors">
                                <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>By {{ $post->author->name }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
