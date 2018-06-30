<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\kriteria;
use Validator;

class adminKriteriaSetting extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = kriteria::all();
        return view("admin.kriteria")->with('Dkriteria',$kriteria);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'kriteria'=>'required',
            'jenis'=>'required|alpha',
            'bobot'=>'required|numeric|between:1,5'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $kriteria = kriteria::create([
          'kriteria'=>$request->kriteria,
          'jenis'=>$request->jenis,
          'bobot'=>$request->bobot,
        ]);

        if($kriteria == false){
          return redirect()->route('view-kriteria')->with('error', 'Insert Data Kriteria Failed');
        }
        return redirect()->route('view-kriteria')->with('success', 'Insert Data Kriteria Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
            'kriteria'=>'required',
            'jenis'=>'required|alpha',
            'bobot'=>'required|numeric|between:1,5'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $kriteria = kriteria::where('id', $id)->first();
        if(!isset($kriteria)){
          return redirect()->route('view-kriteria')->with('error', 'The id does not exist');
        }

        $kriteria = kriteria::where('id',$id);
        $kriteria->update([
          'kriteria'=>$request->kriteria,
          'jenis'=>$request->jenis,
          'bobot'=>$request->bobot,
        ]);

        if($kriteria == false){
          return redirect()->route('view-kriteria')->with('error', 'Update Data Kriteria Failed');
        }
        return redirect()->route('view-kriteria')->with('success', 'Update Data Kriteria Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $kriteria = kriteria::find($id)->first();

      if(!isset($kriteria)){
        return redirect()->route('view-kriteria')->with('error', 'The id does not exist');
      }

      $kriteria = kriteria::where('id',$id)->delete();
      
      return redirect()->route('view-kriteria')->with('success', 'Delete Kriteria Success');
    }
}
