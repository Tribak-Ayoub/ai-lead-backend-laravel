<?php

namespace App\Enums;

enum TrainingSource: string
{
    case ADMIN_MANUAL = 'ADMIN_MANUAL';
    case CONVERSATION_REVIEW = 'CONVERSATION_REVIEW';
    case FAILED_CLASSIFICATION = 'FAILED_CLASSIFICATION';
    case BULK_IMPORT = 'BULK_IMPORT';
}

