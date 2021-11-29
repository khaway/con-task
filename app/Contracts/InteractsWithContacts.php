<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface InteractsWithContacts
{
    public function contacts(): HasMany;
}
