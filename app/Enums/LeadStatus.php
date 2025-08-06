<?php

// app/Enums/LeadStatus.php

namespace App\Enums;

enum LeadStatus: string
{
    case NEW = 'NEW';
    case CONTACTED = 'CONTACTED';
    case QUALIFIED = 'QUALIFIED';
    case DISQUALIFIED = 'DISQUALIFIED';
    case APPOINTMENT_SET = 'APPOINTMENT_SET';
    case CLOSED = 'CLOSED';
}
