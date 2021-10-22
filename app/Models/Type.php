<?php

namespace App\Models;

use App\Services\QueryBuilderService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function subcategories() {
        return $this->hasMany(Subcategory::class);
    }


    public static function add($fields) {
        return QueryBuilderService::add($fields, __CLASS__);
    }

    public function edit($fields, $id) {
        QueryBuilderService::edit($fields,self::find($id));
    }

    public function remove() {
        QueryBuilderService::remove(__CLASS__);
    }
}
