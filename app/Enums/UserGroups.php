<?php

declare(strict_types=1);

namespace App\Enums;

enum UserGroups: int
{
    case VALIDATING = 1;
//    case GUEST = 2;
    case USER = 2;
    case ADMINISTRATOR = 3;
    case BANNED = 4;
    case MODERATOR = 5;
    case UPLOADER = 6;
//    case TRUSTEE = 8;
    case BOT = 7;
    case SYSOP = 8;
    case POWERUSER = 9;
    case SUPERUSER = 10;
    case EXTREMEUSER = 11;
//    case INSANEUSER = 14;
    case PIJAVKA = 12;
//    case VETERAN = 16;
//    case SEEDER = 17;
//    case ARCHIVIST = 18;
    case INTERNAL = 13;
    case DISABLED = 14;
//    case PRUNED = 21;
}
