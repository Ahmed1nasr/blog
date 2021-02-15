<?php

namespace App\Services\Wink;

use App\Services\Wink\AbstractWinkModel;
use Cviebrock\EloquentSluggable\Sluggable;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class WinkPage extends AbstractWinkModel
{
    use Sluggable , Uuid;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wink_pages';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'body' => 'string',
        'meta' => 'array',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the renderable page content.
     *
     * @return HtmlString
     */
    public function getContentAttribute()
    {
        return $this->body;
    }
}
