@extends('adm_theme::layouts.app')
@section('page_heading','Modifica')

@section('content')

{!! Form::bsOpen($row,'update') !!}

{{ Form::bsInteger('post_id') }} 
{{ Form::bsText('type') }}


{{ Form::bsSubmit('Salva e continua') }}
{!! Form::close() !!}
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
@endsection