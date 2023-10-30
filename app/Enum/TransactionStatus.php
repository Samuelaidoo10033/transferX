<?php

namespace App\Enum;

enum TransactionStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
    case COMPLETED = 'completed';
}
