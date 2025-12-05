<x-dashboard-layout>
    <x-slot:title>Edit Category</x-slot:title>

    <div class="space-y-6">
        <a href="{{ route('dashboard.categories.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Back to Categories</a>

        <h1 class="text-3xl font-bold text-gray-800">Edit Category</h1>

        {{-- Form Body --}}
        <form action="{{ route('dashboard.categories.update', $category) }}" method="POST" class="space-y-4 max-w-xl">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block mb-2.5 text-sm font-medium text-gray-900">Category Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter category name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block mb-2.5 text-sm font-medium text-gray-900">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="bg-gray-50 border @error('slug') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="category-slug">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Slug will be used in URLs. Use lowercase letters and hyphens.</p>
            </div>

            {{-- Form Footer --}}
            <div class="flex items-center space-x-4 border-t border-gray-200 pt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Category
                </button>
                <a href="{{ route('dashboard.categories.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    {{-- Auto-generate slug from name --}}
    <script>
        document.getElementById('name').addEventListener('input', function(e) {
            const slug = e.target.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
</x-dashboard-layout>
