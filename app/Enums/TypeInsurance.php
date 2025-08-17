<?php

namespace App\Enums;

enum TypeInsurance: string
{
    case Sunday = 'Sunday';
    case Bosowa = 'Bosowa';
    case Abda = 'Abda';
    case Sea = 'Sea Insure';
    case Sompo = 'Sompo';
    case Etiqa = 'Etiqa';
    case Malaca = 'Malaca Trust';
    case ACA = 'ACA';
    case Zurich = 'Zurich';

    public function label(): string
    {
        return match ($this) {
            self::Sunday => 'Sunday',
            self::Bosowa => 'Bosowa',
            self::Abda => 'Abda',
            self::Sea => 'Sea Insure',
            self::Sompo => 'Sompo',
            self::Etiqa => 'Etiqa',
            self::ACA => 'ACA',
            self::Zurich => 'Zurich',
        };
    }
}
