<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;


class QueryBuilderService extends Model
{
    public static function add($fields, $class, $hidden_fields = null) {
        $essence = new $class;

        $essence -> fill($fields);
        if(!is_null($hidden_fields)) {
            $essence -> fill($hidden_fields);
        }

        $essence -> save();

        return $essence;
    }

    public static function edit($fields, $current_object, $hidden_fields = null) {
        $essence = $current_object;

        $essence -> update($fields);

        if(!is_null($hidden_fields)) {
            $essence -> update($hidden_fields);
        }
    }

    public static function remove($class) {
        $essence = new $class;
        $essence -> delete();
    }
}
