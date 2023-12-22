<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ $newCount }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $newCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notify)
            {{-- @dd($notifications) --}}
            <a href="?notification_id={{ $notify->id }}" style="overflow: hidden"
                class="dropdown-item  @if ($notify->unRead()) text-bold @endif">
                <i class="{{ $notify->data['icon'] }} mr-2"></i> {{ $notify->data['body'] }}
                <span
                    class="float-right text-muted text-sm overflow-hidden">{{ $notify->created_at->diffForHumans() }}</span>
            </a>
            <div class="dropdown-divider"></div>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
