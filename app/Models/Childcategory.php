<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    use HasFactory;
     protected $fillable = ['category_id','subcategory_id','childcategory_slug','childcategory_name'];
}
