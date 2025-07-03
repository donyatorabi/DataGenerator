{{-- resources/views/tasks/index.blade.php --}}
<x-app-layout>
    <!-- ----------  Page header  ---------- -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Tasks') }}
        </h2>
    </x-slot>

    <!-- ----------  Page body  ---------- -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Add‑task form --}}
                    <form id="addTaskForm" class="mb-4">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text"
                                   name="title"
                                   class="flex-1 rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 p-2"
                                   placeholder="Task title"
                                   required>
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded">
                                Add
                            </button>
                        </div>
                    </form>

                    {{-- Task list --}}
                    <ul id="taskList" class="space-y-2">
                        @foreach ($tasks as $task)
                            <li data-id="{{ $task->id }}" class="flex items-center gap-2">
                                <input type="checkbox"
                                       class="toggleTask accent-indigo-600"
                                    {{ $task->is_completed ? 'checked' : '' }}>
                                <span class="{{ $task->is_completed ? 'line-through text-gray-400' : '' }}">
                                    {{ $task->title }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ----------  Inline scripts  ---------- -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        /* add new task ------------------------------------------------------ */
        // Create task — with SweetAlert on error
        document.getElementById('addTaskForm').addEventListener('submit', async e => {
            e.preventDefault();
            const form = e.target;

            try {
                const res = await axios.post("{{ route('tasks.store') }}", new FormData(form));
                const task = res.data;

                document.getElementById('taskList').insertAdjacentHTML('afterbegin', `
            <li data-id="${task.id}" class="flex items-center gap-2">
                <input type="checkbox" class="toggleTask accent-indigo-600">
                <span>${task.title}</span>
            </li>
        `);
                form.reset();

            } catch (error) {
                const msg = error.response?.data?.message || 'Something went wrong';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: msg,
                });
            }
        });

        // Toggle task — with SweetAlert on failure
        document.getElementById('taskList').addEventListener('change', async e => {
            if (!e.target.classList.contains('toggleTask')) return;

            const li = e.target.closest('li');
            const id = li.dataset.id;
            const txt = li.querySelector('span');

            try {
                await axios.patch(`/tasks/${id}/toggle`, {
                    _token: '{{ csrf_token() }}'
                });

                txt.classList.toggle('line-through');
                txt.classList.toggle('text-gray-400');

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to update task',
                    text: error.response?.data?.message || 'Unauthorized or server error',
                });
            }
        });

    </script>
</x-app-layout>
