<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Create Button -->
        <div class="mb-6 flex justify-end">
            @can('role.create')
                <a href="{{ route('user.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600
            rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 
            focus:ring-offset-2 focus:ring-blue-400 transition ease-in-out duration-150">
                    + Create User
                </a>
            @endcan
        </div>

        <!-- User Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-xl">
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3 w-60 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr
                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                            <td class="px-6 py-3 font-medium text-gray-900 dark:text-gray-100">{{ $user->id }}</td>
                            <td class="px-6 py-3">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full
                             bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>

                            </td>
                            {{-- <td class="px-6 py-3"> {{ $user->roles->pluck('name')->join(', ') }} </td> --}}
                            <td class="px-6 py-3 flex justify-center space-x-2">
                                @can('role.edit')
                                    <!-- Edit -->
                                    <a href="{{ route('user.edit', $user->id) }}"
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-blue-600
    rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 
    focus:ring-offset-2 focus:ring-blue-400 transition">
                                        Edit
                                    </a>
                                @endcan

                                <!-- Show -->
                                @can('role.view')
                                    <a href="{{ route('user.show', $user->id) }}"
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-green-600
                                    rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 
                                    focus:ring-offset-2 focus:ring-green-400 transition">
                                        Show
                                    </a>
                                @endcan

                                <!-- Delete -->
                                @can('role.delete')
                                    <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-red-600
                                               rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 
                                               focus:ring-offset-2 focus:ring-red-400 transition">
                                            Delete
                                        </button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
