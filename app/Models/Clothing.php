<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Clothing extends Model
{
    use HasFactory;
    protected $table = 'clothings';

    protected $fillable = [
        'name',
        'description',
        'genderType'
    ];

    public function getGenderType()
    {
        if (!isset($this->genderType)) return 3;
        if (is_null($this->genderType)) return 3;

        return $this->genderType;
    }

    public function getGenderTypeName()
    {
        switch ($this->getGenderType()) {
            case 1:
                return 'Pria';
                break;
            case 2:
                return 'Wanita';
                break;
            case 3:
                return 'Unisex';
                break;
        }
    }

    public function getFbxFilePaths(){
        if (!isset($this->fbxFilePath)) return [];
        if (is_null($this->fbxFilePath)) return [];

        $files = json_decode($this->fbxFilePath);
        return $files;
    }

    public function getPreviewImagePaths(){
        if (!isset($this->previewImagePaths)) return [];
        if (is_null($this->previewImagePaths)) return [];

        $files = json_decode($this->previewImagePaths);
        return $files;
    }

    public function getPreviewImageFullPaths(){ 
        $files = $this->getPreviewImagePaths();

        $fullPath = [];
        foreach ($files as $file) {
            $url = URL::to(env("PATH_CLOTHING_GALLERY").'/'.$file);
            array_push($fullPath, $url);
        }

        return $fullPath;
    }

    public function addPreviewImagePath($fileName){
        $current = $this->getPreviewImagePaths();
        array_push($current, $fileName);
        $this->previewImagePaths = json_encode($current);

        return $current;
    }

    public function deletePreviewImagePath($fileName){
        $current = $this->getPreviewImagePaths();
        
        if(($key = array_search($fileName, $current)) !== false){
            array_splice($current, $key, 1);
        }

        $this->previewImagePaths = json_encode($current);

        return $current;
    }
}
