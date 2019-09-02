<?php

namespace Tickets\Notifications\Calls;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CallUpdateNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($responsible, $call)
  {
    $this->responsible = $responsible;
    $this->call = $call;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
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
      ->from('reply@gmail.com', config('app.name'))
      ->subject(config('app.name') . ' - Chamado Atualizado')
      ->markdown('notifications.callUpdateNotification', ['client' => $this->responsible, 'call' => $this->call]);
  }
}
