<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
	public $timestamps = true;
	protected $table = 'admins';
	protected $guard = 'admin';

	protected $fillable = [
		'slug',
        'email',
        'password',
		'first_name',
		'last_name',
		'phone_number',
		'status',
		'image_id'
	];

}
