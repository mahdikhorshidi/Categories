<?php

declare(strict_types=1);

namespace mahdikhorshidi\categories\Models;

use Spatie\Sluggable\HasSlug;
use Kalnoy\Nestedset\NestedSet;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use mahdikhorshidi\Cacheable\CacheableEloquent;
use mahdikhorshidi\Support\Traits\HasTranslations;
use mahdikhorshidi\Support\Traits\ValidatingTrait;
use mahdikhorshidi\categories\Builders\EloquentBuilder;
use mahdikhorshidi\categories\Contracts\CategoryContract;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * mahdikhorshidi\categories\Models\Category.
 *
 * @property int                                                                       $id
 * @property string                                                                    $slug
 * @property array                                                                     $name
 * @property array                                                                     $description
 * @property int                                                                       $_lft
 * @property int                                                                       $_rgt
 * @property int                                                                       $parent_id
 * @property \Carbon\Carbon                                                            $created_at
 * @property \Carbon\Carbon                                                            $updated_at
 * @property \Carbon\Carbon                                                            $deleted_at
 * @property-read \Kalnoy\Nestedset\Collection|\mahdikhorshidi\categories\Models\Category[] $children
 * @property-read \mahdikhorshidi\categories\Models\Category|null                           $parent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\mahdikhorshidi\categories\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model implements CategoryContract
{
    use HasSlug;
    use NodeTrait;
    use HasTranslations;
    use ValidatingTrait;
    use CacheableEloquent;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        NestedSet::LFT,
        NestedSet::RGT,
        NestedSet::PARENT_ID,
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'slug' => 'string',
        NestedSet::LFT => 'integer',
        NestedSet::RGT => 'integer',
        NestedSet::PARENT_ID => 'integer',
        'deleted_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    protected $observables = [
        'validating',
        'validated',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
        'name',
        'description',
    ];

    /**
     * The default rules that the model will validate against.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Whether the model should throw a
     * ValidationException if it fails validation.
     *
     * @var bool
     */
    protected $throwValidationExceptions = true;

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('mahdikhorshidi.categories.tables.categories'));
        $this->setRules([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:10000',
            'slug' => 'required|alpha_dash|max:150|unique:'.config('mahdikhorshidi.categories.tables.categories').',slug',
            NestedSet::LFT => 'sometimes|required|integer',
            NestedSet::RGT => 'sometimes|required|integer',
            NestedSet::PARENT_ID => 'nullable|integer',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        // Auto generate slugs early before validation
        static::validating(function (self $model) {
            if ($model->exists && $model->getSlugOptions()->generateSlugsOnUpdate) {
                $model->generateSlugOnUpdate();
            } elseif (! $model->exists && $model->getSlugOptions()->generateSlugsOnCreate) {
                $model->generateSlugOnCreate();
            }
        });
    }

    /**
     * Get all attached models of the given class to the category.
     *
     * @param string $class
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany($class, 'categorizable', config('mahdikhorshidi.categories.tables.categorizables'), 'category_id', 'categorizable_id');
    }

    /**
     * Get the options for generating the slug.
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->doNotGenerateSlugsOnUpdate()
                          ->generateSlugsFrom('name')
                          ->saveSlugsTo('slug');
    }

    /**
     * {@inheritdoc}
     */
    public function newEloquentBuilder($query)
    {
        return new EloquentBuilder($query);
    }
}
