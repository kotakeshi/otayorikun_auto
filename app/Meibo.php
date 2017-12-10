<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Meibo extends Model
{
use Notifiable;

protected $table = 'meibo';
protected $primaryKey = 'id';
  protected $fillable = [
       'id','name','roomno','group','gazou'];
}
