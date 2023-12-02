<x-layouts.sincronizacion>
    <x-slot name="table_header">
        <tr>
            <th>C&oacute;digo Clasificador</th>
            <th>Descripcion</th>
            <th>Transaccion</th>
        </tr>
    </x-slot>
    @slot('table_data', $unidadMedida)
    <x-slot name="accion">
        {{ config('sistema.sincUnidadMedida') }}
    </x-slot>
</x-layouts.sincronizacion>