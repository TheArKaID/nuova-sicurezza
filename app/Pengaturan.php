<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $isnominasiaktif
 * @property string $ponsus
 * @property string $tahunaktif
 * @property string $created_at
 * @property string $updated_at
 */
class Pengaturan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pengaturan';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['isnominasiaktif', 'ponsus', 'tahunaktif', 'created_at', 'updated_at'];

}
