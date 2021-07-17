@extends("auth.layout")
@section("content")
    <div class="page-wrapper full-page ma-0" style="background-image: url('/images/login_bg.jpg'); background-position: center; background-size: cover; background-repeat: no-repeat">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pr-md-0">
                                <div class="auth-left-wrapper">

                                </div>
                            </div>
                            <div class="col-md-8 pl-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2">Visit Shymkent</a>
                                    <h5 class="text-muted font-weight-normal mb-4">
                                        {{__("admin.recovery_password")}}
                                    </h5>
                                    <form class="forms-sample" action="{{route("recover")}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">
                                                {{__("admin.email")}}
                                            </label>
                                            <input disabled  type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email" name="email" value="{{$recovery->user->email}}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <input hidden name="code" value="{{$recovery->code}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> {{__("admin.password")}}</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" autocomplete="current-password" placeholder=" {{__("admin.password")}}" name="same_password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> {{__("admin.same_password")}}</label>
                                            <input type="password" class="form-control @error('same_password') is-invalid @enderror" id="exampleInputPassword1" autocomplete="current-password" placeholder=" {{__("admin.same_password")}}" name="password">
                                            @error('same_password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" href="" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">
                                                {{__("admin.i_forgot")}}
                                            </button>

                                        </div>
                                        <a href="{{route("register")}}" class="d-block mt-3 text-muted">
                                            {{__("admin.not_signed")}}
                                        </a>
                                        <a href="{{route("login")}}" class="d-block mt-3 text-muted">
                                            {{__("admin.signed")}}
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
