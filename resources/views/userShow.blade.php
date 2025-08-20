<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl" style="color: white">
                    Name:
                    <h1 style="color: white">{{ $user->name }}</h1>
                    Email:
                    <p style="color: white">{{ $user->email }}</p>
                </div>
                <a href="{{ route('user.edit', $user->id) }}"
                    class=  "cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700
                        rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  ">
                    Edit
                </a>

                <form method="post" style="display: inline;" action="{{ route('user.delete', $user->id) }}"
                    class=  "cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-700
                rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  ">
                    @csrf
                    @method('Delete')
                    <button type="submit">Delete</button>
                    </a>
            </div>
        </div>
    </div>
</x-app-layout>
