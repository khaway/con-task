<?php

namespace App\Models\Concerns;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasContact
{
    /**
     * Contact relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'id', 'contact_id');
    }
}
