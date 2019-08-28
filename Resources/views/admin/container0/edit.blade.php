@extends('adm_theme::layouts.app')
@section('page_heading','Update '.$container0->title.' - '.$item0->title)

@section('content')
@include('theme::includes.flash')
<style>
.panel-title .fa {
  transition: .3s transform ease-in-out;
}
.panel-title .collapsed .fa {
  transform: rotate(90deg);
}
</style>
<div class="row">
	<div class="col-md-10">
		<div class="nav-tabs-custom">
			@include($view.'.nav')
			<div class="tab-content">
				[{{ get_class($row) }}]
				[Up:{{ $row->update_url }}]
				{!! Form::bsOpen($row,'update') !!}
				
				{{ Form::bsText('title') }}
				<div class="form-group">
					<label for="title" class="col-md-4 control-label">Url:</label>
					<div class="col-md-6">	
						{{ $row->url }}
					</div>
				</div>
				<br style="clear:both" />
				{{ Form::bsText('subtitle') }}
				@php
					//ddd($row->getColumns()); //undefined method 
					//ddd($row->getFillable());
					//ddd($row->all());
					/*
					$columns=$row->getConnection()->getDoctrineSchemaManager()->listTableDetails($row->getTable());
					$columns=$columns->getColumns();
					//echo '<table >';
					$i=0;
					foreach($columns as $k=>$col){
						if($i++>3) break;
						$input_type='bs'.(string)($col->getType());
						$input_name=(string)($col->getName());
						if($input_type=='bsString'){ //devo crearli per ora solo tampone
							$input_type='bsText';
						}
						echo Form::$input_type($input_name);
					}
					*/
					foreach($row->getFillable() as $input_name){
						$input_type=$row->getConnection()->getDoctrineColumn($row->getTable(),$input_name)->getType();//->getName();
						$input_type='bs'.(string)$input_type;
						if($input_type=='bsString'){ //devo crearli per ora solo tampone
							$input_type='bsText';
						}
						echo Form::$input_type($input_name);

					}
					//echo '</table>';
					//ddd($row->getFields());
				@endphp
				{{--
				{!! $row->linkedFormFields() !!}
				--}}
				<hr style="clear:both" />
				{!! Form::bsTinymce('txt') !!}
				<br style="clear:both" /><br style="clear:both" />
				<fieldset>
					<legend>primary image</legend>
					{!! Form::bsUnisharpFileMan('image_src') !!}
					{{ Form::bsText('image_alt') }}
					{{ Form::bsText('image_title') }}
				</fieldset>
				{{--
				<fieldset>
					<legend>SEO</legend>
					{{ Form::bsText('guid') }}
					<div class="col-md-6">
					{{ Form::bsTextarea('meta_description') }}
					</div>
					<div class="col-md-6">
					{{ Form::bsTextarea('meta_keywords') }}
					</div>
					

				</fieldset>
				--}}

				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									<i class="fa fa-chevron-down pull-right"></i>
									SEO
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								{{ Form::bsText('guid') }}
								{{ Form::bsTextarea('meta_description') }}
								{{ Form::bsTextarea('meta_keywords') }}
							</div>
						</div>
					</div>
				</div>


				{{ Form::bs3Submit('Salva e continua') }}
				{!! Form::close() !!}
				<br style="clear:both" />
				
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<span>
		created_at {{ $row->created_at }}<br/>
		updated_at {{ $row->updated_at }}<br/>
		</span>
	</div>
</div>
@endsection