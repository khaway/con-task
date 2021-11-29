<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'user_contacts';

    /**
     * @var int[] $attributes
     */
    protected $attributes = ['is_favorite' => 0];

    /**
     * @var string[] $fillable
     */
    protected $fillable = ['name', 'phone', 'is_favorite', 'user_id'];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'is_favorite' => 'boolean'
    ];
}
