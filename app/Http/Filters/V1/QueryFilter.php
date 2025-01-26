<?php


namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter {
    protected $builder;
    protected $request;
    protected $sortable = [];

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function apply(Builder $builder) {
        $this->builder = $builder;

        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $builder;
    }

    protected function filter($arr) {
        foreach ($arr as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }

    protected function sort($value) {
        $sortAttributes = explode(',', $value);

        foreach($sortAttributes as $sortAttribute) {
            $direction = 'asc';
            
            if (strpos($sortAttribute, '-') === 0) { // strpos returns the position of the first occurrence of a substring in a string.
                $direction = 'desc'; // If the position of the hyphen is 0, the direction is descending
                $sortAttribute = substr($sortAttribute, 1); // substr returns part of a string
            }

            // If the sort attribute is not in the sortable array, skip it
            if (!in_array($sortAttribute, $this->sortable) && !array_key_exists($sortAttribute, $this->sortable)) {
                continue;
            }

            // If the sort attribute is in the sortable array, get the key value otherwise use the sort attribute
            $columnName = $this->sortable[$sortAttribute] ?? $sortAttribute;

            $this->builder->orderBy($columnName, $direction);
        }
    }    
}