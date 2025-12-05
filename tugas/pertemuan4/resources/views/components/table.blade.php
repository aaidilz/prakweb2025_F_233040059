<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    {{-- Table --}}
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Published At
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="bg-neutral-primary-soft border-b border-default">
                        <td class="px-6 py-4">
                            {{ $posts->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-16 h-16 rounded-lg object-cover">
                            @else
                                <img id="preview" class="w-16 h-16 rounded-lg bg-gray-100" src="{{ asset('images/preview.jpg') }}" alt="Image preview">
                            @endif
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $post->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $post->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('dashboard.show', ['post' => $post->slug]) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('dashboard.edit', ['post' => $post->slug]) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('dashboard.destroy', ['post' => $post->slug]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            No posts yet.
                            <a href="{{ route('dashboard.create') }}" class="text-blue-600 hover:underline">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
