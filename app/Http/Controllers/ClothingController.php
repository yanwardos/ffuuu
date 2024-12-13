<?php

namespace App\Http\Controllers;

use App\Models\Clothing;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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


        if ($validator->fails()) {
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

        if (!$clothing->save()) {
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

    public function storeImagePreview(Request $request, Clothing $clothing)
    {
        // cek apakah file ada
        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => '',
                'message' => 'Form input error.',
                'data' => [
                    'formError' => 'Image file not specified.'
                ]
            ], 422);
        }

        // jika file ada cek apakah clothing valid

        // cek folder
        if (!File::exists(env('PATH_CLOTHING_GALLERY'))) {
            File::makeDirectory(env('PATH_CLOTHING_GALLERY'));
        }

        // simpan file
        $fileExt = $request->file('file')->getClientOriginalExtension();
        $filenameHash = uniqid("preview_" . time());
        $filenameWithExt = $filenameHash . '.' . $fileExt;

        if (!$request->file('file')->storeAs(env('PATH_CLOTHING_GALLERY'), $filenameWithExt)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed storing file.'
            ], 400);
        }

        // simpan ke database
        $clothing->addPreviewImagePath($filenameWithExt);

        if (!$clothing->save()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed saving clothing data.'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Clothing updated.',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Clothing $clothing)
    {
        return view('admin.clothing.detail', compact('clothing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Clothing $clothing)
    {
        return view('admin.clothing.edit', compact('clothing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clothing $clothing)
    {
        $validator = Validator::make($request->all(), [
            'clothingName' => 'required|string|max:255|min:5',
            'clothingDescription' => 'required|string|max:500',
            'genderType' => 'required|in:1,2,3'
        ]);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        if (!$clothing) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'messageError' => 'Gagal menyimpan data pakaian.'
                ]);
        }

        $clothing->name =  $request->input('clothingName');
        $clothing->description =  $request->input('clothingDescription');
        $clothing->genderType = $request->input('genderType');

        if (!$clothing->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'messageError' => 'Gagal menyimpan data pakaian.'
                ]);
        }


        return redirect()
            ->to(route('clothing.show', $clothing->id))
            ->with('messageSuccess', 'Berhasil mengubah data model pakaian.');
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

    public function deletePreview(Clothing $clothing, Request $request)
    {
        // echo File::exists(env('PATH_CLOTHING_GALLERY'));

        // dd($request->all());

        $filePath = $request->imgPath;
        $filePath = explode(env('PATH_CLOTHING_GALLERY'), $filePath);
        $fileName = $filePath[sizeof($filePath) - 1];
        $fileName = str_replace('/', '', $fileName);
        $filePath = env('PATH_CLOTHING_GALLERY') . '/' . $fileName;

        if (!File::delete($filePath)) {
        }

        $clothing->deletePreviewImagePath($fileName);

        if (!$clothing->save()) {
        }

        return redirect()
            ->to(route('clothing.edit', $clothing));
    }

    public function storeFbx(Request $request, Clothing $clothing)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->to(route('clothing.edit', $clothing))
                ->withErrors([
                    'messageError' => 'File tidak ditemukan'
                ]);
        }

        if (!File::exists(env('PATH_CLOTHING_FBX'))) {
            File::makeDirectory(env('PATH_CLOTHING_FBX'));
        }

        // return redirect()
        //     ->to(route('clothing.edit', $clothing))
        //     ->with('messageSuccess', 'Berhasil menambahkan file fbx.');

        // simpan file
        $fileExt = $request->file('file')->getClientOriginalExtension();
        $fileName = $request->file('file')->getClientOriginalName();
        $filenameHash = uniqid("fbx_" . time());
        $filenameWithExt = $filenameHash . '.' . $fileExt;

        if(!$request->file('file')->move(env('PATH_CLOTHING_FBX'), $filenameWithExt)){
            return redirect()
                ->to(route('clothing.edit', $clothing))
                ->withErrors([
                    'messageError' => 'Error upload'
                ]); 
        }
        
        return redirect()
            ->to(route('clothing.edit', $clothing))
            ->with('messageSuccess', 'Berhasil menambahkan file fbx.');
    }

    public function deleteFbx(Clothing $clothing, Request $request) {}
}
