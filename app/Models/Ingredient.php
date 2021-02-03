<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name','price'];

    public function pizza()
    {
        return $this->belongsToMany(Pizza::class);
    }

    public function scopeName(Builder $query, $value){
        $query->where('name', 'LIKE',"%{$value}%");
    }

}
