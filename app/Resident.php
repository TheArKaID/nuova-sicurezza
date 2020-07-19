<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $idusroh
 * @property int $idkamar
 * @property int $idtahun
 * @property string $nama
 * @property string $nim
 * @property string $jeniskelamin
 * @property string $foto
 * @property string $created_at
 * @property string $updated_at
 */
class Resident extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'resident';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['idusroh', 'idkamar', 'idtahun', 'nama', 'nim', 'jeniskelamin', 'foto', 'created_at', 'updated_at'];

    public function kamar()
    {
        return $this->belongsTo('App\Kamar', 'idkamar');
    }
    
    public function usroh()
    {
        return $this->belongsTo('App\Usroh', 'idusroh');
    }
}
