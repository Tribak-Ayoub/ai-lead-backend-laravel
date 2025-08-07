<?php

namespace App\Enums;

enum CallStatus: string
{
    case SCHEDULED = 'SCHEDULED';
    case DIALING = 'DIALING';
    case RINGING = 'RINGING';
    case ANSWERED = 'ANSWERED';
    case BUSY = 'BUSY';
    case NO_ANSWER = 'NO_ANSWER';
    case FAILED = 'FAILED';
    case COMPLETED = 'COMPLETED';
}
