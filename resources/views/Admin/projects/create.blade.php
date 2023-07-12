@extends('Admin.layouts.base')

@section('contents')
<h1>Add new Project</h1>

    <form method="POST" action="{{ route('admin.project.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title')}}">

            <div class="invalid-feedback">
                @error('title') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">type</label>
            <select class="form-select @error('type_id') is-invalid @enderror" id="type" name="type_id">
                <option selected>Change type</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('type_id') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author')}}">
            <div class="invalid-feedback">
                @error('author') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="creation_date" class="form-label">Creation Date</label>
            <input type="date" class="form-control @error('creation_date') is-invalid @enderror" id="creation_date" name="creation_date" value="{{ old('creation_date')}}">
            <div class="invalid-feedback">
                @error('creation_date') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="last_update" class="form-label">Last Update</label>
            <input type="date" class="form-control @error('last_update') is-invalid @enderror" id="last_update" name="last_update" value="{{ old('last_update')}}">
            <div class="invalid-feedback">
                @error('last_update') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="collaborators" class="form-label">Collaborators</label>
            <input type="text" class="form-control @error('collaborators') is-invalid @enderror" id="collaborators" name="collaborators" value="{{ old('collaborators')}}">
            <div class="invalid-feedback">
                @error('collaborators') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{ old('description')}}</textarea>
            <div class="invalid-feedback">
                @error('description') {{ $message }} @enderror
            </div>
        </div>


        <div class="mb-3">
            <h6>Languages</h6>
            @foreach ($languages as $language)
            <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="language{{ $language->id }}" 
                    value="{{ $language->id }}"
                    name="languages[]"
                    @if (in_array($language->id, old('languages') ?: [])) checked @endif 
                >
                <label class="form-check-label" for="language{{ $language->id }}">
               {{ $language->name }}
                </label>
            </div>
            @endforeach
        </div>


        <div class="mb-3">
            <label for="link_github" class="form-label">Link Github</label>
            <input type="textarea" class="form-control @error('link_github') is-invalid @enderror" id="link_github" name="link_github" value="{{ old('link_github')}}">
            <div class="invalid-feedback">
                @error('link_github') {{ $message }} @enderror
            </div>
        </div>

        <button class="btn btn-primary">Crea</button>
    </form>
@endsection