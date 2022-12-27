<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensaje</title>
</head>
<body>
    <h3>Nuevo mensaje recibido</h3> <br>
    <p>Recibiste un mensaje de: {{$contact->name}}</p>
    <p>Correo: {{$contact->email}}</p>
    @if($contact->phone != null)
        <p>Telefono: {{$contact->phone}}</p>
    @endif
    <p> <strong>Mensaje:</strong> {{$contact->message}}</p>
</body>
</html>
