<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-gray-100 leading-tight">
            Role Details
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">

        <!-- Card Container -->
        <div
            class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 dark:from-purple-700 dark:via-pink-700 dark:to-red-700 p-8 rounded-3xl shadow-2xl relative overflow-hidden">

            <!-- Decorative shapes -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white opacity-20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-white opacity-10 rounded-full blur-2xl"></div>

            <!-- Role Info -->
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-white mb-4">Role: <span
                        class="text-yellow-300">{{ $role->name }}</span></h3>

                <!-- Permissions -->
                <h4 class="text-lg font-semibold text-white mb-2">Permissions:</h4>
                @if ($role->permissions->isEmpty())
                    <p class="text-yellow-200">No permissions assigned.</p>
                @else
                    <div class="flex flex-wrap gap-3 mt-2">
                        @foreach ($role->permissions as $permission)
                            <span
                                class="px-4 py-2 rounded-full text-sm font-medium
                                         bg-white bg-opacity-20 text-black backdrop-blur-sm
                                         hover:bg-opacity-40 transition">
                                {{ $permission->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="mt-8 flex justify-end space-x-3 gap-2 relative z-10">
                @can('role.edit')
                    <a href="{{ route('role.edit', $role->id) }}"
                        class="px-5 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-lg hover:bg-gray-900 transition">
                        Edit
                    </a>
                @endcan
                <a href="{{ route('role.index') }}"
                    class="px-5 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-lg hover:bg-gray-900 transition">
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
