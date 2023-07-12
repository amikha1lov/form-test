<?php

namespace App\Controllers;


use App\Models\Feedback;
use App\Services\FeedbackService;
use App\Services\MailService;
use App\View;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequest;

class FeedbackController
{

    public function __invoke()
    {
        $view = new View();

        $view->display(__DIR__ . '/../Templates/Feedback.php');
    }

    public function add(ServerRequest $request)
    {

        $data = $request->getParsedBody();
        $feedbackService = new FeedbackService();
        $mailService = new MailService();

        if (!($feedbackService::findByEmail($data['email']))) {


            $feedbackService::create($data);

            $mailService::sendEmail('alexey.mikha1lov@yandex.ru','форма обратной связи', $data);

            return new JsonResponse([
                'success' => true,
                'message' => 'Данные добавлены в базу'
            ]);
        } else {
            return new JsonResponse([
                'error' => true,
                'message' => 'Email уже существует в базе'
            ]);
        }

    }

}
