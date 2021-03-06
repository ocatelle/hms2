<?php

namespace App\Mail;

use HMS\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use HMS\Repositories\MetaRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MembershipDetailsApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $accountNo;

    /**
     * @var string
     */
    public $sortCode;

    /**
     * @var string
     */
    public $fullname;

    /**
     * @var string
     */
    public $paymentRef;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param MetaRepostiory $metaRepository
     */
    public function __construct(User $user, MetaRepository $metaRepository)
    {
        $this->accountNo = $metaRepository->get('so_accountNumber');
        $this->sortCode = $metaRepository->get('so_sortCode');
        $this->fullname = $user->getFullname();
        $this->paymentRef = $user->getAccount()->getPaymentRef();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Nottingham Hackspace: Please setup your standing order.')
            ->markdown('emails.membership.approved');
    }
}
