<?php

namespace app\QueryFilters;
use Cerbero\QueryFilters\QueryFilters;

class ServiceFilters extends QueryFilters
{

    public function title($phrase)
    {
        $this->query->where('name', 'like', '%'. $phrase .'%');
    }

    public function available($available)
    {
        $this->query->where('available', '=', $available);
    }

    public function min($price)
    {
        $this->query->where('price', '>=', $price);
    }

    public function max($price)
    {
        $this->query->where('price', '<=', $price);
    }
}