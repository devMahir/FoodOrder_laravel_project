@extends('layouts.app')

@section('title','Reservations')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partial.msg')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">All Reservations</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table" style="width:100%">
                                <thead class="text-primary">
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Time and Date</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $key=>$reservation)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $reservation->name }}</td>
                                            <td class="text-center">{{ $reservation->email }}</td>
                                            <td class="text-center">{{ $reservation->phone }}</td>
                                            <td class="text-center">{{ $reservation->date_and_time }}</td>
                                            <td class="text-center">{{ $reservation->massage }}</td>
                                            <td class="text-center">
                                                @if ($reservation->status == true)
                                                    <span style="background: #5CB85C; color: white; padding: 6px; border-radius: 6px;">Confirmed</span>
                                                @else
                                                    <span style="background: #F0AD4E; color: white; padding: 6px; border-radius: 6px;">Not Confirmed Yet</span>
                                                @endif
                                            </td>


                                            <td class="text-center">
                                                @if (  $reservation->status  == false )   
                                                   {{--  <a href="" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a> --}}
                                                    <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-info btn-sm"><i class="material-icons">done</i></button>
                                                    </form>                    
                                                @endif
                                            
                                                <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST">
                                                    @csrf
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