<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use CrudTrait;
    protected $fillable = [
        'user_id', 'name', 'description', 'deadline', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
