<?php

namespace App;

use App\Entities\BaseModel;

class AdminModule extends BaseModel
{
    protected $fillable = [
        'name', 'description', 'status', 'created_by'
    ];
}
