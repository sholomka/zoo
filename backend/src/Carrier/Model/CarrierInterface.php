<?php
declare(strict_types=1);

namespace App\Carrier\Model;

interface CarrierInterface
{
    public function calculateCost(float $weight): float;
}
