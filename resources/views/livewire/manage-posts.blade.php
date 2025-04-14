<?php

use function Livewire\Volt\{state, mount, with, usesPagination};
use App\Models\Site;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

usesPagination();

state([
    'site',
    'title' => '',
    'content' => '',
    'editPostId' => null,
    'editTitle' => '',
    'editContent' => ''
]);

$createPost = function () {
    $this->site->posts()->create([
        'title' => $this->title,
        'content' => $this->content,
        'user_id' => Auth::user()->id,
    ]);

    $this->title = '';
    $this->content = '';
};

$deletePost = function (Post $post) {
    $post->delete();
};

$editPost = function (Post $post) {
    $this->editPostId = $post->id;
    $this->editTitle = $post->title;
    $this->editContent = $post->content;
};

$updatePost = function () {
    $post = Post::find($this->editPostId);
    if ($post) {
        $post->update([
            'title' => $this->editTitle,
            'content' => $this->editContent,
        ]);

        $this->editPostId = null;
        $this->editTitle = '';
        $this->editContent = '';
    }
};

mount(function (Site $site) {
    $this->site = $site;
});

with(fn() => [
    'posts' => $this->site->posts()->with('user')->latest()->paginate(15),
]);

?>

<div class="py-6 mx-auto max-w-3xl sm:px-6 lg:px-8">
    <header class="bg-white rounded-lg shadow">
        <div class="px-4 py-6 mx-auto max-w-3xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Manage Posts for {{ $site->name }}</h1>
            <p class="text-sm text-gray-500">
                <a href="{{ route('site.home', ['subdomain' => $site->subdomain]) }}"
                    class="text-blue-500 hover:underline">
                    {{ $site->subdomain }}.{{ str_replace(['http:', 'https:'], '', config('app.url')) }}
                </a>
            </p>
        </div>
    </header>

    <main class="mt-6">
        <div class="px-4 py-6 sm:px-0">
            @if (!Auth::user()->is_admin)
                <div class="mb-8">
                    <h2 class="mb-4 text-xl font-semibold">Create New Post</h2>
                    <form wire:submit='createPost' class="p-6 space-y-4 bg-white shadow sm:rounded-lg">
                        <div>
                            <label for='title' class="block text-sm font-medium text-gray-700">Title</label>
                            <input wire:model='title' id='title' class='block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' type='text' name='title' required autofocus />
                            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for='content' class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea wire:model='content' id='content' class='block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' name='content' rows="4" required></textarea>
                            @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">Create Post</button>
                    </form>
                </div>
            @endif

            <div>
                <h2 class="mb-4 text-xl font-semibold">Posts</h2>
                @forelse ($posts as $post)
                    <div class="overflow-hidden mb-4 bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $post->title }}</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $post->user->name }} ·
                                        {{ $post->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="flex items-center">
                                    <span class="inline-flex px-2 mr-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                    <button wire:click="editPost({{ $post->id }})" class="text-blue-600 hover:text-blue-900 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.939H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="deletePost({{ $post->id }})" class="text-red-600 hover:text-red-900" wire:confirm="Are you sure you want to delete this post?">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-5 border-t border-gray-200 sm:p-0">
                            <div class="sm:px-6 sm:py-5">
                                <p class="text-sm text-gray-900">{{ $post->content }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No posts yet.</p>
                @endforelse

                {{ $posts->links() }}
            </div>
        </div>
    </main>

    <!-- Edit Post Modal -->
    @if ($editPostId)
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Post</h3>
                            <div class="mt-2">
                                <form wire:submit.prevent="updatePost" class="space-y-4">
                                    <div>
                                        <label for='editTitle' class="block text-sm font-medium text-gray-700">Title</label>
                                        <input wire:model='editTitle' id='editTitle' class='block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' type='text' name='editTitle' required autofocus />
                                        @error('editTitle') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label for='editContent' class="block text-sm font-medium text-gray-700">Content</label>
                                        <textarea wire:model='editContent' id='editContent' class='block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' name='editContent' rows="4" required></textarea>
                                        @error('editContent') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mt-5 sm:mt-6">
                                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Update Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button wire:click="$set('editPostId', null)" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
