<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    <h2>Contact Message from {{ $data['name'] }}</h2>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
