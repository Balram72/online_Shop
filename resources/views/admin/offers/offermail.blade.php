<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fall Sale</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #ff6666;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #ff6666; width: 100%; max-width: 600px; margin: auto;">
        <tr>
            <td style="padding: 20px; text-align: center; color: white;">
                <h1 style="margin: 0; font-size: 2em;">{{ $title }}</h1>
                <p style="margin: 10px 0 20px; font-size: 1.2em;">Start Date: {{ $start_date }} | End Date: {{ $end_date }}</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #fff;">
                <img src="{{ $message->embed(storage_path('app/public/media/offers/' . $image)) }}" alt="Gift Box" style="max-width: 100%; height: auto;">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #ff6666; color: white;">
                <p style="margin: 0; font-size: 1.5em;">{{ $description }}</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #ff6666;">
                <a href="{{ url('../../') }}" style="display: inline-block; padding: 10px 20px; font-size: 1.2em; color: #ff6666; background-color: white; text-decoration: none; border-radius: 5px;">Shop Now</a>
            </td>
        </tr>
    </table>
</body>
</html>

