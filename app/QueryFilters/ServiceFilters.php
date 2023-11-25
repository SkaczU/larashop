<?php

namespace app\QueryFilters;
use Cerbero\QueryFilters\QueryFilters;

class ServiceFilters extends QueryFilters
{

    public function title($phrase)
    {
        $this->query->where('name', 'like', '%'. $phrase .'%');
    }

    public function available()
    {
        $this->query->where('available', '>', 0);
    }
}