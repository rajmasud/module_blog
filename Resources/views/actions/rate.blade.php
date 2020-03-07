@guest
<h3 style="color:navy">Prima eseguire Login </h3>

@endguest
@auth
{!! Form::model($row,['url'=>Request::fullUrl() ]) !!}
	@method('put')
{!! Form::bsRatingMulti('ratings') !!}

{!! Form::bsSubmit('vota') !!}
{!! Form::close() !!}
{{ Theme::showStyles(false) }}
{{ Theme::showScripts(false) }}
@endauth
