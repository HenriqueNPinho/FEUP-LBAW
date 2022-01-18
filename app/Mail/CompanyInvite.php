<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyInvite extends Mailable
{
    use Queueable, SerializesModels;


    protected $url;
    protected $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company,$url)
    {
        $this->url = $url;
        $this->company =$company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.company-invite',['url'=>$this->url,'company'=>$this->company]);
    }
}
