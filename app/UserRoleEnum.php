<?php

namespace App;

enum UserRoleEnum: string
{
    case ADMIN   = 'admin';
    case COURIER = 'courier';
    case CLIENT  = 'client';

    public function label(): string
    {
        return match($this) {
            self::ADMIN   => 'Administrator',
            self::COURIER => 'Courier',
            self::CLIENT  => 'Client',
        };
    }
}
