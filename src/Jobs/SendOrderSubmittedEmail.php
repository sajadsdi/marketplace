<?php

namespace Sajadsdi\Marketplace\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Sajadsdi\Marketplace\Mail\OrderSubmittedEmail;
use Sajadsdi\Marketplace\Repository\Order\OrderRepositoryInterface;

class SendOrderSubmittedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $orderId)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(OrderRepositoryInterface $orderRepository): void
    {
        $order = $orderRepository->getForEmailById($this->orderId);

        Mail::to(config('marketplace.admin_email'))->send(new OrderSubmittedEmail($order));
    }
}
