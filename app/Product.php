<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['categories', 'product_name', 'regular_price', 'sale_price', 'short_description', 'long_description', 'color', 'size', 'main_image', 'tags', 'stock', 'sku_code', 'manage_stock', 'stock_status', 'solid_individually', 'weight', 'is_featured', 'brand', 'related_products', 'sale_price_start_date_time', 'sale_price_end_date_time'];

    public function category(){

        return $this->hasMany(Category::class, 'id');
    	

    }
    protected $casts = [
        'multi_image' => 'array'
    ];
}
