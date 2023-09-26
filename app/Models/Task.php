<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class Task extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'is_done'
    ];

    protected $casts=[
        'is_done'=>'boolean'
    ];

    protected  $hidden=[
        'updated_at'
    ];
}
