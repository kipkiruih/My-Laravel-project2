<!DOCTYPE html>
<html>
<head>
    <title>New Property Inquiry</title>
</head>
<body>
    <h3>New Inquiry for {{ $property->title }}</h3>
    <p><strong>Name:</strong> {{ $request->name }}</p>
    <p><strong>Email:</strong> {{ $request->email }}</p>
    <p><strong>Phone:</strong> {{ $request->phone }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $request->message }}</p>

    <p>Best Regards,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
