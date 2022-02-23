<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sreports extends Model
{
    use HasFactory;
    protected $fillable = [
        'oil_name',
        'qty',
    ];
}
