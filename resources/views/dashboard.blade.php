<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(Auth::user()->status !== 'approved')
                <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                    Your account is pending approval. Please wait for admin confirmation.
                </div>
            @endif

            @if (Auth::user()->status === 'approved')
                <livewire:site-management />
            @endif
        </div>
    </div>
</x-app-layout>
