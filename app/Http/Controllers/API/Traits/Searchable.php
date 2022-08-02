<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait Searchable {

    /**
     * Apply searching to query
     *
     * @param \Illuminate\Http\Request|null $request
     * @param \Illuminate\Database\Eloquent\Builder
     *
     * @return void
     */
    public function applySearching(Request $request = null, $query = null): void
    {

        /** @var \Illuminate\Http\Request $request */
        $request = $request ?: request();

        $query = $query ?: $this->query;

        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = $query ? $query->getModel()  : $this->model;

        // Search in table
        if(($columns = $request->input('key')) &&
            ($search = $request->input('search')) &&
            is_string($search)
        ){
            $query = $this->searchColumn($query, $columns, $search, $model);
        }

        /**
         * This will join relation based on paramter (relation)
         */
        if(($relation = $request->input('relation'))){
            $query->whereHas($relation, function($sub) use($request){
                // Search in table
                $model = $sub->getModel();
                if(($columns = $request->input('key')) && ($search = strtolower($request->input('search')))){
                    $this->searchColumn($sub, $columns, $search, $model);
                }
            });

        }
    }

    /**
     * Search by any column
     *
     * @param mixed $query
     * @param string|array $columns
     * @param string $search
     * @param mixed $model
     *
     * @return mixed $query
     */
    private function searchColumn($query, $columns, $search, $model): Builder
    {

        /** @var array $columns */
        $columns = is_array($columns) ? $columns : [$columns];

        $query->where(function($query) use($columns, $search, $model) {
            foreach($columns as $column) {
                if(in_array($column, $model->getFillable())) {
                    $query->orWhereRaw("LOWER({$query->qualifyColumn($column)}) LIKE  '%".trim($search)."%'");
                }
            }
        });

        return $query;
    }
}
