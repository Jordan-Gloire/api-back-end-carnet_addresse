<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnet extends Model
{
    /** @use HasFactory<\Database\Factories\CarnetFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "numero",
        "address",
        "birthdate",
        "status",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}