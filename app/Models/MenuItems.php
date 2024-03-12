<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MenuItems extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'menu';

    protected $fillable = [
        'title',
        'page_id',
        'order_id',
        'parent_id',
        'is_dropdown_parent',
        'show_footer',
        'show_header',
        'show_menu',
    ];

    public function pages(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}
