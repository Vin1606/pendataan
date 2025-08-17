<?php

namespace App\Enums;

enum VehicleType: string
{
    case DumpTruck = 'DumpTruck';
    case Box = 'Box';
    case Bus = 'Bus';
    case Hiace = 'Hiace';


    public function label(): string
    {
        return match ($this) {
            self::DumpTruck => 'Dump Truck',
            self::Box => 'Box',
            self::Bus => 'Bus',
            self::Hiace => 'Hiace',
        };
    }
}
