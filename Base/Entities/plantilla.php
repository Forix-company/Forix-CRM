<?php

namespace Modules\Base\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class plantilla extends Model
{
    use HasFactory;
    protected $table = 'layout_colors';
    protected $fillable = [
        'color_logo',
        'color_header',
        'color_sidebar',
        'color_body',
    ];


}
