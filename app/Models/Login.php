<?php


namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Login extends Model implements AuthenticatableContract
{
    use AuthenticatableTrait;

    protected $table = 'login'; // Specify the table name if it differs from the model name

    protected $fillable = ['username', 'fullname', 'gmail', 'password'];

    public static function isValidCredentials($username, $password)
    {
        // Check if the username and password match any record in the database
        $user = self::where('username', $username)->where('password', $password)->first();
        
        // Return true if a matching record is found, false otherwise
        return $user !== null;
    }

}
