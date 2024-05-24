<?php

namespace Modules\PQRS\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\PQRS\Entities\Pqrs;

class PqrsAlert extends Mailable
{
    use Queueable, SerializesModels;
   
    /**
    * The order instance.
    *
    * @var \Modules\PQRS\Entities\Pqrs
    */
    public $pqrs;


    /**
     * Create a new message instance.
     *
     * @param \Modules\PQRS\Entities\Pqrs $pqrs
     * @return void
     */
    public function __construct(Pqrs $pqrs)
    {
        $this->pqrs = $pqrs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('julianjavierramirezdiaz83@gmail.com', 'PQRS')->view('pqrs::emails.pqrs');
    }
}
