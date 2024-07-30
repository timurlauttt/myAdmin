<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
------ model buat file ----------------
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'type',
        'size',
        'customer_id',
        'status'
    ];
    
    //hubungin ke table customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}

/*
------ model buat file ----------------
*/