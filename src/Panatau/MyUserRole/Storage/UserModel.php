<?php namespace Panatau\MyUserRole\Storage;
/**
 *
 */

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserModel extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
    protected $fillable = [ 'username', 'email'];

    public static $rules_tambah = [
        'username' => [ 'required', 'alpha_dash', 'min:5'],
        'email'    => [ 'required', 'email' ],
        'password' => [ 'required', 'same:password_retype', 'min:5' ]
    ];

    public static $rules_reset_pass = [
        'password' => [ 'required', 'same:password_retype', 'min:5' ]
    ];

    public function getDates()
    {
        return array_merge( ['last_login_at'], parent::getDates());
    }
}
