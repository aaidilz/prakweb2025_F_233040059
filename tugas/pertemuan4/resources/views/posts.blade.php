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
            <!-- Header with Search and Add Post Button -->
            <div class="px-6 py-4 border-b border-gray-200">
                <nav aria-label="Breadcrumb" class="flex">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a>
                        </li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-900 font-medium">Posts</li>
                    </ol>
                </nav>
            </div>

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <form method="GET" action="{{ route('posts.index') }}" class="flex-1 max-w-md">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" name="search" id="search" value="{{ request('search') }}" class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-sm rounded-md heading text-sm rounded-md focus:border-brand focus:border-brand shadow-sm focus:border-sm focus:placeholder:text-body" placeholder="Search posts..." />
                        <button type="submit" class="absolute end-1.5 bottom-1.5 bg-brand hover:bg-blue-700 text-white font-medium leading-5 rounded-md text-xs px-1.5 focus:outline-none focus:ring-4 focus:ring-transparent focus:ring-offset-transparent">Search</button>
                    </div>
                </form>
            </div>

            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Daftar Posts</h1>
                <p class="text-lg text-gray-600">Baca artikel-artikel menarik kami</p>
                <div class="mt-6">
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-300">
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

            <!-- Pagination -->
            <div class="mt-12 py-4 border-t border-gray-200">
                <nav aria-label="Page navigation">
                    <ul class="flex items-center justify-center gap-1">
                        {{-- Previous Button --}}
                        @if ($posts->onFirstPage())
                            <li>
                                <span class="px-3 py-2 text-gray-400 font-medium">Previous</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $posts->previousPageUrl() }}" class="flex items-center justify-center text-gray-500 hover:text-gray-700 font-medium">Previous</a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                            @if ($page == $posts->currentPage())
                                <li>
                                    <span aria-current="page" class="px-3 py-2 bg-blue-600 text-white font-medium rounded">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="px-3 py-2 text-gray-500 hover:text-gray-700 font-medium">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Button --}}
                        @if ($posts->hasMorePages())
                            <li>
                                <a href="{{ $posts->nextPageUrl() }}" class="flex items-center justify-center text-gray-500 hover:text-gray-700 font-medium">Next</a>
                            </li>
                        @else
                            <li>
                                <span class="px-3 py-2 text-gray-400 font-medium">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>
