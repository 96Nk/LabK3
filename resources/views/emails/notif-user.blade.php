<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>{{ $mailData['title'] }}</h1>
<p>{{ $mailData['body'] }}</p>
<table>
    <tr>
        <td>Username</td>
        <td>:</td>
        <td>{{ $mailData['username'] }}</td>
    </tr>
    <tr>
        <td>Password</td>
        <td>:</td>
        <td>{{ $mailData['password'] }}</td>
    </tr>
</table>
</body>
</html>
