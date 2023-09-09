<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Add_NotifInvoices extends Notification
{
    use Queueable;
private $invoice_Det;
    /**
     * Create a new notification instance.
     */
    public function __construct($invoice_Det)
    {
        $this->invoice_Det=$invoice_Det;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase (object $notifiable): array
    {
        return [
            'xx' => $this->invoice_Det->id,
            'title' => 'تمّ إضافة الفاتورة بنجاح :',
            'user'=>Auth::user()->name,

        ];
    }
}
