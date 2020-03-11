@guest
<h3>Before Login </h3>
<button class="btn btn-social btn-facebook" onclick="location.href='{{ url($lang.'/login/facebook') }}';">
    <i class="fab fa-facebook-square fa-3x  "></i>
</button>

@endguest
@auth
@extends('pub_theme::layouts.app')
@section('content')
{!! Form::model($row,['url'=>Request::fullUrl() ]) !!}
	@method('put')
{!! Form::bsRatingMulti('ratings') !!}

{!! Form::bsSubmit('vota') !!}
{!! Form::close() !!}
{{--
    <p>
        <div class="rateit" data-rateit-value="2.5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>(2.5) 10 Votes
    </p>

    --}}
    <rating-one value="3.23" title="qualita"></rating-one>
@endsection
@endauth
