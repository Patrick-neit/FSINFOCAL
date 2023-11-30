<x-layouts.sincronizacion>
    <x-slot name="table_header">
        <tr>
            <th>C&oacute;digo Actividad</th>
            <th>Descripcion</th>
            <th>Transaccion</th>
        </tr>
    </x-slot>
    @slot('table_data', $leyendasFactura)
    <x-slot name="accion">
        {{ config('sistema.sincLeyendas') }}
    </x-slot>
</x-layouts.sincronizacion>