@if($configData['mainLayoutType'] == 'vertical-menu')
  <div class="main-menu menu-fixed @if($configData['theme'] === 'light') {{"menu-light"}} @else {{'menu-dark'}} @endif menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row align-items-center">
        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="/">
            <img src="{{asset('images/logo/logo.svg')}}" class="logo img-fluid" width="150" alt="">
          </a>
        </li>
        <li class="nav-item nav-toggle">
          <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
            <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
            <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content mt-2">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
          @if(!empty($menuData[0]) && isset($menuData[0]))
          @foreach ($menuData[0]->menu as $menu)
              @if(isset($menu->navheader))
                  <li class="navigation-header"><span>{{$menu->navheader}}</span></li>
              @else
              <li class="nav-item {{ (request()->is(str_replace('/', '', $menu->url))) || (request()->is($menu->url)) ? 'active' : '' }}">
                  <a href="@if(isset($menu->url)){{asset($menu->url)}} @endif" @if(isset($menu->newTab)){{"target=_blank"}}@endif>
                  @if(isset($menu->icon))
                      <i class="menu-livicon" data-icon="{{$menu->icon}}"></i>
                  @endif
                  @if(isset($menu->name))
                      <span class="menu-title">{{ trans('pages.'.$menu->name)}}</span>
                  @endif
                  @if(isset($menu->tag))
                  <span class="{{$menu->tagcustom}}">{{$menu->tag}}</span>
                  @endif
              </a>
              @if(isset($menu->submenu))
                  @include('panels.sidebar-submenu',['menu' => $menu->submenu])
              @endif
              </li>
              @endif
          @endforeach
          @can('users-view', User::class)
          <li class="nav-item">
            <a href="{{ route('users.index') }}">
              <i class="menu-livicon" data-icon="user"></i>
              <span class="menu-title">{{ trans('pages.users') }}</span>
            </a>
          </li>
        @endcan
          @endif
      </ul>
    </div>
  </div>
@endif