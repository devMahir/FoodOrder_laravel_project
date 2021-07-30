@extends('welcome')

@push('homecss')
    @foreach($sliders as $key=>$slider)
    <style>
        .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{$key + 1}}) .item
        {
            background: url('{{asset('uploads/slider/'.$slider->image)}}');
            background-size: cover;
        }
    </style>
    @endforeach
@endpush

@section('home_slider')

    <section id="header-slider" class="owl-carousel">
        @foreach ($sliders as $key=>$slider)
        <div class="item">
            <div class="container">
                <div class="header-content">
                    <h1 class="header-title">{{ $slider->title }}</h1>
                    <p class="header-sub-title">{{ $slider->sub_title }}</p>
                </div> <!-- /.header-content -->
            </div>
        </div>
        @endforeach
    </section>
@endsection