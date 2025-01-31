<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Team extends Model
{
    use HasFactory;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'social_links' => 'array',
    ];




    // public function getImageAttribute($value)
    // {
    //     return url($value);
    // }

    // protected function image($value): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => dd($value)
    //     );
    // }

    // public function getImageAttribute()
    // {
    //     return url($this->image);
    // }
}