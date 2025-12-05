<x-dashboard-layout>
    <x-slot:title>Edit Post</x-slot:title>

    <div class="space-y-6">
        <a href="{{ route('dashboard.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Back to Dashboard</a>

        {{-- Form Body --}}
        <form action="{{ route('dashboard.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="col-span-2">
                <label for="title" class="block mb-2.5 text-sm font-medium text-heading">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="bg-neutral-secondary-medium border @error('title') border-red-500 @else border-default-medium @enderror text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter post title">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div class="col-span-2">
                <label for="category_id" class="block mb-2.5 text-sm font-medium text-heading">Category</label>
                <select name="category_id" id="category_id" class="block w-full p-3 py-2.5 bg-neutral-secondary-medium border @error('category_id') border-red-500 @else border-default @enderror focus:ring-brand focus:border-brand rounded-base text-heading text-sm focus:ring-brand focus:border-brand">
                    <option value="">--Select category option--</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Image --}}
            @if($post->image_path)
                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Current Image</label>
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-48 h-48 rounded-lg object-cover">
                </div>
            @endif

            {{-- Image Upload --}}
            <div class="col-span-2">
                <label for="image" class="block mb-2.5 text-sm font-medium text-heading">Upload New Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/jpg" class="cursor-pointer bg-neutral-secondary-medium border-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-2.5 shadow-xs placeholder:text-body">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Excerpt --}}
            <div class="col-span-2">
                <label for="excerpt" class="block mb-2.5 text-sm font-medium text-heading">Excerpt</label>
                <textarea name="excerpt" id="excerpt" rows="3" class="block w-full p-3 py-2.5 shadow-xs bg-neutral-secondary-medium border border-default focus:ring-brand focus:border-brand rounded-base focus:ring-brand focus:border-brand block w-full p-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Write a short excerpt of summary!">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Body --}}
            <div class="col-span-2">
                <label for="body" class="block mb-2.5 text-sm font-medium text-heading">Content</label>
                <textarea name="body" id="body" rows="8" class="block w-full p-3 py-2.5 shadow-xs bg-neutral-secondary-medium border border-default focus:ring-brand focus:border-brand rounded-base focus:ring-brand focus:border-brand block w-full p-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Write your post content here!">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Form Footer --}}
            <div class="flex items-center space-x-4 border-t border-default pt-4 mt:pt-6 gap-8">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Post
                </button>
                <a href="{{ route('dashboard.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-dashboard-layout>
