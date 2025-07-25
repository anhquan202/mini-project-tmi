<?php

namespace App;

enum UserStatusEnum: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
    case BLOCKED = 3;
    case SUSPENDED = 4;
    case WARNING = 5;
}
