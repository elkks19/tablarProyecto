@if(request()->query('trashed') == 'true')
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').$crud->route.'?trashed=false') }}"
        class="btn btn-primary">Ver Activos</a>
@else
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').$crud->route.'?trashed=true') }}"
        class="btn btn-warning"> Ver Eliminados </a>
@endif
