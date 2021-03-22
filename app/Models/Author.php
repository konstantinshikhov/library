<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kblais\QueryFilter\FilterableTrait;

class Author extends Model
{
    use HasFactory,FilterableTrait;

    protected $table = 'authors';

    protected $fillable = ['name','surname','patronymic'];

    protected $attributes = [
      'patronymic' => null
    ];

    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
