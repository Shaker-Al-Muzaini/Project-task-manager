<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected  $fillable=[
        'title'
    ];

    protected  $hidden=[
        'updated_at',
        'created_at'
    ];


    public function  tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }
    public function creator():BelongsTo
    {
        return  $this->belongsTo(User::class,'creator_id');
    }
    public static function booted(): void
    {
        static::addGlobalScope('creator',static fn($builder)
        => $builder->where('creator_id', Auth::id()));
    }
}
