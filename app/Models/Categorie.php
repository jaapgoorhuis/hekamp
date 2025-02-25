<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Categorie extends model implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, interactsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'categories';

    protected $fillable = [
        'route',
        'title_nl',
        'title_de',
        'title_en',
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
        'is_active',
        'header_image',
        'categorie_text_de',
        'categorie_text_en',
        'categorie_text_nl',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaCollection('files')
            // ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategorie::class, 'category_id', 'id');
    }

}
