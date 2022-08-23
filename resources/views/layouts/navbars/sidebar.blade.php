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
        <a class="nav-link" data-toggle="collapse" href="#sidebar-category" aria-expanded="{{ ($activePage == 'category-management' || $activePage == 'category.create') ? 'true' : 'false' }}">
          <i class="material-icons">category</i>
          <p>{{ __('category') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'category-management' || $activePage == 'category.create')? ' show' : '' }} " id="sidebar-category">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'category-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category.index') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('ALL Categories') }} </span>
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

      <li class="nav-item {{ ($activePage == 'company-management' || $activePage == 'company.create') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#sidebar-company" aria-expanded="{{ ($activePage == 'company-management' || $activePage == 'company.create') ? 'true' : 'false' }}">
          <i class="material-icons">business</i>
          <p>{{ __('company') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'company-management' || $activePage == 'company.create')? ' show' : '' }} " id="sidebar-company">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'company-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('company.index') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('ALL Companies') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'company.create' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('company.create') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('Add Company') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($activePage == 'vehicle-management' || $activePage == 'vehicle.create') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#sidebar-Vehicle" aria-expanded="{{ ($activePage == 'vehicle-management' || $activePage == 'vehicle.create') ? 'true' : 'false' }}">
          <i class="material-icons">directions_car</i>
          <p>{{ __('vehicle') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'vehicle-management' || $activePage == 'vehicle.create')? ' show' : '' }} " id="sidebar-Vehicle">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'vehicle-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('vehicle.index') }}">
                <span class="sidebar-mini"> AV </span>
                <span class="sidebar-normal"> {{ __('ALL Vehicles') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'vehicle.create' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('vehicle.create') }}">
                <span class="sidebar-mini"> AV </span>
                <span class="sidebar-normal"> {{ __('Add Vehicle') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>



      <li class="nav-item {{ ($activePage == 'repairingRequets-management' || $activePage == 'repairingRequets.create') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#sidebar-RepairingRequets" aria-expanded="{{ ($activePage == 'repairingRequets-management' || $activePage == 'repairingRequets.create') ? 'true' : 'false' }}">
          <i class="material-icons">handyman</i>
          <p>{{ __('Repairing Requets') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'repairingRequets-management' || $activePage == 'repairingRequets.create')? ' show' : '' }} " id="sidebar-RepairingRequets">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'repairingRequets-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('repairing_requet.index') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('ALL Repairing Requets') }} </span>
              </a>
            </li>
            <!-- <li class="nav-item{{ $activePage == 'repairingRequets.create' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('repairing_requet.create') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('Add Repairing Requet') }} </span>
              </a>
            </li> -->
          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($activePage == 'payment-management' )? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#payment-management" aria-expanded="{{ ($activePage == 'payment-management' ) ? 'true' : 'false' }}">
          <i class="material-icons">handyman</i>
          <p>{{ __('Payments') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'payment-management')? ' show' : '' }} " id="payment-management">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'payment-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('payment.index') }}">
                <span class="sidebar-mini"> AC </span>
                <span class="sidebar-normal"> {{ __('ALL Payments') }} </span>
              </a>
            </li>
           
          </ul>
        </div>
      </li>


    </ul>
  </div>
</div>