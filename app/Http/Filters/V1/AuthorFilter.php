<?php

namespace App\Http\Filters\V1;

class AuthorFilter extends QueryFilter {
    protected $sortable = [
        'name',
        'email',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];

    public function createdAt($value) {
        $dates = explode(',', $value); // split the dates by comma

        if(count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates); // query builder
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function include($value) {
        return $this->builder->with($value); // query builder
    }
     
    public function id($value) {
        return $this->builder->whereIn('id', explode(',', $value)); // query builder
    }

    public function email($value) {
        $likeStr = str_replace('*', '%', $value); // replace * with % for SQL LIKE
        return $this->builder->where('email', 'like', $likeStr); // query builder
    }

    public function name($value) {
        $likeStr = str_replace('*', '%', $value); // replace * with % for SQL LIKE
        return $this->builder->where('name', 'like', $likeStr); // query builder
    }

    public function updatedAt($value) {
        $dates = explode(',', $value); // split the dates by comma

        if(count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates); // query builder
        }

        return $this->builder->whereDate('updated_at', $value);
    }
}