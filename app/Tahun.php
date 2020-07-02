<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $tahunajaran
 * @property string $created_at
 * @property string $updated_at
 */
class Tahun extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tahun';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tahunajaran', 'created_at', 'updated_at'];

}
