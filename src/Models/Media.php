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
        'file_name',
        'file_size',
    ];

    /**
     * Get human readable file size
     *
     * @return string
     */
    public function getHumanReadableSizeAttribute()
    {
        $b = $this->file_size;

        if ($b < 1024) {
            return number_format($b, 0) . '<span>B</span>';
        } elseif ($b < 1024 * 1024) {
            return number_format($b / 1024, 0) . '<span>KB</span>';
        } elseif ($b < 1024 * 1024 * 1024) {
            return number_format($b / (1024 * 1024), 0) . '<span>MB</span>';
        } elseif ($b < 1024 * 1024 * 1024 * 1024) {
            return number_format($b / (1024 * 1024 * 1024), 2) . '<span>GB</span>';
        } else {
            return number_format($b / (1024 * 1024 * 1024 * 1024), 2) . '<span>TB</span>';
        }
    }
}