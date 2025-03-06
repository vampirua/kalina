<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Масив заповнюваних полів для масового призначення.
     */
    protected $fillable = [
        'name',
        'slug',
    ];
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

}
