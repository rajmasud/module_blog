@guest
<h3>Before Login </h3>
<button class="btn btn-social btn-facebook" onclick="location.href='{{ url($lang.'/login/facebook') }}';">
    <i class="fab fa-facebook-square fa-3x  "></i>
</button>

@endguest
@auth

@extends('pub_theme::layouts.app')
@section('page_heading',trans($view.'.rate'))
@section('content')
@include('theme::includes.flash')
<div class="page-wrapper">
<section class="create-page inner-page">




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

<button type="submit" class="btn btn-lg btn-danger">Vota !</button>
    {!! Form::close() !!}




</section>
</div>

@endsection
@endauth
