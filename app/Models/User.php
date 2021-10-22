<?php

namespace App\Models;

use App\Services\QueryBuilderService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accounts() {
        return $this->hasMany(Account::class);
    }

    public function category() {
        return $this->hasMany(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function subcategory() {
        return $this->hasMany(Subcategory::class);
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
