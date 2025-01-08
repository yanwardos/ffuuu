<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clothing;
use Illuminate\Http\Request;

class ClothingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clothings = Clothing::all([
            'id', 'name', 'description', 'genderType', 'fbxFilePath', 'previewImagePaths'
        ]);

        foreach ($clothings as $clothing) {
            $clothing->fbxFilePath = $clothing->getFbxFileFullPath();
            $clothing->previewImagePaths = $clothing->getPreviewImageFullPaths();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success getting all clothing.',
            'data' => [
                'clothings' => $clothings
            ]
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
        if(!$clothing){ 
            return response()->json([
                'status' => 'failed',
                'message' => 'Clothing not found.'
            ], 400);
        }

        $clothing->fbxFilePath = $clothing->getFbxFileFullPath();
        $clothing->previewImagePaths = $clothing->getPreviewImageFullPaths();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Success getting all clothing.',
            'data' => [
                'clothing' => $clothing->only([
                    'id', 'name', 'description', 'genderType', 'fbxFilePath', 'previewImagePaths'
                ])
            ]
        ], 200);

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
