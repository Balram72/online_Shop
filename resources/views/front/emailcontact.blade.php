<!DOCTYPE html>
<html>
<head>
    <title>Contact Message</title>
</head>
<body>
    <p>You have received a new message from {{ htmlspecialchars($name) }} </p>
     <p> Email:  {{ htmlspecialchars($email) }}</p>
     {{-- <p>{{ $message }}</p> --}}
</body>
</html>