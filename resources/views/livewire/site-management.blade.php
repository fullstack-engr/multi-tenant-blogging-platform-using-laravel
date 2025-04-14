<?php

use function Livewire\Volt\{state, with};
use App\Models\Site;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

state(['name' => '', 'subdomain' => '']);

$createSite = function () {
    Auth::user()->sites()->create([
        'name' => $this->name,
        'subdomain' => $this->subdomain,
    ]);

    $this->name = '';
    $this->subdomain = '';
};

$deleteSite = function (int $id) {
    $site = Site::find($id);
    $site->delete();
};

with(fn () => [
    'sites' => Auth::user()->is_admin
        ? Site::with('user')->get()
        : Site::where('user_id', Auth::id())->get(),

    'posts' => Auth::user()->is_admin
        ? Post::with(['site', 'user'])->latest()->paginate(10)
        : collect()
]);

?>
<div class="py-6 mx-auto max-w-5xl sm:px-6 lg:px-8">
    @if (Auth::user()->is_admin)
        <section class="mb-10">
            <header class="bg-white rounded-lg shadow">
                <div class="px-4 py-6 mx-auto sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-bold text-gray-900">Pending Tenant Approvals</h1>
                </div>
            </header>

            <div class="bg-white shadow mt-6 rounded-lg p-6">
                @php
                    $pendingUsers = \App\Models\User::where('status', 'pending')->where('is_admin', false)->get();
                @endphp

                @if ($pendingUsers->isEmpty())
                    <p class="text-gray-500">No pending tenant accounts to approve.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-100 text-left text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Registered At</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($pendingUsers as $user)
                                <tr>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2">
                                        <form method="POST" action="{{ route('admin.approve-user', $user->id) }}">
                                            @csrf
                                            <x-primary-button>Approve</x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </section>
    @endif

    <header class="bg-white rounded-lg shadow">
        <div class="px-4 py-6 mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Manage Tenant Blog Sites</h1>
        </div>
    </header>

    <main class="mt-6">
        <div class="px-4 py-6 sm:px-0">
            <div x-data="{
                name: @entangle('name'),
                subdomain: @entangle('subdomain'),
                generateSubdomain() {
                    this.subdomain = this.name.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                }
            }">
                @if (!Auth::user()->is_admin)
                    <div class="mb-10">
                    <!-- Check if user already has a site -->
                    @if (Auth::user()->sites()->exists())
                        <p class="text-gray-500">You already have a site.</p>
                    @else
                        <div class="mb-8">
                            <h2 class="mb-4 text-xl font-semibold">Create New Site</h2>
                            <form wire:submit='createSite' class="p-6 space-y-4 bg-white shadow sm:rounded-lg">
                                <div>
                                    <x-input-label for='name' :value="__('Site Name')" />
                                    <x-text-input x-model="name" @input="generateSubdomain" id='name'
                                        class='block mt-1 w-full' type='text' name='name' required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class='mt-2' />
                                </div>

                                <div>
                                    <x-input-label for='subdomain' :value="__('Subdomain')" />
                                    <x-text-input x-model="subdomain" id='subdomain' class='block mt-1 w-full' type='text'
                                        name='subdomain' required />
                                    <x-input-error :messages="$errors->get('subdomain')" class='mt-2' />
                                </div>

                                <x-primary-button>{{ __('Create Site') }}</x-primary-button>
                            </form>
                        </div>
                    @endif
                    </div>
                @endif
            </div>

            <div>
                <h2 class="mb-4 text-xl font-semibold">
                    {{ Auth::user()->is_admin ? 'All Sites' : 'Your Sites' }}
                </h2>
                @forelse ($sites as $site)
                    <div class="overflow-hidden mb-4 bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $site->name }}</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        {{ $site->subdomain }}.{{ str_replace(['http:', 'https:'], '', config('app.url')) }}
                                        @if ($site->user)
                                            <span class="text-gray-400">— by {{ $site->user->name }}</span>
                                        @endif
                                    </p>
                                    <div class="mt-2">
                                        <a href="{{ route('site.home', ['subdomain' => $site->subdomain]) }}"
                                            class="mr-4 text-sm text-blue-600 hover:underline">View Site</a>
                                        <a href="{{ route('sites.manage', $site) }}"
                                            class="text-sm text-blue-600 hover:underline">Manage Posts</a>
                                    </div>
                                </div>
                                <button wire:click='deleteSite({{ $site->id }})'
                                    wire:confirm="Are you sure you want to delete this site?"
                                    class="px-4 py-2 text-sm font-medium text-red-600 bg-red-100 rounded-md hover:bg-red-200">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No sites yet.</p>
                @endforelse
            </div>

            @if (Auth::user()->is_admin)
                <div class="mt-10">
                    <h2 class="mb-4 text-xl font-semibold">All Posts</h2>
                    <div class="overflow-x-auto bg-white shadow rounded-lg">
                        <table class="min-w-full text-sm text-left text-gray-600">
                            <thead class="bg-gray-100 text-gray-700 uppercase">
                                <tr>
                                    <th class="px-4 py-3">Title</th>
                                    <th class="px-4 py-3">Site</th>
                                    <th class="px-4 py-3">Owner</th>
                                    <th class="px-4 py-3">Created</th>
                                    <th class="px-4 py-3">Content Preview</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr class="border-b">
                                        <td class="px-4 py-3 font-medium text-blue-600 hover:underline">
                                            <a href="{{ route('site.home', ['subdomain' => $post->site->subdomain]) }}#post-{{ $post->id }}">
                                                {{ $post->title }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $post->site->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $post->user->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $post->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ Str::limit(strip_tags($post->content), 50) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                            No posts found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>
