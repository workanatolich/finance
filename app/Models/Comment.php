<?php

namespace App\Models;

use App\Services\QueryBuilderService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function commentable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
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
