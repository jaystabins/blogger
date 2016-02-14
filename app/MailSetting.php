<?php

namespace App;

use Carbon\Carbon;
use Crypt;
use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{

    protected $table = "mail_settings";
	/**
	 * Fields that are able to be mass assigned
	 */
    protected $fillable = [
            'driver',
            'host',
            'port',
            'from_address', 
            'from_name',
            'encryption',
            'username',
            'password'
        ];

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = Crypt::encrypt($password);
    }


    public static function getPasswordAttribute($password)
    {   
        return Crypt::decrypt($password);
    }

}