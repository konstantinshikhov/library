<?php


namespace App\Http\Filters;


use Kblais\QueryFilter\QueryFilter;

class AuthorFilter extends QueryFilter
{

    public function name($value)
    {
        return $this->builder->where('name', 'LIKE', $value . '%');
    }

    public function surname($value)
    {
        return $this->builder->where('surname', 'LIKE', $value . '%');
    }
}
