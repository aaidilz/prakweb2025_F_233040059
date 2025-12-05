<x-dashboard-layout>
    <x-slot:title>Post Detail</x-slot:title>

    <div class="space-y-4">
        <a href="{{ route('dashboard.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Back to Dashboard</a>

        <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
        <p class="text-gray-500 text-sm">By {{ $post->author->name }} | Category: {{ $post->category->name ?? 'Uncategorized' }}</p>
        <p class="text-gray-500 text-sm">Published: {{ optional($post->created_at)->format('d M Y') }}</p>

        @if($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-64 rounded-lg object-cover border border-default bg-gray-100">
        @endif

        <div class="prose max-w-none">
            {!! nl2br(e($post->body ?? '')) !!}
        </div>
    </div>
</x-dashboard-layout>
