<x-layouts.sincronizacion>
    <x-slot name="table_header">
        <tr>
            <th>C&oacute;digo Actividad</th>
            <th>C&oacute;digo Producto</th>
            <th>Descripcion</th>
            <th>Transaccion</th>
        </tr>
    </x-slot>
    @slot('table_data', $productosServicios)
    <x-slot name="accion">
        {{ config('sistema.sincProductosServicios') }}
    </x-slot>
</x-layouts.sincronizacion>