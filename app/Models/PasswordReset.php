<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordReset extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'password_resets';

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = 'email';

    /**
     * @var bool $incrementing
     */
    public $incrementing = false;
}
