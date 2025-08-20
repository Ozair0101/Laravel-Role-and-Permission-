<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <a href="{{ route('user.create') }}">
        <button
            class="mb-4 px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800
        focus:ring-4 focus:outline-none focus:ring-blue-300">
            Create
        </button>
    </a>
    <div class="overflow-x-auto mt-4">
        <table class="w-full text-sm text-left text-gray-700  ">
            <thead class="text-xs uppercase
                bg-gray-50 text-gray-700  ">
                <tr>
                    <th scope="col" class="px-6 py-3 ">ID</th>
                    <th scope="col" class="px-6 py-3 ">Name</th>
                    <th scope="col" class="px-6 py-3 ">Email</th>
                    <th scope="col" class="px-6 py-3 w-70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200">

                        <td class="px-6 py-2 font-medium text-gray-900">{{ $user->id }}</td>
                        <td class="px-6 py-2 text-gray-700">{{ $user->name }}</td>
                        <td class="px-6 py-2 text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-2 space-x-1">
                            <a href="{{ route('user.edit', $user->id) }}"
                                class=  "cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700
                        rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  ">
                                Edit
                            </a>
                            <a href="{{ route('user.show', $user->id) }}"
                                class=  "cursor-pointer px-3 py-2 text-xs font-medium text-white bg-green-700
                    rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300  ">
                                Show
                            </a>
                            <form method="post" style="display: inline;" action="{{ route('user.delete', $user->id) }}"
                                class=  "cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-700
                rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  ">
                                @csrf
                                @method('Delete')
                                <button type="submit">Delete</button>
                                </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

</x-app-layout>
