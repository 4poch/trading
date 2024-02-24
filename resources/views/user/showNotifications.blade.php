
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    


<!-- Notification Bell Button -->
<div class="bell">
    <h1><i class="fas fa-bell"></i > Notifications</h1>
    <!-- Notification Popup -->
    <div class="notify">
        @if($notifications->isEmpty())
            <p>No notifications available.</p>
        @else
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item">
                        <strong>{{ $notification->subject }}</strong><br>
                        {{ $notification->message }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

