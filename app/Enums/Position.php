<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Position: string implements HasLabel
{
    case POPUP = 'popup';
    case HEADER = 'header';
    case SIDEBAR = 'sidebar';
    case FOOTER = 'footer';

    public function getLabel(): string
    {
        return match($this) {
            self::POPUP => 'Popup',
            self::HEADER => 'Header',
            self::SIDEBAR => 'Sidebar',
            self::FOOTER => 'Footer',
        };
    }
}
