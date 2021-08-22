@extends("layout.app")


@section("content")

<div class="container my-4 py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary h-100 my-2">
                <div class="card-body text-white">
                    <h5 class="card-title text-white">
                        {{__("admin.users")}}</h5>
                    <div class="d-flex">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-user" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 align-items-center">
                            <p>{{__("admin.all_users")}} : {{\App\Models\User::count()}}</p>
                            <p>{{__("admin.admin")}} : {{\App\Models\User::where("role_id",1)->count()}}</p>
                            <p>{{__("admin.moderator")}} : {{\App\Models\User::where("role_id",2)->count()}}</p>
                            <p>{{__("admin.usual_user")}} : {{\App\Models\User::where("role_id",3)->count()}}</p>
                            <p>{{__("admin.guide")}} : {{\App\Models\User::where("role_id",4)->count()}}</p>
                            <p>{{__("admin.tour_agency")}} : {{\App\Models\User::where("role_id",5)->count()}}</p>
                            <p>{{__("admin.craft")}} : {{\App\Models\User::where("role_id",6)->count()}}</p>
                            <p>{{__("admin.craftman")}} : {{\App\Models\User::where("role_id",7)->count()}}</p>
                            <p>{{__("admin.active")}} : {{\App\Models\User::where("status",1)->count()}}</p>
                            <p>{{__("admin.non_active")}} : {{\App\Models\User::where("status",0)->count()}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success h-100 my-2">
                <div class="card-body text-white ">
                    <h5 class="card-title text-white">
                        {{__("admin.sliders")}}</h5>
                    <div class="d-flex align-self-center h-100">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-image" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <div>
                                <p>{{__("admin.sliders")}} : {{\App\Models\Slider::count()}}</p>
                                <p>{{__("admin.active")}} : {{\App\Models\Slider::where("status",1)->count()}}</p>
                                <p>{{__("admin.non_active")}} : {{\App\Models\Slider::where("status",0)->count()}}</p>
                                <p>{{__("admin.on_moderation")}} : {{\App\Models\Slider::where("status",-1)->count()}}</p>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
{{--        2 Row--}}
        <div class="col-md-6">
            <div class="card text-white bg-primary h-100 my-2">
                <div class="card-body text-white">
                    <h5 class="card-title text-white">
                        {{__("admin.places")}}</h5>
                    <div class="d-flex">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-map" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 align-items-center">
                            <p>{{__("admin.places")}} : {{\App\Models\Place::where("type_id",2)->count()}}</p>
                            <p>{{__("admin.active")}} : {{\App\Models\Place::where("status",1)->where("type_id",1)->count()}}</p>
                            <p>{{__("admin.non_active")}} : {{\App\Models\Place::where("status",0)->where("type_id",1)->count()}}</p>
                            <p>{{__("admin.on_moderation")}} : {{\App\Models\Place::where("status",-1)->where("type_id",1)->count()}}</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success h-100 my-2">
                <div class="card-body text-white ">
                    <h5 class="card-title text-white">
                        {{__("admin.events")}}</h5>
                    <div class="d-flex align-self-center h-100">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-calendar-check" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <div>
                                <p>{{__("admin.events")}} : {{\App\Models\Event::count()}}</p>
                                <p>{{__("admin.active")}} : {{\App\Models\Event::where("status",1)->count()}}</p>
                                <p>{{__("admin.non_active")}} : {{\App\Models\Event::where("status",0)->count()}}</p>
                                <p>{{__("admin.on_moderation")}} : {{\App\Models\Event::where("status",-1)->count()}}</p>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{--        3 Row--}}
        <div class="col-md-6">
            <div class="card text-white bg-primary h-100 my-2">
                <div class="card-body text-white">
                    <h5 class="card-title text-white">
                        {{__("admin.routes")}}</h5>
                    <div class="d-flex">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-map-signs" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 align-items-center">
                            <p>{{__("admin.places")}} : {{\App\Models\Route::count()}}</p>
                            <p>{{__("admin.active")}} : {{\App\Models\Route::where("status",1)->count()}}</p>
                            <p>{{__("admin.non_active")}} : {{\App\Models\Route::where("status",0)->count()}}</p>
                            <p>{{__("admin.on_moderation")}} : {{\App\Models\Route::where("status",-1)->count()}}</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success h-100 my-2">
                <div class="card-body text-white ">
                    <h5 class="card-title text-white">
                        {{__("admin.points")}}</h5>
                    <div class="d-flex align-self-center h-100">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-map-marker" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <div>
                                <p>{{__("admin.points")}} : {{\App\Models\Place::where("type_id",2)->count()}}</p>
                                <p>{{__("admin.active")}} : {{\App\Models\Place::where("type_id",2)->where("status",1)->count()}}</p>
                                <p>{{__("admin.non_active")}} : {{\App\Models\Place::where("type_id",2)->where("status",0)->count()}}</p>
                                <p>{{__("admin.on_moderation")}} : {{\App\Models\Place::where("type_id",2)->where("status",-1)->count()}}</p>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
{{--        4 Row--}}
        <div class="col-md-6">
            <div class="card text-white bg-primary h-100 my-2">
                <div class="card-body text-white">
                    <h5 class="card-title text-white">
                        {{__("admin.guide")}}</h5>
                    <div class="d-flex">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-user-circle" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 align-items-center">
                            <p>{{__("admin.guide")}} : {{\App\Models\Organizator::where("role_id",4)->count()}}</p>
                            <p>{{__("admin.active")}} : {{\App\Models\Organizator::where("role_id",4)->where("status",1)->count()}}</p>
                            <p>{{__("admin.non_active")}} : {{\App\Models\Organizator::where("role_id",4)->where("status",0)->count()}}</p>
                            <p>{{__("admin.on_moderation")}} : {{\App\Models\Organizator::where("role_id",4)->where("status",-1)->count()}}</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success h-100 my-2">
                <div class="card-body text-white ">
                    <h5 class="card-title text-white">
                        {{__("admin.tour_agency")}}</h5>
                    <div class="d-flex align-self-center h-100">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-building" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <div>
                                <p>{{__("admin.tour_agency")}} : {{\App\Models\Organizator::where("role_id",5)->count()}}</p>
                                <p>{{__("admin.active")}} : {{\App\Models\Organizator::where("role_id",5)->where("status",1)->count()}}</p>
                                <p>{{__("admin.non_active")}} : {{\App\Models\Organizator::where("role_id",5)->where("status",0)->count()}}</p>
                                <p>{{__("admin.on_moderation")}} : {{\App\Models\Organizator::where("role_id",5)->where("status",-1)->count()}}</p>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>

{{--        5 Row--}}
        <div class="col-md-6">
            <div class="card text-white bg-primary h-100 my-2">
                <div class="card-body text-white">
                    <h5 class="card-title text-white">
                        {{__("admin.craft")}}</h5>
                    <div class="d-flex">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-building" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 align-items-center">
                            <p>{{__("admin.craft")}} : {{\App\Models\Shop::where("role_id",6)->count()}}</p>
                            <p>{{__("admin.active")}} : {{\App\Models\Shop::where("role_id",6)->where("status",1)->count()}}</p>
                            <p>{{__("admin.non_active")}} : {{\App\Models\Shop::where("role_id",6)->where("status",0)->count()}}</p>
                            <p>{{__("admin.on_moderation")}} : {{\App\Models\Shop::where("role_id",6)->where("status",-1)->count()}}</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success h-100 my-2">
                <div class="card-body text-white ">
                    <h5 class="card-title text-white">
                        {{__("admin.craftman")}}</h5>
                    <div class="d-flex align-self-center h-100">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-user-circle" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <div>
                                <p>{{__("admin.craftman")}} : {{\App\Models\Shop::where("role_id",7)->count()}}</p>
                                <p>{{__("admin.active")}} : {{\App\Models\Shop::where("role_id",7)->where("status",1)->count()}}</p>
                                <p>{{__("admin.non_active")}} : {{\App\Models\Shop::where("role_id",7)->where("status",0)->count()}}</p>
                                <p>{{__("admin.on_moderation")}} : {{\App\Models\Shop::where("role_id",7)->where("status",-1)->count()}}</p>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{--        6 Row--}}
        <div class="col-md-6">
            <div class="card text-white bg-primary h-100 my-2">
                <div class="card-body text-white">
                    <h5 class="card-title text-white">
                        {{__("admin.news")}}</h5>
                    <div class="d-flex">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-newspaper" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 align-items-center">
                            <p>{{__("admin.news")}} : {{\App\Models\News::count()}}</p>
                            <p>{{__("admin.active")}} : {{\App\Models\News::where("status",1)->count()}}</p>
                            <p>{{__("admin.non_active")}} : {{\App\Models\News::where("status",0)->count()}}</p>
                            <p>{{__("admin.on_moderation")}} : {{\App\Models\News::where("status",-1)->count()}}</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success h-100 my-2">
                <div class="card-body text-white ">
                    <h5 class="card-title text-white">
                        {{__("admin.blogs")}}</h5>
                    <div class="d-flex align-self-center h-100">
                        <div class="w-50 d-flex justify-content-center align-items-center">
                            <i class="fas fa-hashtag" style="font-size: 100px"></i>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <div>
                                <p>{{__("admin.blogs")}} : {{\App\Models\Blog::count()}}</p>
                                <p>{{__("admin.active")}} : {{\App\Models\Blog::where("status",1)->count()}}</p>
                                <p>{{__("admin.non_active")}} : {{\App\Models\Blog::where("status",0)->count()}}</p>
                                <p>{{__("admin.on_moderation")}} : {{\App\Models\Blog::where("status",-1)->count()}}</p>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
