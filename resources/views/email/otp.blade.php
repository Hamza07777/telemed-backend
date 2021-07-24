<!DOCTYPE html>
<html>
<head>
    <title>OTP</title>
</head>
<body>
    @isset($details['title'])
    <h1>{{ $details['title'] }}</h1>
    @endisset
    <p>{{ $details['body'] }}</p>

    <p>Thank you</p>
</body>
</html>
