<?php

namespace App\Services;

use App\Models\Feedback;

class FeedbackService
{

    public static function create($data)
    {
        $model = new Feedback();
        $model->name = $data['name'];
        $model->phone = $data['phone'];
        $model->email = $data['email'];
        $model->message = $data['message'];
        $model->insert();

        return $model;
    }

    public static function findByEmail($email)
    {
        return Feedback::findByEmail($email);
    }

}