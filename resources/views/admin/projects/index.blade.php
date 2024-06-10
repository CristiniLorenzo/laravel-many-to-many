@extends('layouts.admin')

@section('content')
    <h1>Progetti</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Client Name</th>
                <th>Slug</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->client_name }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->created_at }}</td>

                    <td>
                        <div>
                            <a href=" {{ route('admin.projects.show', ['project' => $project->id]) }}" >Show More</a>
                        </div>

                        <div>
                            <a href=" {{ route('admin.projects.edit', ['project' => $project->id]) }}" >Edit</a>
                        </div>

                        <div>
                            <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection