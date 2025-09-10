<x-app-layout>
    <x-slot name="header">
        tasks
    </x-slot>

    @if ($tasks->count() > 0)


    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">title</th>
                <th scope="col">desc</th>
                <th scope="col">assigned to</th>
                <th scope="col">labels</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td class="px-4 py-2">{{ $task->id }}</td>
                <td class="px-4 py-2">{{ $task->title }}</td>
                <td class="px-4 py-2">{{ $task->description }}</td>
                <td class="px-4 py-2"> {{ $task->user->name }}</td>
                <td class="px-4 py-2">
                    @foreach ($task->labels as $label)
                    <span>
                        @if($loop->last)
                        {{ $label->name }}
                        @else
                        {{ $label->name }} ||
                        @endif

                    </span>
                    @endforeach
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div>
        {{ $tasks->links() }}
    </div>


    @else
    <div>
        <p>No tasks</p>
    </div>
    @endif


</x-app-layout>