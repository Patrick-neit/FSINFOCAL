<div class="responsive-table">
    <div class="row">
        <div class="col s12">
            <div class="right-align">
                <!-- create invoice button-->
                <div class="invoice-create-btn">
                    <button id="sincronizacion"
                        class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                        <i class="material-icons">autorenew</i>
                        <span class="hide-on-small-only">Sincronizar</span>
                    </button>
                </div> <br>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            {{ $table_header }}
        </thead>
        <tbody>
            @forelse ($table_data as $data)
            <tr>
                @foreach ($data->toArray() as $key => $value)
                @if ($key != 'id')
                @if ($key != 'nandina')
                <td>{{ $value }}</td>
                @endif
                @endif
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">
                    No hay registros para mostrar
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>