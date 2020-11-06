<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $idtahun
 * @property string $tipe
 * @property string $penjelasan
 * @property string $created_at
 * @property string $updated_at
 */
class Tengko extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tengko';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['idtahun', 'tipe', 'penjelasan', 'poin', 'jeniskelamin', 'created_at', 'updated_at'];

    public function pencatatan()
    {
        return $this->hasMany('App\Pencatatan', 'idtengko');
    }
    
    protected static function booted() {
        static::deleting(function($tengko) {
            if($tengko->pencatatan) {
                foreach($tengko->pencatatan as $p) { 
                    $p->delete();
                };
            }
        });
    }
}
