<?php
declare(strict_types=1);

namespace App\Carrier\Model;

use Symfony\Component\Validator\Constraints as Assert;

class DeliveryCostRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['trans_company', 'pack_group'], message: 'Invalid carrier slug.')]
    private $carrierSlug;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'numeric', message: 'The weight must be a number.')]
    #[Assert\GreaterThan(0, message: 'The weight must be greater than 0.')]
    private $weight;

    public function __construct(array $data)
    {
        $this->carrierSlug = $data['carrier'] ?? null;
        $this->weight = $data['weight'] ?? null;
    }

    public function getCarrierSlug(): ?string
    {
        return $this->carrierSlug;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }
}
