<?php

namespace App\Macros;

use Illuminate\Database\Eloquent\Builder;

class BuilderMacro
{
    public function upsertWithReturn()
    {
        return function (array $values, array $uniqueBy, array $update = null) {
            if (in_array('id', $uniqueBy) && empty($values['id'])) {
                $result = $this->model::create($values);
                return $result;
            } else {
                $result = $this->model->upsert($values, $uniqueBy, $update);

                if ($result) {
                    $query = $this->model;
                    foreach ($uniqueBy as $column) {
                        $query = $query->where($column, $values[$column]);
                    }
                }

                return $query->first();
            }
        };
    }
}
