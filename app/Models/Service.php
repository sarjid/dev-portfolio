<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;



    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Get all of the pricings for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pricings(): HasMany
    {
        return $this->hasMany(Pricing::class);
    }


    /**
     * Get all of the portfolios for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }
}