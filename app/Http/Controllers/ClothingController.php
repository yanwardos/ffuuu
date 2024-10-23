<?php

namespace App\Http\Controllers;

use App\Models\Clothing;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClothingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clothings = Clothing::all();

        return view('admin.clothing.all', compact('clothings'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clothing.create');
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
            'clothingName' => 'required|string|max:255|min:5',
            'clothingDescription' => 'required|string|max:500',
            'genderType' => 'required|in:1,2,3'
        ]);
        

        if($validator->fails()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }

        $clothing = new Clothing([
            'name' => $request->input('clothingName'),
            'description' => $request->input('clothingDescription'),
            'genderType' => $request->input('genderType')
        ]);

        if(!$clothing->save()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal menambahkan model pakaian.'
            ]);
        }

        return redirect()
        ->to(route('clothing.all'))
        ->with('messageSuccess', 'Berhasil menambahkan model pakaian.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
