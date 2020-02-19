{{--
{{  Form::bsOpen($row,'update')  }}
    --}}
{!! Form::model($row,['url'=>Request::fullUrl() ]) !!}
	@method('put')
{!! Form::bsRating('ratings') !!}
{!! Form::bsSubmit('vota') !!}
{!! Form::close() !!}
{{ Theme::showStyles(false) }}
{{ Theme::showScripts(false) }}
