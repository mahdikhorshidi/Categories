<?php

declare(strict_types=1);

namespace mahdikhorshidi\categories\Contracts;

/**
 * mahdikhorshidi\categories\Contracts\CategoryContract.
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
interface CategoryContract
{
    //
}
