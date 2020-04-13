@guest
<h3>Before Login </h3>
<button class="btn btn-social btn-facebook" onclick="location.href='{{ url($lang.'/login/facebook') }}';">
    <i class="fab fa-facebook-square fa-3x  "></i>
</button>

@endguest
@auth

@extends('pub_theme::layouts.app',['body_style'=>'padding-top:72px;'])
@section('page_heading',trans($view.'.rate'))
@section('content')
<div class="page-wrapper">
    <section class="create-page inner-page">
        @include('theme::includes.flash')

    <a href="{{ Panel::get($row)->showUrl() }}" class="btn btn-info">
        <i class="fas fa-step-backward"></i> Back to {{ $row->title }}
    </a>
    <div class="text-center mt-12">
    <h2>Vota per </h2>
    <h3>{{ $row->title }}</h3>
<h4>{{ $row->subtitle }}</h4>
    </div>
<hr/>

{!! Form::model($row,['url'=>Request::fullUrl() ]) !!}
@method('put')
{!! Form::bsRatingMultiVue('ratings') !!}
{{--

<p>
    <div class="rateit" data-rateit-value="2.5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>(2.5) 10 Votes
</p>

{!! Form::bsSubmit('vota') !!}
<rating-one value="3.23" title="qualita"></rating-one>
--}}
<div class="text-center mt-12">
    <br>
<button type="submit" class="btn btn-lg btn-danger">Vota !</button>
</div>
    {!! Form::close() !!}




</section>
</div>

@endsection
@endauth
