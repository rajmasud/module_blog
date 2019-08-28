<?php
namespace Modules\Blog\Models\Panels\Actions;

//-------- services --------
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\RouteService;

//-------- bases -----------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

class RateIt extends XotBasePanelAction{

	public $name='rate'; //name for calling Action
	public $rows;

	public $onItem = true; //onlyContainer
	public function setRows($rows){
		$this->rows=$rows;
	}

	public function setRow($row){
		$this->row=$row;
	}

	public function btn($params=[]){
		extract($params);
		$url=RouteService::urlRelated(
			[
				'row'=>$row,
				'related_name'=>'my_rating',
				'act'=>'index_edit',
			]
		);

		return '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="rate it" data-href="'.url($url).'">
			<span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
		</button>';
	}

	//-- Perform the action on the given models.
	public function handle(){ //devo aggiungere 77
		$stato=request()->stato;
		$row=$this->rows;
		$row->last_stato=$stato;
		$row->save();
		MyLog::log($row);
		die(redirect()->back());
		//ddd($this->rows);
	}//end handle

	
}