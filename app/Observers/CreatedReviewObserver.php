<?php

namespace App\Observers;

use App\Mail\OrderShipped;
use App\Models\User;

class CreatedReviewObserver
{
    public function created(User $model)
    {
        $mail = new OrderShipped();

        //TODO:: Здесь отправка письма
    }
}
