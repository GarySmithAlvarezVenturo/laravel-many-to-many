@extends('Admin.layouts.base')

@section('contents')

    {{-- @if (session('delete_success'))
    @php $type = session('delete_success') @endphp
    <div class="alert alert-danger">
        The type "{{ $type->title }}" has been Deleted
        <form
            action="{{ route("admin.type.restore", ['type' => $type]) }}"
                method="post"
                class="d-inline-block"
            >
            @csrf
            <button class="btn btn-warning">Cancel</button>
        </form>
    </div>
    @endif --}}

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Descrition</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $type->name }}</th>
                <td>{{ $type->description }}</td>


                <td>
                    <a class="btn btn-warning" href="{{ route('admin.type.edit', ['type' => $type->id]) }}">Edit</a>
                    <form
                        action="{{ route('admin.type.destroy', ['type' => $type->id]) }}"
                        method="post"
                        class="d-inline-block"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table> 
@endsection