<?php
declare(strict_types=1);

namespace App\Carrier\Factory;

use App\Carrier\Model\CarrierInterface;
use Exception;

class CarrierFactory implements CarrierFactoryInterface
{
    private array $carriers = [];

    public function registerCarrier(string $slug, CarrierInterface $carrier): void
    {
        $this->carriers[$slug] = $carrier;
    }

    /**
     * @throws Exception
     */
    public function createCarrier(string $slug): CarrierInterface
    {
        if (!isset($this->carriers[$slug])) {
            throw new Exception('Carrier not found');
        }

        return $this->carriers[$slug];
    }
}
