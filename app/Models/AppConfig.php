<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    protected $table = 'app_config';
    protected $primaryKey = 'app_configID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'app_name',
        'app_logo',
        'primary_color',
        'secondary_color',
        'tertiary_color',
        'sidebar_color_primary',
        'sidebar_color_secondary',
        'background_color',
        'view_header_color',
        'container_color',
        'created_at',
        'updated_at',
    ];
}
