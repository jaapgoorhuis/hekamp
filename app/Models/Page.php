<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Page extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'pages';

    protected $fillable = [
        'title',
        'route',
        'page_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
        'is_removable',
        'is_vissible',
        'is_active',
        'header_image',
        'header_text',
        'show_header',
        'show_footer',
    ];

}
