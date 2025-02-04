<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
                return 'pria';
                break;
            case 2:
                return 'wanita';
                break;
            case 3:
                return 'unisex';
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
}
