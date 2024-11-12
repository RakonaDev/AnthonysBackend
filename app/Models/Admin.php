<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Model implements JWTSubject
{
  use HasFactory;

  protected $primaryKey = 'id_admin';

  protected $fillable = [
    'user',
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
