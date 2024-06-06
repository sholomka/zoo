<?php
declare(strict_types=1);

namespace App\Carrier\Service;

use App\Carrier\Factory\CarrierFactoryInterface;

readonly class DeliveryCostCalculator implements DeliveryCostCalculatorInterface
{
    public function __construct(
        private CarrierFactoryInterface $carrierFactory
    ) {
    }

    public function calculate(string $carrierSlug, float $weight): float
    {
        return $this->carrierFactory->createCarrier($carrierSlug)->calculateCost($weight);
    }
}
