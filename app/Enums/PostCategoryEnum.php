<?php

namespace App\Enums;

enum PostCategoryEnum:string
{
    case NEWS = 'berita';
    case ANNOUNCEMENT = 'pengumuman';
    case TRAINING = 'pelatihan';

    public function label(): string
    {
        return match ($this) {
            self::NEWS => 'Berita',
            self::ANNOUNCEMENT => 'Pengumuman',
            self::TRAINING => 'Informasi Pelatihan',
        };
    }
}
