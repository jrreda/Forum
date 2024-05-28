<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{    
    /**
     * filters
     *
     * @var array
     */
    protected $filters = ['by', 'popular'];

    /**
     * filter the query by a given username
     *
     * @param  string $username
     * @return Builder
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * filter the query by a given username
     *
     * @param  string $username
     * @return Builder
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('replies_count', 'desc');
    }
}
