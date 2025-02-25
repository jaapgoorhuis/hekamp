<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use App\Output\Concerns\InteractsWithSymbols;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;


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
        'meta_title_nl',
        'meta_title_de',
        'meta_title_en',
        'meta_description_nl',
        'meta_description_de',
        'meta_description_en',
        'meta_keywords_nl',
        'meta_keywords_de',
        'meta_keywords_en',
        'meta_robots',
        'is_removable',
        'is_vissible',
        'is_active',
        'header_image',
        'header_text',
        'show_header',
        'show_footer',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaCollection('files')
            // ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItems::class);
    }

}
