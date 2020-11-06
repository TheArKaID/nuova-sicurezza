<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $idtahun
 * @property string $nomor
 * @property boolean $lantai
 * @property string $gedung
 * @property string $created_at
 * @property string $updated_at
 */
class Kamar extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'kamar';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['idtahun', 'idusroh', 'nomor', 'jeniskelamin', 'created_at', 'updated_at'];

    public function usroh()
    {
        return $this->belongsTo('App\Usroh', 'idusroh');
    }

    public function resident()
    {
        return $this->hasOne('App\Resident', 'idkamar');
    }
    
    public function senior()
    {
        return $this->hasOne('App\Senior', 'idkamar');
    }

    protected static function booted() {
        static::deleting(function($kamar) {
            if($kamar->resident) {
                $kamar->resident->delete();
            } elseif ($kamar->senior) {
                $kamar->senior->delete();
            }
        });
    }
}