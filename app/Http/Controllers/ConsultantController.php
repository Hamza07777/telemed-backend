<?php

namespace App\Http\Controllers;

use App\Models\consultant;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=consultant::all();
        return view('pages.consultants',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {

        if($r->status){
            $status=1;
        }else{
            $status=0;
        }

        $cons=new consultant();
        $cons->name=$r->name;
        $cons->email=$r->email;
        $cons->speciality=$r->speciality;
        $cons->commission=$r->commission;
        $cons->status=$status;
        $cons->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\consultant  $consultant
     * @return \Illuminate\Http\Response
     */
    public function show(consultant $consultant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\consultant  $consultant
     * @return \Illuminate\Http\Response
     */
    public function edit(consultant $consultant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\consultant  $consultant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r,$consultant)
    {

      dd($consultant);
      $data=['name'=>$r->name];
      consultant::update($data)->where('id',$consultant);
      return back('Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\consultant  $consultant
     * @return \Illuminate\Http\Response
     */
    public function destroy(consultant $consultant)
    {
        //
    }
}
