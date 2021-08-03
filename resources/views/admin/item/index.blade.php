@extends('layouts.app')

@section('title','Items')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('item.create') }}" class="btn btn-info">Add New</a>
                @include('layouts.partial.msg')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">All Items</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table" style="width:100%">
                                <thead class="text-primary">
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Updated At</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key=>$item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $item ->name }}</td>
                                            <td class="text-center"><img class="image-responsive img-thumbnail" src="{{ asset('uploads/item/'.$item->image) }}" style="height: 100px; width: 150px" alt="{{ $item ->image }}"></td>
                                            <td class="text-center">{{ $item ->category->name }}</td>
                                            <td class="text-center">{{ $item ->description }}</td>
                                            <td class="text-center">{{ $item ->price }}</td>
                                            <td class="text-center">{{ $item ->created_at }}</td>
                                            <td class="text-center">{{ $item ->updated_at }}</td>
                                            <td class="text-center">
                                               <a class="btn btn-info btn-sm" href="{{ route('item.edit', $item->id) }}"><i class="material-icons">mode_edit</i></a>
                                            </td>
                                            <td class="text-center">
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy',  $item->id ) }}" method="POST">
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