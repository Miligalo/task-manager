<?php

declare(strict_types=1);

namespace App\Http\Enums;

enum TaskType: string
{
    case Pending = 'pending';

    case InProgress = 'in_progress';

    public static function getValues(): array
    {
        return [
            self::Pending->name => self::Pending->value,
            self::InProgress->name => self::InProgress->value,
        ];
    }
}
