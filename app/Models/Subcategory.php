<?php

namespace App\Models;

use App\Services\QueryBuilderService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    use Sluggable;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function account() {
        return $this->morphTo(Account::class, 'accountable');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public static function add($fields) {
        return QueryBuilderService::add($fields, __CLASS__);
    }

    public function edit($fields) {
        QueryBuilderService::edit($fields, __CLASS__);
    }

    public function remove() {
        QueryBuilderService::remove(__CLASS__);
    }
}
