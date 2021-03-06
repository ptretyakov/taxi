<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Taxi;
use App\Addinfo;
use App\Http\Requests\TaximaindataRequest;

class TaxiController extends Controller {

	public function index()
	{
		$taxis = Taxi::all();

		return view('admin.taxi.index' , compact('taxis'));
	}


	public function create()
	{
		return view('admin.taxi.create');
	}


	public function store(TaximaindataRequest $req){
		Taxi::create($req->all());
		return redirect()->route('admin.taxi.index')->with('success' , 'Новое такси успешно добавлено');
	}


	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		$taxi 		= Taxi::find($id);		
		if($taxi){			
			$addinfos = Addinfo::where('taxi_id' , $taxi->id)->get();

			return view('admin.taxi.edit' , compact('taxi' , 'addinfos'));
		}else{
			return redirect()->back()->with('error' , 'Такси не найдено в базе данных');
		}
	}


	public function update($id , TaximaindataRequest $request)
	{
		$taxi = Taxi::find($id);

		if($taxi){		
			$taxi->fill($request->input())->save();
			return redirect()->back()->with('success' , 'Изменения сохранены!');
		}
	}

	public function destroy($id)
	{
		$taxi = Taxi::find($id);
		if($taxi){			
			$taxi->delete();
			return redirect()->back()->with('success' , 'Такси успешно удалено');
		}else{
			return redirect()->back()->with('error' , 'Такси не найдено в базе данных');
		}
	}

}
