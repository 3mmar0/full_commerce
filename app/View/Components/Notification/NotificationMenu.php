<?php

namespace App\View\Components\Notification;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    public $notifications;
    /**
     * Create a new component instance.
     */
    public function __construct($notifications)
    {
        $user = Auth::user();
        $this->notifications = $user->notifications;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification.notification-menu');
    }
}
