<?php

namespace App\Models;

use App\Models\Filter;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_alias', 'alias');
    }
}
