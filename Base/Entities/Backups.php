<?php

namespace Modules\Base\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Backups extends Model
{
    use HasFactory;

    protected $table = 'backups';
    protected $fillable = [
        'name',
        'folder',
        'database',
        'status',
        'date_create',
        'location'
    ];
}
