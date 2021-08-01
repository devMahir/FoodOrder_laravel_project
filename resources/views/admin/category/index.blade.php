@extends('layouts.app')

@section('title','Category')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('category.create') }}" class="btn btn-info">Add New</a>
                @include('layouts.partial.msg')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">All Categories</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table" style="width:100%">
                                <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key=>$category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category ->name }}</td>
                                            <td>{{ $category ->slug }}</td>
                                            <td>{{ $category ->created_at }}</td>
                                            <td>{{ $category ->updated_at }}</td>
                                            <td>
                                               <a class="btn btn-info btn-sm" href="{{ route('category.edit', $category->id) }}"><i class="material-icons">mode_edit</i></a>
                                            </td>
                                            <td>
                                                <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy',  $category->id ) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush