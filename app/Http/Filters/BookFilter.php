<?php


namespace App\Http\Filters;


use Kblais\QueryFilter\QueryFilter;

class BookFilter extends QueryFilter
{
    public function name($value)
    {
        return $this->builder->where('name','LIKE',$value.'%');
    }

    public function author($value)
    {
        $this->builder->whereHas('authors',function ($q) use ($value){
            $q->where('name','LIKE',$value.'%')->orWhere('surname','LIKE',$value.'%');
        });
    }

    public function orderByName($value)
    {
        return $this->builder->orderBy('name',$value);
    }
}
