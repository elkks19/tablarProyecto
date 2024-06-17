{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Categorias" icon="la la-list" :link="backpack_url('categoria?trashed=false')" />
<x-backpack::menu-item title="Divisas" icon="la la-money-bill-wave-alt" :link="backpack_url('divisa?trashed=false')" />
<x-backpack::menu-item title="Metodo pagos" icon="la la-wallet" :link="backpack_url('metodo-pago?trashed=false')" />
<x-backpack::menu-item title="Roles" icon="la la-user-check" :link="backpack_url('role?trashed=false')" />
<x-backpack::menu-item title="Ordenes" icon="la la-clipboard" :link="backpack_url('orden?trashed=false')" />
<x-backpack::menu-item title="Productos" icon="la la-question" :link="backpack_url('producto?trashed=false')" />
<x-backpack::menu-item title="Reviews" icon="la la-commentcommentss" :link="backpack_url('review?trashed=false')" />
<x-backpack::menu-item title="Usuarios" icon="la la-users" :link="backpack_url('user?trashed=false')" />
