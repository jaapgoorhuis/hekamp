<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProjectCategories extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'project_category_id',
        'tumbnail',
        'small_description',
        'description',
    ];

    public function projectImages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectImages::class, 'project_id', 'id')->orderBy('order_id', 'desc');
    }
}
