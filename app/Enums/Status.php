<?php

namespace App\Enums;

enum Status: string
{
    case DRAFT = 'draft';
    case CHANGED = 'changed';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
