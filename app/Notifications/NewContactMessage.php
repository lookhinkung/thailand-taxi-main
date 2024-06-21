<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification implements ShouldQueue
{
    use Queueable;

    private $contactData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You got a new contact message.')
                    ->line('Name: ' . $this->contactData['name'])
                    ->line('Email: ' . $this->contactData['email'])
                    ->line('Phone: ' . $this->contactData['phone'])
                    ->line('Subject: ' . $this->contactData['subject'])
                    ->line('Message: ' . $this->contactData['message'])
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->contactData['name'],
            'email' => $this->contactData['email'],
            'phone' => $this->contactData['phone'],
            'subject' => $this->contactData['subject'],
            'message' => $this->contactData['message'],
        ];
    }
}
