<x-mail::message>

# Recuperar Contraseña

Dale click al siguiente botón para recuperar tu contraseña.

<x-mail::button :url="route('formulario-actualizar-contrasenia', $token)">
Recuperar contraseña
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
