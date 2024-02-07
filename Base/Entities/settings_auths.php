<?php

namespace Modules\Base\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings_auths extends Model
{
    use HasFactory;
    protected $table = 'settings_auths';
    protected $fillable = [
        'descriptions','status','add_auth'
    ];
}
