@extends('Admin.layouts.base')

@section('contents')
    <div class="container">
        {{-- @if (session('delete_success'))
        @php $language = session('delete_success') @endphp
        <div class="alert alert-danger">
            The Language "{{ $language->name }}" has been Deleted
            <form
                action="{{ route("admin.language.restore", ['language' => $language]) }}"
                    method="post"
                    class="d-inline-block"
                >
                @csrf
                <button class="btn btn-warning">Cancel</button>
            </form>
        </div>
        @endif --}}
    
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($languages as $language)
                    <tr>
                        <td scope="row">{{ $language->name }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.language.show', ['language' => $language->id]) }}">View</a>
                            <a class="btn btn-warning" href="{{ route('admin.language.edit', ['language' => $language->id]) }}">Edit</a>
                            <button language="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $language->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
    
        <div class="modal fade text-dark" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <form
                            action="{{ route('admin.language.destroy', ['language' => $language]) }}"
                            method="post"
                            class="d-inline-block"
                            id="confirm-delete"
                            data-template="{{ route('admin.language.destroy', ['language' => '*****']) }}"
                        >
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
{{-- {{ $projects->links() }} --}}
@endsection