<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $id
 * @property int $idsenior
 * @property int $idusroh
 * @property int $idkamar
 * @property int $idtahun
 * @property string $nama
 * @property string $nim
 * @property string $jeniskelamin
 * @property string $foto
 * @property string $username
 * @property string $password
 * @property string $passcode
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 */
class Senior extends Authenticable
{
    use Notifiable;

    protected $hidden = ['password', 'passcode'];
    protected $guard = 'senior';

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'senior';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['idsenior', 'idusroh', 'idkamar', 'idtahun', 'status', 'nama', 'nim', 'jeniskelamin', 'foto', 'username', 'password', 'passcode', 'isdivman', 'remember_token', 'created_at', 'updated_at'];

    public function usroh()
    {
        return $this->belongsTo('App\Usroh' ,'idusroh');
    }

    public function kamar()
    {
        return $this->belongsTo('App\Kamar', 'idkamar');
    }
}
