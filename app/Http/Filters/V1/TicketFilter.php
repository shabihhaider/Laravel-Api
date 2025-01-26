<?php

namespace App\Http\Filters\V1;

class TicketFilter extends QueryFilter {

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
     
    public function status($value) {
        return $this->builder->whereIn('status', explode(',', $value)); // query builder
    }

    public function title($value) {
        $likeStr = str_replace('*', '%', $value); // replace * with % for SQL LIKE
        return $this->builder->where('title', 'like', $likeStr); // query builder
    }

    public function updatedAt($value) {
        $dates = explode(',', $value); // split the dates by comma

        if(count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates); // query builder
        }

        return $this->builder->whereDate('updated_at', $value);
    }
}