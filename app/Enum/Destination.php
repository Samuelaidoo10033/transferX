<?php

namespace App\Enum;

enum Destination: string
{
    case BANK = 'bank';
    case MOBILE_MONEY = 'mobile_money';
    case WALLET = 'wallet';
}
