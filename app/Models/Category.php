<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort_order',
    ];

    public function menu()
    {
        // Menuモデルの作成とuseはまだ
        return $this->hasMany(Menu::class);
    }
}
