@extends('layouts.admin')

@section('content')
    <h1>{{ $project->name }}</h1>

    <div>
        <strong>ID:</strong> {{ $project->id }}
    </div>

    <div>
        <strong>Slug:</strong> {{ $project->slug }}
    </div>

    <div>
        <strong>Type:</strong> {{ $project->type ? $project->type->name : 'No type'}}
    </div>

    <div>
        <strong>Created at:</strong> {{ $project->created_at }}
    </div>

    <div>
        <strong>Updated at:</strong> {{ $project->updated_at }}
    </div>

    @if ($project->summary)
        <div class="mt-3">
            <strong>Summary:</strong> {{ $project->summary }}
        </div>       
    @endif
@endsection