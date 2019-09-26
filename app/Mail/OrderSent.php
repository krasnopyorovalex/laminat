<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderSent
 * @package App\Mail
 */
class OrderSent extends Mailable
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
     * @return OrderSent
     */
    public function build(): OrderSent
    {
        return $this->subject('Форма: узнать стоимость товара')
            ->view('emails.order', [
                'data' => $this->data
            ]);
    }
}
