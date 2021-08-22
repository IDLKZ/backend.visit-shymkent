<!-- partial:partials/_navbar.html -->
<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle font-weight-bold text-black-100 text-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{LaravelLocalization::getCurrentLocaleName()}}
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{auth()->user()->getFile("image")}}" alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="{{auth()->user()->getFile("image")}}" alt="">
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{auth()->user()->name}}</p>
                            <p class="email text-muted mb-3">{{auth()->user()->email}}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{route("admin-user.show",auth()->id())}}" class="nav-link">
                                    <i data-feather="user"></i>
                                    <span>{{auth()->user()->name}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("admin-user.edit",auth()->id())}}" class="nav-link">
                                    <i data-feather="edit"></i>
                                    <span>{{__("admin.settings")}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("admin-user.show",auth()->id())}}" class="nav-link">
                                    <i data-feather="pen-tool"></i>
                                    <span>{{__("admin.info")}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("logout")}}" class="nav-link">
                                    <i data-feather="power"></i>
                                    <span>{{__("admin.logout")}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
