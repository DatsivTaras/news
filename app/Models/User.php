<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Enum\UserStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $surname
 * @property $biography
 * @property $patronymic
 * @property $email_verified_at
 * @property $password
 * @property $password_confirmation
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;
    static $rules = [
		'name' => 'required',
		'surname' => 'required',
		'role' => 'required',
		'patronymic' => 'required',
		'biography' => 'required',
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','password', 'password_confirmation'];



}
