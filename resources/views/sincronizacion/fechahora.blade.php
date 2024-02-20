<x-layouts.sincronizacion2>
    <x-slot name="table_header">
        <tr>
            <th>Fecha y Hora</th>
            <th>Transaccion</th>
        </tr>
    </x-slot>
    @slot('table_data', $impuestosFechaHora)
    <x-slot name="accion">
        {{ config('sistema.sincFechaHora') }}
    </x-slot>
</x-layouts.sincronizacion2>