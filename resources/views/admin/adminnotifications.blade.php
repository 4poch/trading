<!DOCTYPE html>
<html>
<head>
    <title>Send Notification</title>
</head>
<body>
    <h2>Send Notification to All Users</h2>
    <form method="POST" action="{{ route('send.notification') }}">
        @csrf
        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subject"><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message"></textarea><br><br>
        <button type="submit">Send Notification</button>
    </form>
</body>
</html>
