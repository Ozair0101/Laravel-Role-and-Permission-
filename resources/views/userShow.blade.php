<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white dark:bg-gray-800 shadow-xl rounded-2xl">

                <!-- Profile Info -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Name</h3>
                        <p class="text-gray-700 dark:text-gray-300 text-lg">{{ $user->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Email</h3>
                        <p class="text-gray-700 dark:text-gray-300 text-lg">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex space-x-4">
                    @can('role.edit')
                        <a href="{{ route('user.edit', $user->id) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 
                        rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 
                        focus:ring-offset-2 focus:ring-blue-400 transition ease-in-out duration-150">
                            Edit
                        </a>
                    @endcan
                    @can('role.delete')
                        <form method="POST" action="{{ route('user.delete', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 
    rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 
    focus:ring-offset-2 focus:ring-red-400 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
