<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Models\Category;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
        'category_id',
        'new_item',
        'soon_over',
        'small_serving',
    ];

    

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
