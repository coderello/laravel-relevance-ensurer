<p align="center"><img alt="Laravel Relevance Ensurer" src="https://i.imgur.com/AytDebo.png" width="500"></p>

<p align="center"><b>Laravel Relevance Ensurer</b> provides an easy way not to process notifications and jobs which became irrelevant.</p>

## Install

You can install this package via composer using this command:

```bash
composer require coderello/laravel-relevance-ensurer
```

## Usage

Let's assume we are a meetup organizing platform. And we have to remind all participants of the meetup 48 hours before it starts.

Huh, looks like it is easy. Few lines of code.

```php
$user->notify(
    (new MeetupReminder($meetup))
        ->delay($meetup->starts_at->subHours(48))
);
```

But what if the user leaves the meetup? In this case, we should prevent the notification from being sent.

Here **Laravel Relevance Ensurer** comes to help.

The only thing we need to do is to implement `ShouldBeRelevantNotification` contract on the notification. It comes with one public method `isRelevant($notifiable)` which should return bool representing relevance of the notification before one is sent.

Let's take a look at an example:

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification; 
use Illuminate\Contracts\Queue\ShouldQueue;
use Coderello\RelevanceEnsurer\Contracts\ShouldBeRelevantNotification;
use App\Models\Meetup;
use Illuminate\Queue\SerializesModels;

class MeetingReminder extends Notification implements ShouldQueue, ShouldBeRelevantNotification
{
    use Queueable, SerializesModels;

    public $meetup;

    public function __construct(Meetup $meetup)
    {
        $this->meetup = $meetup;
    }

    public function isRelevant($notifiable): bool
    {
        return $this->meetup->users()->where('id', $notifiable)->exists();
    }

    public function toMail($notifiable)
    {
        // returns the mail representation of the notification
    }
}
```

So if the notification is relevant, it'll be sent and vice versa.

Almost the same contract exists for jobs. The only difference is that ShouldBeRelevantJob's isRelevant() method doesn't accept any arguments.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
