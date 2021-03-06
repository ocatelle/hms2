<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
      @hasSection('pageTitle')
        @yield('pageTitle') |
      @endif
      {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/5fd8ad5172.js"></script>

    <!-- fav icons -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
</head>
<body class="with-footer">
  <header>
    <div class="row expanded header">
      <div class="columns shrink">
        <a href="/">
          <!-- Hackspace logo SVG -->
          <svg version="1.1" x="0px" y="0px" width="75" height="75" viewBox="0 0 220 220" enable-background="new 0 0 223.489 220.489" id="logo">
            <path id="logo-path"
                  d="m 187.42396,32.576354 c -42.87821,-42.874396 -112.393767,-42.874396 -155.264347,0 -42.879484,42.878211 -42.879484,112.391236 0,155.266896 42.87058,42.87567 112.389957,42.87567 155.264347,0 42.87567,-42.87566 42.87567,-112.388685 0,-155.266896 z m -34.95429,114.891786 -25.04366,-25.03984 7.87686,-7.87687 -4.16546,-4.1642 -21.17074,21.17201 4.16037,4.16801 8.15287,-8.15668 25.05002,25.04113 -37.53878,37.53878 -25.046204,-25.04239 4.272304,-4.26849 -29.852708,-29.85653 -4.277392,4.27358 -25.039847,-25.04366 37.540057,-37.540065 25.041119,25.041119 -8.157951,8.155416 5.127019,5.12575 21.177093,-21.17329 -5.12448,-5.125747 -7.881947,7.880677 -25.042386,-25.043663 37.266593,-37.260239 25.0373,25.041119 -4.26721,4.273576 29.85144,29.853979 4.27485,-4.273576 25.04111,25.044944 z" />
          </svg>
        </a>
      </div>
      <div class="columns">
        <div class="row expanded">
          <div class="small-12 medium-expand columns">
            @hasSection('pageTitle')
              <h1 class="tiny-header"><a href="/">Nottingham Hackspace</a></h1>
              <h2 class="big-header">@yield('pageTitle')</h2>
            @else
              <h1><a href="/">Nottingham Hackspace</a></h1>
            @endif
          </div>
          @can('search.users')
            <div class="small-12 medium-4 columns">
                  @include('partials.memberSearch')
            </div>
          @endcan
        </div>
      </div>
    </div>

    <div class="row expanded align-middle userbar">
      @if (!Auth::guest() and isset($mainNav) )
        {{-- build the menu toggle for small screens --}}
        <div class="mobile-menu-button columns hide-for-medium">
          <button data-toggle="mobile-menu" type="button"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
        </div>

        {{-- build the meu for medium+ screens --}}
        <div class="columns show-for-medium" id="main-menu">
          <ul class="dropdown menu" data-dropdown-menu>
            @foreach ($mainNav as $link)
              <li{!! $link['active'] ? ' class="active"' : '' !!}><a href="{{ $link['url'] }}">{{ $link['text'] }}</a>
                @if ( count($link['links']) > 0 )
                  <ul class="menu submenu">
                    @foreach ($link['links'] as $subLink)
                      <li{!! $subLink['active'] ? ' class="active"' : '' !!}><a href="{{ $subLink['url'] }}">{{ $subLink['text'] }}</a></li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      <ul class="columns menu align-right">
        @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Log In</a></li>
        @if (SiteVisitor::inTheSpace())
        <li><a href="{{ route('registerInterest') }}">Register Interest</a></li>
        @endif
        @else
        <li>Logged in as {{ Auth::user()->getFirstName() }} @if (Auth::viaRemember()) (via Remember Me) @endif</li>
        <li>
          <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
        @endif
      </ul>
    </div>
  </header>

{{-- build the menu for small screens --}}
<div id="mobile-menu" data-toggler="show-mobile-menu">
  <ul class="vertical menu" data-accordion-menu>
    @foreach ($mainNav as $link)
      <li{!! $link['active'] ? ' class="active"' : '' !!}><a href="{{ $link['url'] }}">{{ $link['text'] }}</a>
        @if ( count($link['links']) > 0 )
          <ul class="vertical nested menu">
            @foreach ($link['links'] as $subLink)
              <li{!! $subLink['active'] ? ' class="active"' : '' !!}><a href="{{ $subLink['url'] }}">{{ $subLink['text'] }}</a></li>
            @endforeach
          </ul>
        @endif
      </li>
    @endforeach
  </ul>
</div>

<!-- main body -->
<div class="content">

  @include('partials.flash')


  <div class="row align-top">
    <div class="small-12 medium-expand columns">
      @yield('content')
    </div>

    <div class="row">
      @include('cookieConsent::index')
    </div>
  </div>
</div>

  <!-- footer -->
  <footer>
    <div class="row expanded footer">
      <div class="columns small-12 medium-3">
        <ul class="nomarkers">
          <li>HMS Version 2.0.0</li>
          <li><a href="http://github.com/nottinghack/hms2">Get Source</a></li>
          <li><a href="#">Credits</a></li>
          <li><a href="http://www.nottinghack.org.uk">Nottinghack Website</a></li>
          <li class="copyright">&copy; 2016 Nottinghack</li>
        </ul>
      </div>
      <div class="columns small-12 medium-3">
        <ul class="nomarkers">
          <li><a href="#"><i class="fa fa-fw fa-twitter"></i>&nbsp;Twitter</a></li>
          <li><a href="#"><i class="fa fa-fw fa-envelope"></i>&nbsp;Google Group</a></li>
          <li><a href="#"><i class="fa fa-fw fa-flickr"></i>&nbsp;Flickr</a></li>
          <li><a href="#"><i class="fa fa-fw fa-youtube"></i>&nbsp;YouTube</a></li>
          <li><a href="#"><i class="fa fa-fw fa-facebook"></i>&nbsp;Facebook</a></li>
        </ul>
      </div>
      <div class="columns small-12 medium-3">
        <ul class="nomarkers">
          <li>Nottingham Hackspace Ltd</li>
          <li>No. 07766826</li>
          <li>Reg. in England &amp; Wales</li>
        </ul>
      </div>
      <div class="columns small-12 medium-3">
        <address>
          Unit F6 BizSpace<br />
          Roden House<br />
          Business Centre<br />
          Nottingham<br />
          NG3 1JH
        </address>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <script src="{{ mix('/js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>

  @stack('scripts')
</body>
</html>
