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

    public function usroh()
    {
        return $this->hasMany('App\Usroh', 'idtahun');
    }
    
    public function tengko()
    {
        return $this->hasMany('App\Tengko', 'idtahun');
    }

    protected static function booted() {
        static::deleting(function($tahun) {
            if($tahun->usroh) {
                foreach($tahun->usroh as $u) { 
                    try {
                        $u->delete();
                    } catch (\Throwable $th) {
                        
                    }
                };
            }

            if($tahun->tengko) {
                foreach($tahun->tengko as $t) {
                    try {
                        $t->delete();
                    } catch (\Throwable $th) {
                        
                    }
                };
            }
        });
    }
}
