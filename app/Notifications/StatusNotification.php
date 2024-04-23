<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class StatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, $status, $remark, $application_type, $applicant_name, $application_date)
    {
        $this->user = $user;
        $this->status = $status;
        $this->remark = $remark;
        $this->application_type = $application_type;
        $this->applicant_name = $applicant_name;
        $this->application_date = $application_date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
        ->greeting('Dear, ' . $this->user->name)
        ->line('Your application status changed to '. $this->status);

        if ($this->remark) {
            $mailMessage->line('Remark: ' . $this->remark);
        }
        $mailMessage ->line('Application Type: ' . $this->application_type)
        ->line('Applicant Name: ' . $this->applicant_name)
        ->line('Application Date: ' . $this->application_date)
        ->line('Do not reply to this mail. If you have any query, please write to info@blarkafin.com.')
        ->action('Click here to Login', url('/login'))
        ->salutation("Regards, \r\n Team Blarkafin");

        return $mailMessage;
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
