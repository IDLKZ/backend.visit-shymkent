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
                                        {{__("admin.register_message")}}
                                    </h5>
                                    <form class="forms-sample" action="{{route("registerUser")}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">
                                                {{__("admin.name")}}
                                            </label>
                                            <input  type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="{{__("admin.name")}}" name="name" value="{{ old('name') }}">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">
                                                {{__("admin.email")}}
                                            </label>
                                            <input  type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPhone">
                                                {{__("admin.phone")}}
                                            </label>
                                            <input  type="text" class="form-control @error('phone') is-invalid @enderror" id="exampleInputPhone" placeholder="{{__("admin.phone")}}" name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> {{__("admin.password")}}</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" autocomplete="current-password" placeholder=" {{__("admin.password")}}" name="password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">
                                                {{__("admin.register")}}
                                            </button>

                                        </div>
                                        <a href="{{route("login")}}" class="d-block mt-3 text-muted">
                                            {{__("admin.signed")}}
                                        </a>
                                        <a href="{{route("forgot")}}" class="d-block mt-3 text-muted">
                                            {{__("admin.forgot")}}
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

