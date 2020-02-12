@extends('layouts.fontEnd')

@section('content')





    <!-- BANNER STRAT -->

    <div class="banner inner-banner align-center" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}');">

        <div class="container">

            <section class="banner-detail">

                <h1 class="banner-title">{{ $page_title }}</h1>

                <div class="bread-crumb right-side">

                    <ul>

                        <li><a href="{{ route('home') }}">Home</a>/</li>

                        <li><span>{{ $page_title }}</span></li>

                    </ul>

                </div>

            </section>

        </div>

    </div>

    <!-- BANNER END -->





    <section class="ptb-50 ptb-xs-30 gray-bg">

        <div class="container">

            <div class="row testimonial">

                <div class="col-md-12">

                    <p>{!! $basic->$filed_name !!}</p>

                </div>

                @if($ad4 != null)

                    <div class="visible-sm visible-md visible-lg hidden-xs">

                        @if($ad4->advert_type == 1)

                            <a href="{{ $ad4->link }}"  target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad4->val1 }}" alt="{{ $ad4->title }}"></a>

                        @else

                            {!! $ad4->val2 !!}

                        @endif

                    </div>

                @endif

            </div>

        </div>

    </section>

@endsection