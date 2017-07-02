<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Task;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Api Task controller.
 *
 * @Route("/task")
 */
class ApiTaskController extends Controller
{
    /**
     * Lists all Task entities.
     *
     * @Route(
     *     "/list.{_format}",
     *     name="api_task_list",
     *     defaults={"_format": "json"},
     *     requirements={"_format": "json|xml"}
     * )
     * @Method("GET")
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository('AppBundle:Task')->findAll();
        $serializedTasks = [];
        $taskService = $this->get('app.task_service');

        foreach ($tasks as $task) {
            $serializedTasks[] = $taskService->serialize($task);
        }

        return $this->responseByFormat($serializedTasks, $request->attributes->get('_format'));
    }

    /**
     * Create Task.
     *
     * @Route(
     *     "/create.{_format}",
     *     name="api_task_create",
     *     defaults={"_format": "json"},
     *     requirements={"_format": "json|xml"}
     * )
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function createAction(Request $request)
    {
        $format = $request->attributes->get('_format');
        $task = new Task();
        $form = $this->createForm('AppBundle\Form\TaskType', $task, ['csrf_protection' => false]);
        $serializer = new Serializer([], ['xml' => new XmlEncoder(), 'json' => new JsonEncoder()]);
        $form->submit($serializer->decode($request->getContent(), $format));

        if ($form->isValid()) {
            $this->container->get('app.task_service')->create($task);

            return $this->responseByFormat($this->serialize($task), $format, Response::HTTP_CREATED);
        }

        return $this->responseByFormat(
            ['errors' => (string)$form->getErrors(true, false)],
            $format,
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @param     $data
     * @param     $format
     * @param int $responseCode
     * @return JsonResponse|Response
     */
    private function responseByFormat($data, $format, $responseCode = Response::HTTP_OK)
    {
        if ($format == 'xml') {
            $serializer = new Serializer([], ['xml' => new XmlEncoder('document')]);

            return new Response(
                $serializer->encode($data, 'xml'),
                $responseCode,
                ['Content-Type' => 'application/xml']
            );
        }

        return new JsonResponse($data, $responseCode);
    }
}
