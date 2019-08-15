<?php
namespace Modules\Blog\Models\Panels\Actions;


//-------- models -----------
//use Modules\Progressioni\Models\Schede;
//use Modules\Progressioni\Models\Coeff;
//use Modules\Progressioni\Models\CriteriEsclusione;
//-------- services --------
use Modules\Extend\Services\ArrayService;
//-------- bases -----------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

class RateIt extends XotBasePanelAction{

	public $name='rate'; //name for calling Action
	public $rows;

	/**
 	* Indicates if this action is only available on the resource index view.
 	*
 	* @var bool
 	*/
	public $onlyOnIndex = true; //onlyContainer

	/**
 	* Indicates if this action is only available on the resource detail view.
 	*
 	* @var bool
 	*/
	//public $onlyOnDetail = true; //onlyItem

	/*
	public function __construct($data){
		$this->data=$data;
	}
	*/
	public function setRows($rows){
		$this->rows=$rows;
	}


	public function btn(){
		/*
		$request=\Request::capture();
		$url=$request->fullUrlWithQuery(['_act'=>$this->name]);
		return '<a href="'.$url.'" class="btn btn-secondary">
			<i class="far fa-file-excel"></i>&nbsp;
			</a>';
		*/
			/*
		$parz=[];
	$parz['container0']=$row->post_type;
	$parz['item0']=$row->guid;
	$parz['container1']='rating';
	$rating_url=route('container0.container1.index_edit',$parz);
		*/	
		return '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="rate it" data-href="{{ $rating_url }}">
			<span class="font-white"><i class="fa fa-star"></i> Vota !</span>
		</button>';
	}

	//-- Perform the action on the given models.
	public function handle(){
		//to do
	}//end handle

}