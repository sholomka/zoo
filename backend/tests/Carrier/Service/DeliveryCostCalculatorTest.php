<?php
declare(strict_types=1);

namespace App\Tests\Carrier\Service;

use App\Carrier\Entity\PackGroup;
use App\Carrier\Entity\TransCompany;
use App\Carrier\Factory\CarrierFactory;
use App\Carrier\Factory\CarrierFactoryInterface;
use App\Carrier\Service\DeliveryCostCalculator;
use PHPUnit\Framework\TestCase;

class DeliveryCostCalculatorTest extends TestCase
{
    private CarrierFactoryInterface $carrierFactory;

    protected function setUp(): void
    {
        $this->carrierFactory = new CarrierFactory();
        $this->carrierFactory->registerCarrier('trans_company', new TransCompany());
        $this->carrierFactory->registerCarrier('pack_group', new PackGroup());
    }

    public function testCalculateWithTransCompanyUnder10Kg(): void
    {
        $calculator = new DeliveryCostCalculator($this->carrierFactory);

        $cost = $calculator->calculate('trans_company', 5);

        $this->assertEquals(20.0, $cost);
    }

    public function testCalculateWithTransCompanyOver10Kg(): void
    {
        $calculator = new DeliveryCostCalculator($this->carrierFactory);

        $cost = $calculator->calculate('trans_company', 15);

        $this->assertEquals(100.0, $cost);
    }

    public function testCalculateWithPackGroup(): void
    {
        $calculator = new DeliveryCostCalculator($this->carrierFactory);

        $cost = $calculator->calculate('pack_group', 5);

        $this->assertEquals(5.0, $cost);
    }

    public function testUnknownCarrier(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Carrier not found');

        $calculator = new DeliveryCostCalculator($this->carrierFactory);

        $calculator->calculate('unknown_carrier', 5);
    }
}
