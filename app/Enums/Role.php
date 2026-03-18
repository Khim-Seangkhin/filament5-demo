<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Role: string implements HasLabel
{
    case ADMIN = 'Admin';
    case USER = 'User';

    public function getLabel(): string|Htmlable|null
    {
        return $this->name;
    }
}
