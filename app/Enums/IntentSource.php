<?php

namespace App\Enums;

enum IntentSource: string
{
    case ADMIN_DEFINED = 'ADMIN_DEFINED';
    case AI_DISCOVERED = 'AI_DISCOVERED';
    case MANUAL_TRAINING = 'MANUAL_TRAINING';
    case AUTO_LEARNED = 'AUTO_LEARNED';
}
