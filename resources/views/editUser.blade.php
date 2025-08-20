<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg">

                <form method="POST" action="{{ route('user.update', $user->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name"
                            class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 
                            dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
                            type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email"
                            class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 
                            dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
                            type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password (leave blank if unchanged)')" />
                        <x-text-input id="password"
                            class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 
                            dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
                            type="password" name="password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 
                            dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
                            type="password" name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('user.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 
                                  transition focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 rounded-md">
                            ← Back to Users
                        </a>

                        <x-primary-button class="px-6 py-2">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
