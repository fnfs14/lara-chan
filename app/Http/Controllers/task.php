<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\_task;
use Auth;
use chan;
use route;

class task extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
		$no = 1;
		$status = "0";
		$parent = "0";
		$current_url = url()->current();
		if(route('not_started_yet')==$current_url){
			$breadcrumb = "Not Started Yet";
			$status = chan::split(route('not_started_yet'),'/')[7];
		}else if(route('on_progress')==$current_url){
			$breadcrumb = "On Progress";
			$status = chan::split(route('on_progress'),'/')[7];
		}else if(route('done')==$current_url){
			$breadcrumb = "Done";
			$status = chan::split(route('done'),'/')[7];
		}else if(route('canceled')==$current_url){
			$breadcrumb = "Canceled";
			$status = chan::split(route('canceled'),'/')[7];
		}else{
			$breadcrumb = "All Data";
		}
        return view('task.index', compact('no','breadcrumb','status','parent'));
    }
	public function create(){
		$breadcrumb = "Create";
		$parent = "0";
		if(isset($_REQUEST['t'])){
			$parent = _task::findOrFail($_REQUEST['t']);
		}
        return view('task.form', compact('breadcrumb','parent'));
	}
	public function store(Request $r){
		$this->validate($r, [
			'title' => 'required|max:255'
		]);
		$id = $this->_uuid('task.task','id');
		$query = _task::create([
            'id' => $id,
			'parent' => $r->parent,
			'owner' => Auth::user()->id,
			'title' => $r->title,
			'description' => $r->description,
			'percentage' => 0,
			'created_at' => now(),
			'updated_at' => null,
			'deleted_at' => null,
        ]);
		$url = '';
		if($r->parent!="0"){
			$url = "/".$r->parent;
		}
		$this->_flashStore($query,$r->title);
		return redirect('task'.$url);
	}
	public function show($id){
		$status = "0";
		$parent = _task::findOrFail($id);
		$data = _task::join('task.status','task.task.status','=','task.status.id')
				->select('task.task.*','task.status.description as status_desc')
				->where('owner',Auth::user()->id)
				->where('task.task.id',$id)
				->where('task.task.parent',$id)
				->orderBy('task.task.created_at','ASC')
				->get();
        return view('task.index', compact('parent','data','status'));
	}
	public function data(){
		$length = $_REQUEST['length']; //limit data per page
		$search = strtolower($_REQUEST['search']['value']); //filter keyword
		$start = $_REQUEST['start']; //offset data
		$draw = $_REQUEST['draw'];
		$parent = 0;
		if(isset($_REQUEST['t'])){
			$parent = $_REQUEST['t'];
		}
		$status = "";
		if(isset($_REQUEST['s'])){
			$status = $_REQUEST['s'];
		}
		// query
		$query = _task::join('task.status','task.task.status','=','task.status.id')
			->select('task.task.*','task.status.description as status_desc')
			->where('owner',Auth::user()->id)
			->where('task.task.parent',$parent);
		if($search!=null and $search!=""){ //if filter is on
			$query = $query->where('task.task.title','like',"%$search%");
		}
		if($status!=null and $status!=""){ //if status filter is on
			$query = $query->where('task.task.status','like',"%$status%");
		}
		$query = $query->orderBy('task.task.created_at','ASC'); //additional query
		$recordsTotal = count($query->get()); //count all data by id task
		$query = $query->offset($start) //limit, offset, get all data
			->limit($length)
			->get();
		$recordsFiltered = $recordsTotal;
		//response
		$data = '{
			"draw": '.$draw.',
			"recordsTotal": '.$recordsTotal.',
			"recordsFiltered": '.$recordsFiltered.',
			"data": [';
		$i = 1;
		foreach($query as $a){ //loop
			$data .= '[
			  "'.($i+$start).'",
			  "'.$this->task($a->id,$a->title).'",
			  "'.$this->progress($a->status,$a->status_desc,$a->percentage,$a->id,$a->title).'"
			]';
			if($i!=count($query)){
				$data .= ',';
			}
			$i++;
		}
		$data .= ']}';
		return $data;
	}
	protected function progress($status,$status_desc,$percentage,$id,$title){		
		$result = "";
		if($status == '36c103e0-f147-11e8-9b29-518cf6bb34d6'){
			$result = "<button class='btn btn-warning btn-sm'>$status_desc</button>";
		}elseif($status == '5bf650a0-f387-11e8-b632-df3d8c50d3d9'){
			$result = "<button class='btn btn-danger btn-sm' onclick=canceled('$id','$title')>$status_desc</button>";
		}else{
			$result = "<div class='progress mrg-btm-0'><div class='progress-bar progress-bar-". chan::progress($percentage) ."'data-transitiongoal='$percentage' title='$percentage%'data-toggle='tooltip' data-placement='top'></div></div>";
		}
		return $result;
	}
	protected function task($id,$title){
		$result = "<label><a href='".url('task')."/$id' class='underline'>$title</a></label>";
		return $result;
	}
	public function canceled(Request $r, $id){
		
	}
}
