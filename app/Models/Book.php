<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kblais\QueryFilter\FilterableTrait;

class Book extends Model
{
    use HasFactory,FilterableTrait;

    protected $table = 'books';

    protected $fillable = ['name','description','image','publish_at'];

    public $timestamps = false;

    protected $casts = [
      'publish_at'=>'datetime'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
