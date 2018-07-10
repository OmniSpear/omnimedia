<?php

namespace Omnispear\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'storage_location',
        'file_name'
    ];
}