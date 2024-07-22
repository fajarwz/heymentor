<?php

namespace App\Enums;

enum UserRole: int
{
    case ROLE_ADMIN = 1;
    case ROLE_MENTOR = 2;
    case ROLE_MEMBER = 3;
}