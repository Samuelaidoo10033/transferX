<?php

namespace App\Enum;

enum PaymentMethod: string
{
    case BANK_TRANSFER = 'bank_transfer';
    case MOBILE_MONEY = 'mobile_money';
    case CARD = 'card';
    case WALLET = 'wallet';
}
