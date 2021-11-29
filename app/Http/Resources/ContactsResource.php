<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class ContactsResource extends ResourceCollection
{
    /**
     * @var string $collects
     */
    public $collects = ContactResource::class;
}
