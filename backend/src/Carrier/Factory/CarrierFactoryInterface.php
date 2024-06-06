<?php
declare(strict_types=1);

namespace App\Carrier\Factory;

use App\Carrier\Model\CarrierInterface;

interface CarrierFactoryInterface
{
    public function createCarrier(string $slug): CarrierInterface;
}
