<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $idsenior
 * @property int $idusroh
 * @property int $idkamar
 * @property string $nama
 * @property string $nim
 * @property string $jeniskelamin
 * @property string $foto
 * @property string $username
 * @property string $password
 * @property string $passcode
 * @property string $tahunajaran
 * @property string $token
 * @property string $rememberme
 * @property string $created_at
 * @property string $updated_at
 */
class Senior extends Model
{
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
    protected $fillable = ['idsenior', 'idusroh', 'idkamar', 'nama', 'nim', 'jeniskelamin', 'foto', 'username', 'password', 'passcode', 'tahunajaran', 'token', 'rememberme', 'created_at', 'updated_at'];

    protected $hidden = ['password'];
    
    protected $guard = 'admin';

}
