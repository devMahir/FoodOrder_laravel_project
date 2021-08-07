@extends('layouts.app')

@section('title','Create Category')


@push('css')
    
@endpush


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-6 offset-md-2">
                @include('layouts.partial.msg')<br><br><br><br><br>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center">LOG IN</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">password</label>
                                    <input type="password" class="form-control" name="password" required>
                                  </div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <div class="text-center"><br>
                                    <button type="submit" class="btn btn-info">
                                        {{ __('Login') }}
                                    </button>
                                    
                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif 
                                    <a href="{{ route('home') }}" class="btn btn-danger">Back</a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush