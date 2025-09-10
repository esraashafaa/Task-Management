<x-app-layout>
    <form action="{{route('projects.update',$project->id)}}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{old('name',$project->name)}}">
        @error("name")
        {{ $message }}
        @enderror

        <button type="submit"> Update </button>

    </form>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Desc</th>
                <th scope="col">Assigned To</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($project->tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    {{ $task->user->name }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</x-app-layout>