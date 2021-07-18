@extends("layout.app")
@section("content")
    <!-- partial -->

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">
                        {{__("admin.main")}}
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{__("admin.users_list")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{__("admin.users_list")}}
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>{{__("admin.id")}}</th>
                                    <th>{{__("admin.name")}}</th>
                                    <th>{{__("admin.role_id")}}</th>
                                    <th>E-mail</th>
                                    <th>{{__("admin.phone")}}</th>
                                    <th>{{__("admin.status")}}</th>
                                    <th>{{__("admin.verified")}}</th>
                                    <th>{{__("admin.action")}}</th>
                                </tr>
                                </thead>
                                @if($users)
                                <tbody>

                                @if($users->isNotEmpty())
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->role[\App\Models\Language::getTitle()]}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->status}}</td>
                                            <td>{{$user->verified}}</td>
                                            <td class="d-flex">
                                                <button type="button" class="btn btn-primary btn-xs">
                                                    <i data-feather="eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-xs">
                                                    <i data-feather="edit"></i>
                                                </button>
                                                <form>
                                                    <button type="button" class="btn btn-danger btn-xs">
                                                        <i data-feather="x-square"></i>
                                                    </button>
                                                </form>



                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- partial:../../partials/_footer.html -->

@endsection
