<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Berita
 * @package App\Models
 * @version October 9, 2021, 10:51 pm UTC
 *
 * @property string $image
 * @property string $title
 * @property integer $kategori_id
 * @property string $slug
 * @property string $content
 * @property string $type
 * @property string $status
 */
class Berita extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'beritas';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'image',
        'title',
        'slug',
        'content',
        'type',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string',
        'title' => 'string',
        'kategori_id' => 'integer',
        'slug' => 'string',
        'type' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required',
        'title' => 'required',
        'kategori_id' => 'required',
        'content' => 'required',
        'type' => 'required',
        'status' => 'required'
    ];


}
