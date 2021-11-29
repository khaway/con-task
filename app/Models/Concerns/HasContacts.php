<?php

namespace App\Models\Concerns;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasContacts
{
    /**
     * Contacts relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
