<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    public $timestamps = false; // Отключаем стандартные метки времени

    protected $fillable = [
        'code',
        'plan_reference',
        'first_name',
        'last_name',
        'investment_house',
        'last_operation',
    ];
    public function setLastOperationAttribute($value)
    {
        $this->attributes['last_operation'] = now();
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
