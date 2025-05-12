<?php

namespace Modules\SIA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class WelcomeApprenticeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Bienvenido al Sistema S.I.A.')
                    ->view('sia::emails.welcome_apprentice')
                    ->with([
                        'user' => $this->user,
                        'password' => $this->password,
                    ]);
    }
}