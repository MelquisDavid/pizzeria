<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function price()
    {
        return $this->ingredients()->pluck('price')->reduce(function ($carry,$item){
            return $carry + $item;
        },0);

    }

    public function scopeName(Builder $query, $value){
        $query->where('name', 'LIKE',"%{$value}%");
    }
}

