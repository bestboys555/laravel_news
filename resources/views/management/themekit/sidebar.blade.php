<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{ url('management') }}">
            <div class="logo-img">
                <img src="/images/logo_mobile.svg" class="header-brand-img" alt="lavalite">
            </div>
            <span class="text">Admin</span>
        </a>
        <button type="button" class="nav-toggle" route-data="{{ route('profile.Updatehidden_menu') }}"><i data-toggle="{{ Auth::user()->hidden_menu === "1" ? "collapsed" : "expanded" }}"
                class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">Navigation</div>
                <div class="nav-item {{ (request()->routeIs('news*') or request()->routeIs('admin_home')) ? 'active open' : '' }}">
                    <a href="{{ url('management') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                </div>
@canany([
'news-list', 'news-create', 'news-edit', 'news-delete',
'category_news-list', 'category_news-create', 'category_news-edit', 'category_news-delete'
])
                <div class="nav-item has-sub {{ (request()->routeIs('news*') or request()->routeIs('category_news*')) ? 'active open' : '' }}">
                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>management</span></a>
                    <div class="submenu-content">
@canany([
'news-list', 'news-create', 'news-edit', 'news-delete'
])
<?php $url_segment_cat = Request::segment(4) ?>
<a href="{{ route('news.index') }}" class="menu-item {{ (request()->routeIs('news.index','news.create','news.edit','news.show') and (!request()->routeIs('news.category'))) ? 'active' : '' }}">News Management</a>
<div class="nav-item has-sub {{ (request()->routeIs('news.category','news.edit_ref','news.create_ref')) ? 'open' : '' }}">
    <a href="javascript:void(0)" class="menu-item {{ (request()->routeIs('news.category','news.edit_ref','news.create_ref')) ? 'active' : '' }}">Choose Category</a>
    <div class="submenu-content" style="">
        @foreach (get_table_all('news_category') as $value)
        <a href="{{ route('news.category', ['id' => $value->id]) }}" class="menu-item {{ (($value->id==$url_segment_cat)) ? 'active' : '' }}">{{ $value->name }}</a>
        @endforeach
    </div>
</div>

@endcan
@canany([
'category_news-list', 'category_news-create', 'category_news-edit', 'category_news-delete'
])
<a href="{{ route('category_news.index') }}" class="menu-item {{ (request()->routeIs('category_news*')) ? 'active' : '' }}">News Category Management</a>
@endcan
                    </div>
                </div>
@endcan
@canany([
'user-list', 'user-create', 'user-edit', 'user-delete',
'role-list', 'role-create', 'role-edit', 'role-delete',
'perm-list', 'perm-create', 'perm-edit', 'perm-delete'
])
                <div class="nav-lavel">Users and Role</div>
                <div class="nav-item has-sub {{ (request()->routeIs('users*') or request()->routeIs('roles*') or request()->routeIs('perm*')) ? 'active open' : '' }}">
                    <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Users and Role</span></a>
                    <div class="submenu-content">
@canany([
    'user-list', 'user-create', 'user-edit', 'user-delete'
])
                        <a href="{{ route('users.index') }}" class="menu-item {{ (request()->routeIs('users*')) ? 'active' : '' }}">Users Management</a>
@endcan
@canany([
    'role-list', 'role-create', 'role-edit', 'role-delete'
])
                        <a href="{{ route('roles.index') }}" class="menu-item {{ (request()->routeIs('roles*')) ? 'active' : '' }}">Role Management</a>
@endcan
@canany([
    'perm-list', 'perm-create', 'perm-edit', 'perm-delete'
])
                        <a href="{{ route('perm.index') }}" class="menu-item {{ (request()->routeIs('perm*')) ? 'active' : '' }}">Permision Management</a>
                    </div>
@endcan
                </div>
                @endcan
                <div class="nav-item active">
                    <a href="{!! asset('pages/navbar.html') !!}" target="_blank"><i class="ik ik-award"></i><span>Page teamplate</span></a>
                </div>
            </nav>
        </div>
    </div>
</div>
