<?php

namespace App\Models\Content;

use App\Models\Category\Category;
use App\Models\Subcription\SubcriptionType;
use App\Models\User\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'content';
    // protected $primaryKey = 'id';
    // public $timestamps = false;

    protected $guarded = ['id'];
    protected $fillable = [
        'id',
        'author_id',
        'category_id',
        'subcription_type_id',
        'title',
        'description',
        'video_path'
    ];

    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    static public function Filters($order, $category)
    {
        return Content::whereHas('SubcriptionType', function ($query) use ($order) {
            $query->where('order', '>=', $order);
        })->WhereHas('Category', function ($query) use ($category) {
            $query->where('title', $category);
        })->get();
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function User()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function SubcriptionType()
    {
        return $this->belongsTo(SubcriptionType::class, 'subcription_type_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
