<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingRequestNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable) {
        return (new MailMessage)
                    ->subject('طلب حجز جديد')
                    ->line('تم إنشاء طلب حجز جديد لقاعة ' . $this->booking->hall->name)
                    ->action('عرض التفاصيل', route('my-halls.booking-requests'))
                    ->line('شكراً لاستخدام منصتنا!');
    }
}