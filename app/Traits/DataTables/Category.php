<?php

namespace App\Traits\DataTables\Category;

use Yajra\DataTables\Html\Column;


trait Category
{
    /**
     * Add a action column.
     *
     * @param  array $attributes
     * @param  bool $prepend
     * @return $this
     */
    public function addCategory(array $attributes = [], $prepend = false)
    {
        $attributes = array_merge([
            'defaultContent' => '',
            'data' => 'category',
            'name' => 'category',
            'title' => 'Category',
            'render' => null,
            'orderable' => false,
            'searchable' => false,
            'exportable' => false,
            'printable' => false,
            'footer' => '',
        ], $attributes);

        if ($prepend) {
            $this->collection->prepend(new Column($attributes));
        } else {
            $this->collection->push(new Column($attributes));
        }

        return $this;
    }
}

