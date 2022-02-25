<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use App\Models\Support;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
        use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = ['nome', 'description', 'video'];

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

}
