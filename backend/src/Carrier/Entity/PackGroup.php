<?php
declare(strict_types=1);

namespace App\Carrier\Entity;

use App\Carrier\Model\CarrierInterface;

class PackGroup implements CarrierInterface
{
    public function calculateCost(float $weight): float
    {
        return $weight * 1;
    }
}
