<?php
namespace Martin\Users;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function products()
    {
        return $this->hasMany('Martin\Products\Product');
    }

    public function contacts()
    {
        return $this->hasMany('Martin\Quality\Contact');
    }


    public function customerRequests()
    {
        return $this->hasMany('Martin\Quality\CustomerRequest');
    }



    public function investigations()
    {
        return $this->hasMany('Martin\Quality\Investigation');
    }

    public function investigationReports()
    {
        return $this->hasMany('Martin\Quality\InvestigationReport');
    }

}
