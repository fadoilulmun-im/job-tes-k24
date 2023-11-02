<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Member extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $guarded = [
        'id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'
    ];
}
