<?php

namespace App\Http\Controllers;

use App\Domain\Guestbook\Commands\CreateGuestbookCommand;
use App\Http\Requests\Forms\GuestbookCheckRequest;
use App\Http\Requests\Forms\OrderCheckRequest;
use App\Http\Requests\Forms\RecallRequest;
use App\Mail\OrderSent;
use App\Mail\RecallSent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class FormHandlerController
 * @package App\Http\Controllers
 */
class FormHandlerController extends Controller
{
    use DispatchesJobs;

    private $to = 'bravyi.turist@mail.ru';

    /**
     * @param OrderCheckRequest $request
     * @return array
     */
    public function orderCheck(OrderCheckRequest $request): array
    {
        Mail::to([$this->to])->send(new OrderSent($request->all()));

        return [
            'message' => 'Благодарим за Вашу заявку. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }

    /**
     * @param GuestbookCheckRequest $request
     * @return array
     */
    public function guestbookCheck(GuestbookCheckRequest $request): array
    {
        $this->dispatch(new CreateGuestbookCommand($request));

        return [
            'message' => 'Спасибо за Ваш отзыв.',
            'status' => 200
        ];
    }

    /**
     * @param RecallRequest $request
     * @return array
     */
    public function recall(RecallRequest $request): array
    {
        Mail::to([$this->to])->send(new RecallSent($request->all()));

        return [
            'message' => 'Благодарим за Вашу заявку. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }
}
