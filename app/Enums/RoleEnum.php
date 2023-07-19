<?php

namespace App\Enums;

enum RoleEnum: string
{
    case Administrator = 'Administrator';
    case Judge = 'Judge';
    case Participant = 'Participant';
    case Journalist = 'Journalist';
}
