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
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{$project->id}}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>