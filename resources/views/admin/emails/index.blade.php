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
                    {{__("admin.phones")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.emails")}}
                            </h6>

                            <a  class="btn btn-success text-white" data-toggle="modal" data-target="#createEmailModal">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($emails)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>{{__("admin.email")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($emails->isNotEmpty())
                                        @foreach($emails as $email)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$email->email}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="edit-email dropdown-item" data-id="{{$email->id}}" data-email="{{$email->email}}">{{__("admin.change")}}</a>
                                                            <form method="post" action="{{route("emails.destroy",$email->id)}}">
                                                                @csrf
                                                                @method("delete")
                                                                <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                            </form>
                                                        </div>
                                                    </div>



                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif


                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Create Phone -->
    <div class="modal fade" id="createEmailModal" tabindex="-1" role="dialog" aria-labelledby="createEmailModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.emails")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{route("emails.store")}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phone">{{__('admin.email')}}</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name='email' autocomplete="off" placeholder="{{__('admin.email')}}" >
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.save")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- partial:../../partials/_footer.html -->
    <div class="modal fade" id="editPhonesModal" tabindex="-1" role="dialog" aria-labelledby="editPhonesModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.phones")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="email-form" method="post" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phone">{{__('admin.email')}}</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email-edit" name='email' autocomplete="off" placeholder="{{__('admin.email')}}" >
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.save")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push("scripts")
    <script>
        $(".edit-email").on("click",function (e) {
            e.preventDefault();
            let id = $(this).attr("data-id");
            let email = $(this).attr("data-email");
            let url = "<?php echo route("emails.index"); ?>" +"/"+ id;
            $('#email-form').attr('action',url);
            $('#email-edit').attr('value',email);
            jQuery.noConflict();
            $("#editPhonesModal").modal("show");




        })


    </script>
@endpush





