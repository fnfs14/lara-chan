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
    public function index(Request $r){ // get all of main task
		$breadcrumb = "Index";
		$parent = 0;
        return view('task.index', compact('breadcrumb','parent'));
	}
    public function show(Request $r, $id){ // get all of sub task
		$data = _task::findOrFail($id);
		$breadcrumb = $this->_breadcrumb($id);
		$parent = $id;
        return view('task.index', compact('breadcrumb','parent','data'));
	}
	public function data(Request $r, $parent, $offset){ // return data based on it parent
		$_col = "parent";
		if(isset($r->perc)){ // get specific data based on it primary key
			$_col = "id";
		}
		$data = _task::select('task.task.*')
			->where($_col,$parent)
			->where('owner',Auth::user()->id)
			->orderBy('created_at','DESC')
			->limit(5)
			->offset($offset)
			->get();
		$count = 1;
		$result = [];
		foreach($data as $a){
			$child = _task::where('parent',$a->id)->count();
			$result[] = [
				'id' => $a->id,
				'title' => $a->title,
				'perc' => $a->percentage,
				'status_desc' => $a->status_desc,
				'child' => $child
			];
		}
		return json_encode($result);
	}
	public function create(Request $r){ // form create task
		$breadcrumb = "Create";
		$parent = "0";
		if(isset($_REQUEST['t'])){
			$parent = _task::findOrFail($_REQUEST['t'])->id;
		}
        return view('task.create', compact('breadcrumb','parent'));
	}
	public function store(Request $r){ // store submitted task
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
		if($r->parent!="0"){ // update progress
			$url = "/".$r->parent;
			$this->autoUpdatePerc($r->parent);
		}
		$this->_flashStore($query,$r->title);
		return redirect('task'.$url);
	}
	public function autoUpdatePerc($id){ // update progress
		// if($id!=0){
			$data = _task::findOrFail($id);
			$child = _task::where('parent', $id);
			$amount = $child->count();
			$perc = $child->sum('percentage');
			if($amount!=0){
				$data->update([
					'percentage' => round($perc/$amount)
				]);
			}
			if($data->parent!='0'){
				$parent = _task::findOrFail($data->parent);
				$this->autoUpdatePerc($data->parent);
			}
		// }
	}
	public function edit(Request $r, $id){ // form edit task
		$data = _task::findOrFail($id);
		$breadcrumb = "Edit <b>" . $data->title . "</b>";
        return view('task.edit', compact('data','breadcrumb'));
	}
	public function update(Request $r, $id){ // update submitted task
		$data = _task::findOrFail($id);
        $query = $data->update([
            'title' => $r->title,
            'description' => $r->description
        ]);
		$this->_flashUpdate($query,$data->title);
		return redirect('task/'.$id);
	}
	public function destroy($id,$i=NULL){ // delete selected task
		$data = _task::findOrFail($id);
        $child = _task::where('parent', $id)->get();
		foreach($child as $a){ // delete all sub task of selected task
			$checkGrandChild = _task::where('parent',$a->id)->first();
			if($checkGrandChild!=null){
				$this->destroy($a->id,1);
			}				
			_task::destroy($a->id);
		}
        $query = _task::destroy($id);
		if($data->parent=="0"){
			$url = "";
		}else{ // update progress if not main task that deleted
			$url = "/".$data->parent;
			$this->autoUpdatePerc($data->parent);
		}
		if($i==NULL){
			$this->_flashDelete($query,$data->title);
			return redirect('task'.$url);
		}
	}
	public function updatePerc($id,$perc){ // update progress selected task
		$data = _task::findOrFail($id);
        $query = $data->update([
            'percentage' => round($perc)
        ]);
		if($data->parent!="0"){
			$this->autoUpdatePerc($data->parent);
		}
		return round($perc);
	}
	public function getDesc($id){ // get description of selected task
		$data = _task::findOrFail($id);
		return $data;
	}
}