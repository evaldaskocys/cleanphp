<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ApiExceptionListener
{
    private $requestStack;
    
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if (!$this->isApiRequest()) {
            return;
        }

        $exception = $event->getException();

        $event->setResponse(new JsonResponse([
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ]), 500);
    }

    private function isApiRequest()
    {
        return substr($this->requestStack->getCurrentRequest()->attributes->get('_route'), 0, 3) == 'api';
    }
}
