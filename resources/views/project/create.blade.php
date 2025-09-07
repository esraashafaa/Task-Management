<x-app-layout>
    <form action="{{route('projects.store')}}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        @error("name")
        {{ $message }}
        @enderror

        <button type="submit"> Create </button>

    </form>

      
</x-app-layout>