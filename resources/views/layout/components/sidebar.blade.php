<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Shymkent-Visit
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">{{__("admin.main")}}</li>
            <li class="nav-item">
                <a href="{{route("admin-home")}}" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">{{__("admin.main")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.users")}}</li>
            <li class="nav-item">
                <a href="{{route("admin-user.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">{{__("admin.users")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.sliders")}}</li>
            <li class="nav-item">
                <a href="{{route("sliders.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="image"></i>
                    <span class="link-title">{{__("admin.sliders")}}</span>
                </a>
            </li>
{{--            PLaces--}}
            <li class="nav-item nav-category">{{__("admin.places")}}</li>
            <li class="nav-item">
                <a href="{{route("category-place.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="align-justify"></i>
                    <span class="link-title">{{__("admin.places_category")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("places.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="map"></i>
                    <span class="link-title">{{__("admin.places_name")}}</span>
                </a>
            </li>
{{--            Events--}}
            <li class="nav-item nav-category">{{__("admin.events")}}</li>
            <li class="nav-item">
                <a href="{{route("category-events.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="align-justify"></i>
                    <span class="link-title">{{__("admin.event_categories")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("events.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">{{__("admin.events")}}</span>
                </a>
            </li>


{{--Routes--}}
            <li class="nav-item nav-category">{{__("admin.routes_points")}}</li>
            <li class="nav-item">
                <a href="{{route("route_categories.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="align-justify"></i>
                    <span class="link-title">{{__("admin.route_categories")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("route_types.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="align-justify"></i>
                    <span class="link-title">{{__("admin.route_types")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("routes.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="map"></i>
                    <span class="link-title">{{__("admin.routes")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("points.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="map-pin"></i>
                    <span class="link-title">{{__("admin.points")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.organizators")}}</li>
            <li class="nav-item">
                <a href="{{route("organizators.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">{{__("admin.organizators")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.shops")}}</li>
            <li class="nav-item">
                <a href="{{route("shops.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="shopping-cart"></i>
                    <span class="link-title">{{__("admin.shops")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("category-souvenir.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">{{__("admin.souvenir_category")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("souvenirs.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="tag"></i>
                    <span class="link-title">{{__("admin.souvenirs")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.news")}}</li>
            <li class="nav-item">
                <a href="{{route("category-news.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">{{__("admin.category_news")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("news.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">{{__("admin.news")}}</span>
                </a>
            </li>


            <li class="nav-item nav-category">{{__("admin.tags")}}</li>
            <li class="nav-item">
                <a href="{{route("tags.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">{{__("admin.tags")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("blogs.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">{{__("admin.blogs")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.reviews")}}</li>
            <li class="nav-item">
                <a href="{{route("reviews.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="message-circle"></i>
                    <span class="link-title">{{__("admin.reviews")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.partners")}}</li>
            <li class="nav-item">
                <a href="{{route("partners.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">{{__("admin.partners")}}</span>
                </a>
            </li>
            <li class="nav-item nav-category">{{__("admin.contacts")}}</li>
            <li class="nav-item">
                <a href="{{route("phones.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="phone"></i>
                    <span class="link-title">{{__("admin.phones")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("emails.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="framer"></i>
                    <span class="link-title">{{__("admin.emails")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("socials.index")}}" class="nav-link">
                    <i class="link-icon" data-feather="facebook"></i>
                    <span class="link-title">{{__("admin.socials")}}</span>
                </a>
            </li>

            <li class="nav-item nav-category">{{__("admin.backup")}}</li>
            <li class="nav-item">
                <a href="{{route("backup")}}" class="nav-link">
                    <i class="link-icon" data-feather="database"></i>
                    <span class="link-title">{{__("admin.backup")}}</span>
                </a>
            </li>


            <li class="nav-item nav-category">
                <a href="{{route("logout")}}" class="nav-link">
                    <i class="link-icon" data-feather="power"></i>
                    <span class="link-title">{{__("admin.logout")}}</span>
                </a>
            </li>



        </ul>
    </div>
</nav>


<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">Sidebar:</h6>
        <div class="form-group border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
                    Светлая тема/Light theme
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
                    Темная тема/Dark theme
                </label>
            </div>
        </div>

    </div>
</nav>
<!-- partial -->
