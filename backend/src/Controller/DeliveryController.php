<?php
declare(strict_types=1);

namespace App\Controller;

use App\Carrier\Model\DeliveryCostRequestDto;
use App\Carrier\Service\DeliveryCostCalculatorInterface;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DeliveryController extends AbstractController
{
    public function __construct(
        private readonly DeliveryCostCalculatorInterface $deliveryCostCalculator,
        private readonly ValidatorInterface $validator
    ) {
    }

    #[Route('/api/calculate', name:'calculate_delivery_cost', methods: ['POST'])]
    public function calculate(Request $request): JsonResponse
    {
        try {
            $requestData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return new JsonResponse(['errors' => ['Invalid JSON data: ' . $e->getMessage()]], Response::HTTP_BAD_REQUEST);
        }

        $deliveryCostRequestDto = new DeliveryCostRequestDto($requestData);
        $errors = $this->validator->validate($deliveryCostRequestDto);

        if ($errors->count() > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = [
                    'field' => $error->getPropertyPath(),
                    'message' => $error->getMessage(),
                ];
            }

            return new JsonResponse(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }

        $cost = $this->deliveryCostCalculator->calculate(
            $deliveryCostRequestDto->getCarrierSlug(),
            $deliveryCostRequestDto->getWeight()
        );

        return new JsonResponse(['cost' => $cost]);
    }
}
