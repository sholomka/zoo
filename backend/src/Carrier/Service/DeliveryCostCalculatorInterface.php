<?php
declare(strict_types=1);

namespace App\Carrier\Service;

interface DeliveryCostCalculatorInterface
{
    public function calculate(string $carrierSlug, float $weight): float;
}
