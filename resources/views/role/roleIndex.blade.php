<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Create Button -->
        <div class="mb-6 flex justify-end">
            @can('role.create')
                <a href="{{ route('role.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600
            rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 
            focus:ring-offset-2 focus:ring-blue-400 transition ease-in-out duration-150">
                    + Create Role
                </a>
            @endcan
        </div>

        <!-- role Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-xl">
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Permissions</th>
                        <th scope="col" class="px-6 py-3 w-60 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr
                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                            <td class="px-6 py-3 font-medium text-gray-900 dark:text-gray-100">{{ $role->id }}</td>
                            <td class="px-6 py-3">{{ $role->name }}</td>
                            <td class="px-6 py-3">
                                @if ($role->permissions->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($role->permissions as $permission)
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full
                             bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400 italic">No Permissions</span>
                                @endif
                            </td>

                            <td class="px-6 py-3 flex justify-center space-x-2">

                                <!-- Edit -->
                                @can('role.edit')
                                    <a href="{{ route('role.edit', $role->id) }}"
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-blue-600
                                    rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 
                                    focus:ring-offset-2 focus:ring-blue-400 transition">
                                        Edit
                                    </a>
                                @endcan
                                @can('role.view')
                                    <!-- Show -->
                                    <a href="{{ route('role.show', $role->id) }}"
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-green-600
                                        rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 
                                        focus:ring-offset-2 focus:ring-green-400 transition">
                                        Show
                                    </a>
                                @endcan
                                @can('role.delete')
                                    <!-- Delete -->
                                    <form method="POST" action="{{ route('role.delete', $role->id) }}">
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
