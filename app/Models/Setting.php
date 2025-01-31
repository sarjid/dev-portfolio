<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Setting extends Model
{
    use HasFactory;



    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function settings()
    {
        return $this::all();
    }

    public function getValueAttribute($value)
    {
        // and prepend the base URL if it's not already a full URL
        if ($this->key === 'favicon' || $this->key === 'whatsapp_link' || $this->key === 'logo' || $this->key === 'logo_black' || $this->key === 'logo_white') {
            if (!filter_var($value, FILTER_VALIDATE_URL)) {
                return url($value);
            }
        }

        return $value;
    }
}
