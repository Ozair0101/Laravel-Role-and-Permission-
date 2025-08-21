<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg">

                <form method="POST" action="{{ route('role.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $role->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Permissions -->
                    <div class="mt-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                Assign Permissions
                            </h3>
                            <!-- Select All Button -->
                            <button type="button" id="toggle-select"
                                class="text-sm px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 
                                       focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                                Select All
                            </button>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="permissions-container">
                            @foreach ($permissions as $permission)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="permission-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                    <span class="text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="ms-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggle-select');
            const checkboxes = document.querySelectorAll('.permission-checkbox');

            toggleBtn.addEventListener('click', () => {
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);

                checkboxes.forEach(cb => cb.checked = !allChecked);

                toggleBtn.textContent = allChecked ? 'Select All' : 'Deselect All';
            });
        });
    </script>
</x-app-layout>
