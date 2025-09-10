<x-app-layout>

<a href="{{route('projects.create')}}">
    Create Project

</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">UserName</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{$project->id}}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->user->name }}</td>
                <td>
                        <a href="{{route('projects.edit',$project->id)}}">edit</a>
                        <form action="{{route('projects.delete',$project->id)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $projects->links() }}
    </div>
</x-app-layout> `