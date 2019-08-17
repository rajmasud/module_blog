<?php
namespace Modules\Blog\Models\Panels\Actions;


//-------- models -----------
//use Modules\Progressioni\Models\Schede;
//use Modules\Progressioni\Models\Coeff;
//use Modules\Progressioni\Models\CriteriEsclusione;
//-------- services --------
use Modules\Extend\Services\ArrayService;
use Modules\Extend\Services\RouteService;

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
	//public $onlyOnIndex = true; //onlyContainer
	public $onItem = true; //onlyContainer
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

	public function setRow($row){
		$this->row=$row;
	}

	public function btn($params=[]){
		extract($params);
		//se act lo metto a update posso creare un form
		/*
		$url=RouteService::urlAct(
			[
				'row'=>$row,
				'act'=>'show',
				'query'=>[
					'_act'=>$this->name,
					//'stato'=>5,
				],
			]);
		*/
		$url=RouteService::urlRelated(
			[
				'row'=>$row,
				'related_name'=>'my_rating',
				'act'=>'index_edit',
			]
		);

		///*
		//$request=\Request::capture();
		//$url_yes=$request->fullUrlWithQuery(['_act'=>$this->name,'stato'=>2]);
		//$url_no=$request->fullUrlWithQuery(['_act'=>$this->name,'stato'=>3]);
		return '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="rate it" data-href="'.url($url).'">
			<span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
		</button>';

		/*
		return '<a href="'.$url_yes.'" class="btn btn-success">
			<i class="far fa-thumbs-up"></i>&nbsp;Approva

			</a>
			<a href="'.$url_no.'" class="btn btn-danger">
			<i class="far fa-thumbs-down"></i>&nbsp;Nega
			</a>
			';
		//*/
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


	public function btn_o(){
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

	
}