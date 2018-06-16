<?php

namespace App\Models\Tatuco;


use App\Http\Services\AccessControl\ImageService;
use Illuminate\Notifications\Notifiable;
use App\Acl\Src\Traits\ShinobiTrait;
//use App\Notifications\ResetPassword;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   public $timestamps = true;
    use Notifiable, ShinobiTrait;

   /* public function __construct(){
        parent::__construct(User::class,'id','users',true,
        $create = [
            'name' => 'string',
            'emai' => 'string',
            'password' => 'string'
        ]);
    }*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'id','use_dni', 'use_nam', 'use_lna', 'use_nic', 'email', 'password','address','phone','typ_id'
        ,'cod_id','use_act','sta_id' ,'image','acc_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
 /*   public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }*/
    /* public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }*/
  /*  public static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->name = $user->name.'usando evento creating';
        });
    }*/

    /**
     * Mudator para guardar la imagen de perfil
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $img = "";
        if (isset($value)){
            $imageService = new ImageService();
            $img = $imageService->images($value);
        }
//        echo $img;
        $this->attributes['image'] = $img;
    }
}
