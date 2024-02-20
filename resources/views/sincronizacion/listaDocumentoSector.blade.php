<x-layouts.sincronizacion2>
    <x-slot name="table_header">
        <tr>
            <th>C&oacute;digo Clasificador</th>
            <th>Descripcion</th>
            <th>Transaccion</th>
        </tr>
    </x-slot>
    @slot('table_data', $motivoAnulaciones)
    <x-slot name="accion">
        sincronizarListaActividadesDocumentoSector
    </x-slot>
</x-layouts.sincronizacion2>
