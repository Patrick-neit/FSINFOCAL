<x-layouts.sincronizacion>
    <x-slot name="table_header">
        <tr>
            <th>C&oacute;digo Actividad</th>
            <th>C&oacute;digo Doc Sector</th>
            <th>Tipo Documento Sector</th>
            <th>Transaccion</th>
        </tr>
    </x-slot>
    @slot('table_data', $documentoSector)
    <x-slot name="accion">
        sincronizarListaActividadesDocumentoSector
    </x-slot>
</x-layouts.sincronizacion>