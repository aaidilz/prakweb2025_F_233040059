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
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Published At
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="bg-neutral-primary-soft border-b border-default">
                        <td class="px-6 py-4">
                            {{ $posts->firstItem() + $loop->index }}
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
                        <td class="px-6 py-4">
                            <a href="{{ route('dashboard.show', ['post' => $post->slug]) }}" class="text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            No posts yet.
                            <a href="{{ route('dashboard.create') }}" class="text-blue-600 hover:underline">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
