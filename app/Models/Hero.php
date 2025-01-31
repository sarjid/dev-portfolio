<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;



    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['img_url_one', 'img_url_two'];

    protected function imgUrlOne(): Attribute
    {
        return Attribute::make(
            get: fn () => url($this->image_one)
        );
    }

    protected function imgUrlTwo(): Attribute
    {
        return Attribute::make(
            get: fn () => url($this->image_two)
        );
    }
}