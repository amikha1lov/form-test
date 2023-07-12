<?php

namespace App\Models;

use App\Model;

class Feedback extends Model
{

    protected const TABLE = 'feedback';

    public string $name;
    public string $phone;
    public string $email;
    public string $message;

}
