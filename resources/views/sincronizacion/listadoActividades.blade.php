<x-layouts.sincronizacion2>
    <x-slot name="table_header">
        <tr>
            <th>C&oacute;digo Caeb</th>
            <th>Descripcion</th>
            <th>Tipo Actividad</th>
            <th>Transaccion</th>
        </tr>
    </x-slot>
    @slot('table_data', $actividades)
    <x-slot name="accion">
        {{ config('sistema.sincActividades') }}
    </x-slot>
</x-layouts.sincronizacion2>