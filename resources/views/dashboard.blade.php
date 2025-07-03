<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <!-- New Button with Colorful Text -->
                    <div class="mt-4">
                        <a href="{{ route('tasks.index') }}"
                           class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-full font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 hover:from-pink-600 hover:via-red-600 hover:to-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-400 transition transform hover:scale-105 ease-in-out duration-200 shadow hover:shadow-lg">
                            <!-- Folder Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5 mr-2"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path d="M2 4a2 2 0 012-2h4l2 2h6a2 2 0 012 2v2H2V4z" />
                                <path d="M2 8h16v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8z" />
                            </svg>
                            Manage Tasks
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
