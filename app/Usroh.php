<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $idtahun
 * @property string $nama
 * @property boolean $lantai
 * @property string $gedung
 * @property string $created_at
 * @property string $updated_at
 */
class Usroh extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usroh';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['idtahun', 'nama', 'jeniskelamin', 'lantai', 'gedung', 'created_at', 'updated_at'];

    public function kamar()
    {
        return $this->hasMany('App\Kamar', 'idusroh');
    }

    public function senior()
    {
        return $this->hasMany('App\Senior', 'idusroh');
    }

    protected static function booted() {
        static::deleting(function($usroh) {
            foreach($usroh->kamar as $k) { 
                $k->delete(); 
            };
        });
    }
}
