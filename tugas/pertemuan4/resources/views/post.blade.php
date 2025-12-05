<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <div class="mb-8">
                <nav aria-label="Breadcrumb" class="flex">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a>
                        </li>
                        <li class="text-gray-400">/</li>
                        <li>
                            <a href="{{ route('posts.index') }}" class="text-gray-500 hover:text-gray-700">Posts</a>
                        </li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-900 font-medium">{{ Str::limit($post->title, 30) }}</li>
                    </ol>
                </nav>
            </div>

            <!-- Post Content -->
            <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Post Image -->
                @if($post->image_path)
                    <div class="w-full h-96 overflow-hidden">
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Post Header -->
                <div class="p-8">
                    <div class="mb-4 flex items-center gap-4 text-sm text-gray-600">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </span>
                        <span>By {{ $post->author->name }}</span>
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                    <!-- Excerpt -->
                    <div class="text-xl text-gray-600 mb-8 italic border-l-4 border-blue-500 pl-4">
                        {{ $post->excerpt }}
                    </div>

                    <!-- Post Body -->
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($post->body)) !!}
                    </div>
                </div>

                <!-- Post Footer -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name) }}&background=3B82F6&color=fff" alt="{{ $post->author->name }}" class="w-12 h-12 rounded-full">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $post->author->name }}</p>
                                <p class="text-sm text-gray-500">{{ $post->author->email }}</p>
                            </div>
                        </div>

                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-300">
                            &larr; Back to Posts
                        </a>
                    </div>
                </div>
            </article>

            <!-- Related Posts or Additional Actions -->
            @if(auth()->id() === $post->user_id)
                <div class="mt-8 bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Post Actions</h3>
                    <div class="flex gap-4">
                        <a href="{{ route('dashboard.edit', $post->slug) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 transition-colors duration-300">
                            Edit Post
                        </a>
                        <form action="{{ route('dashboard.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors duration-300">
                                Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
