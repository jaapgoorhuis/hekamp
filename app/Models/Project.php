<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Project extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'order_id',
        'friendly_route',
        'project_category_id',
        'tumbnail',
        'is_vissible',
        'url',
        'small_description',
        'description',
    ];



    public function projectImages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectImages::class, 'project_id', 'id')->orderBy('order_id', 'asc');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(ProjectCategories::class, 'id', 'project_category_id');
    }

    public function projectCategorie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProjectCategories::class, 'project_category_id', 'id');
    }
}
