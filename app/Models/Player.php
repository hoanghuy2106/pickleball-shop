<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    // Thêm dòng này vào
    protected $fillable = ['name', 'rank_title', 'region', 'elo_points'];
}