<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/')}}" {{(Request::has('admin/')) ? 'active': ''}}>
                    <i class="icon-speedometer"></i> {{__('lang.dashboard')}} </a>
            </li>

            <li class="nav-title">
                {{trans('lang.books_menu')}}
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link {{(Request::has('admin/categories*')) ? 'active': ''}}" href="{{ url('admin/categories') }}">
                    <i class="fa fa-list"></i> {{trans('lang.category_plural')}}</a>
            </li>

            {{-- Users and Permissions --}}
            <li class="nav-title">
                {{trans('lang.users_permissions')}}
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle {{(Request::has('admin/users/*')) ? 'active': ''}}" href="#"><i
                        class="icon-puzzle"></i> {{trans('lang.users_label')}}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{(Request::has('admin/users')) ? 'active': ''}}"
                            href="{{url('admin/users/')}}"><i class="icon-puzzle"></i> {{trans('lang.users_list')}} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{(Request::has('admin/users/create')) ? 'active': ''}}"
                            href="{{url('admin/users/create')}}"><i class="icon-puzzle"></i> {{trans('lang.user_add')}}
                        </a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item nav-dropdown {{ Request::is('admin/permissions*') || Request::is('admin/roles*') ? 'menu-open' : '' }}">
                <a class="nav-link nav-dropdown-toggle {{ Request::is('admin/permissions*') || Request::is('admin/roles*') ? 'active' : '' }}"
                    href="#">
                    <i class="icon-puzzle"></i> {{trans('lang.permission_menu')}}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/permissions') ? 'active' : '' }}"
                            href="{!! url('admin/permissions') !!}">
                            <i class="icon-puzzle"></i> {{trans('lang.permission')}} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/roles') ? 'active' : '' }}"
                            href="{!! url('admin/roles') !!}"><i class="icon-puzzle"></i> {{trans('lang.role')}} </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>



