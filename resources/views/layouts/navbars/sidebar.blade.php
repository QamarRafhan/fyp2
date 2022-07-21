<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('Dashboard') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="{{ ($activePage == 'profile' || $activePage == 'user-management') ? 'true' : 'false' }}">
          <i class="material-icons">people_outline</i>
          <p>{{ __('Users') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse  {{ ($activePage == 'profile' || $activePage == 'user-management')? ' show' : '' }} " id="users">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($activePage == 'category-management' || $activePage == 'category.create') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#sidebar-prodcuts" aria-expanded="{{ ($activePage == 'category-management' || $activePage == 'category.create') ? 'true' : 'false' }}">
          <i class="material-icons">people_alt</i>
          <p>{{ __('category') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'category-management' || $activePage == 'category.create')? ' show' : '' }} " id="sidebar-prodcuts">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'category-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category.index') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('ALL Categorys') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'category.create' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category.create') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('Add Category') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

    </ul>
  </div>
</div>