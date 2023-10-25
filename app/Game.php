<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Genre;
use App\Platform;

class Game extends Model
{
    public static $validationRules = [
        'title' => 'required',
        'released' => 'required',
        'director' => 'required',
        'critic_score' => 'required',
        'user_score' => 'required',
        'genres' => 'required',
        'platforms' => 'required',
    ];

    protected $fillable = [
        'title',
        'released',
        'director',
        'critic_score',
        'user_score',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    use softDeletes;
}
