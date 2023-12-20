<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;


    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddresses;
        return (new MailMessage)
            ->subject("New order #{$this->order->number}")
            ->greeting("Hi {$notifiable->name},")
            ->line("A new order (#{$this->order->numbe}) created by {$addr->name} from {{$addr->country_name}}.")
            ->action('View Order', url('/dashboard'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the Database representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        $addr = $this->order->billingAddresses;
        return [
            'body' => "A new order (#{$this->order->numbe}) created by {$addr->name} from {{$addr->country_name}}.",
            'icon' => 'fas fa file',
            'url' => url('/'),
            'order_id' => $this->order->id,
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
