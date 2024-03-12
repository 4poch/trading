<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Test Email</title>
</head>
<body>
    <h2>Send Test Email</h2>
    <form action="{{ route('send.email') }}" method="post">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Send Email</button>
    </form>
</body>
</html>
