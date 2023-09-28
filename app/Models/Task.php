<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $validated)
 * @method static paginate()
 */
class Task extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'is_done',
        'project_id'
    ];

    protected $casts=[
        'is_done'=>'boolean'
    ];

    protected  $hidden=[
        'updated_at'
    ];

    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class,'creator_id');
    }

    public static function booted(): void
    {
        static::addGlobalScope('member', function ($builder) {
            $builder->where(function ($query) {
                $query->where('creator_id', Auth::id())
                    ->orWhereIn('project_id', Auth::user()->memberships->pluck('id'));
            });
        });
    }


    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
