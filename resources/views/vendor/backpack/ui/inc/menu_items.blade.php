{{-- File: resources/views/vendor/backpack/ui/inc/menu_items.blade.php --}}

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>

{{-- Tampilkan menu Users hanya jika role adalah admin --}}
@if(backpack_user()->role == 'admin')
    <x-backpack::menu-item title="Users" icon="la la-users" :link="backpack_url('user')" />
@endif

<x-backpack::menu-item title="Tasks" icon="la la-tasks" :link="backpack_url('task')" />
