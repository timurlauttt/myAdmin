<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//models supir
class supir extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'no_wa',
        'description'
    ];
}
