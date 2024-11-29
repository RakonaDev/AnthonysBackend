<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
  use HasFactory, HasApiTokens, Notifiable;

  protected $table = 'admin';

  protected $primaryKey = 'id_admin';

  protected $fillable = [
    'name',
    'email',
    'password'
  ];

  public function getJWTIdentifier () {
    return $this->getKey();
  }

  public function getJWTCustomClaims() {
    return [];
  }
}
