@php
	Theme::add('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js');
	Theme::add('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js');
	//$row->createJsonFileChart();
	Theme::add('theme/js/dash.js');
@endphp
<div class="col-md-12">
@component('adm_theme::layouts.components.blade.widget')
@slot('title')
	<a href="{{$area->url}}">{{ $area->area_define_name }}</a>
@endslot
@slot('body')
<div class="row">
	<div class="col-md-6">
		<canvas id="myChart" style="height:400px;"></canvas>
	</div>
	
	<div class="col-md-6">
		<p class="text-center">
			<strong>Things</strong>
		</p>
		@php
			//ddd($row->types()->get());
			//ddd(get_class($row));
		@endphp
		{{-- get_class($row) --}}

		@foreach($row->postTypes()->get() as $type)
		<div class="col-lg-3">
			<div class="panel panel-default"> 
				<div class="panel-heading">
				<a href="{{ url('admin/blog/'.App::getLocale().'/'.$type->guid) }}">{{ $type->guid }}</a>:<b>&nbsp;{{ number_format($type->post_archive_count,0,",","'") }}</b> 
				</div>

				
			</div>
		</div>
		@endforeach
		
	</div>
	<!-- /.col -->
</div>
@endslot
@slot('footer')
@endslot
@endcomponent
</div>