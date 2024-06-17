@if($entry->trashed())
    <a class="btn btn-sm btn-link" onclick="confirmarRestaurar()">
        <i class="la la-trash-restore-alt"></i> Restaurar
    </a>

    <script>
        function confirmarRestaurar() {
            swal({
                title: "Advertencia",
                text: "¿Está seguro que desea restaurar este elemento?",
                icon: "info",
                buttons: true,
            }).then((willRestore) => {
                if (willRestore)
                    window.location.href="{{ url($crud->route.'/'.$entry->getKey().'/restore') }}"
            });
        }
    </script>
@endif
