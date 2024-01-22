<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, string $string1, int $int)
 * @method static create(array $array)
 */
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'icon', 'parent_id'];

    public static function boot(): void
    {
        // Trước khi xóa 1 category sẽ xóa các category con
        parent::boot();
        static::deleting(function($category){
            $category->deleteChildren();
        });
    }

    public function childs():HasMany{
        return $this->hasMany(Category::class, "parent_id",'id');
    }
}
