@extends('layouts.app')

@section('title','Dashboard')


@push('css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">content_paste</i>
            </div>
            <p class="card-category">Category / Items</p>
            <h3 class="card-title">{{$categoryCount }} / {{ $itemCount }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-info">info</i>
              <a href="javascript:;">Total Categories and Items</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">slideshow</i>
            </div>
            <p class="card-category">Slider Count</p>
            <h3 class="card-title">{{$sliderCount}}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i>
              <a href="{{ route('slider.index') }}">Get More Details....</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">chrome_reader_mode</i>
            </div>
            <p class="card-category">Reservation</p>
            <h3 class="card-title">{{ $reservation->count() }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">local_offer</i> Not Confirm Reservation
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">message</i>
            </div>
            <p class="card-category">Contact</p>
            <h3 class="card-title">{{ $contactCount }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">update</i> Just Updated
            </div>
          </div>
        </div>
      </div>
    </div>

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
                              <th class="text-center">Phone</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Action</th>
                          </thead>
                          <tbody>
                              @foreach ($reservations as $key=>$reservation)
                                  <tr>
                                      <td class="text-center">{{ $key + 1 }}</td>
                                      <td class="text-center">{{ $reservation->name }}</td>
                                      <td class="text-center">{{ $reservation->phone }}</td>
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