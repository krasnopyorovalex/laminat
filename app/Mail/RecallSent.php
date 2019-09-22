<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class RecallSent
 * @package App\Mail
 */
class RecallSent extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * OrderServiceSent constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return RecallSent
     */
    public function build()
    {
        return $this->from('bravyi-turist@yandex.ru')
            ->subject('Форма: заказ обратного звонка')
            ->view('emails.recall', [
                'data' => $this->data
            ]);
    }
}
