<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['subcategory_name','subcat_slug','category_id'];


    public function category(){
    	return $this->belongsTo(Category::class);
    }

   

}
