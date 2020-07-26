<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $idresident
 * @property int $idtengko
 * @property int $idtahun
 * @property int $idsenior
 * @property string $keterangan
 * @property string $tanggal
 * @property string $created_at
 * @property string $updated_at
 */
class Pencatatan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pencatatan';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['idresident', 'idtengko', 'idtahun', 'idsenior', 'keterangan', 'tanggal', 'created_at', 'updated_at'];

}
