<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'path', 'album_id'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
}