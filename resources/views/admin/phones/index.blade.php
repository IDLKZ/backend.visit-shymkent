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
                                {{__("admin.phones")}}
                            </h6>

                            <a  class="btn btn-success text-white" data-toggle="modal" data-target="#createPhoneModal">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($phones)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>{{__("admin.phone")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($phones->isNotEmpty())
                                        @foreach($phones as $phone)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$phone->phone}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="edit-phone dropdown-item" data-id="{{$phone->id}}" data-phone="{{$phone->phone}}">{{__("admin.change")}}</a>
                                                            <form method="post" action="{{route("phones.destroy",$phone->id)}}">
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
    <div class="modal fade" id="createPhoneModal" tabindex="-1" role="dialog" aria-labelledby="createPhoneModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.phones")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{route("phones.store")}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phone">{{__('admin.phone')}}</label>
                            <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" name='phone' autocomplete="off" placeholder="{{__('admin.phone')}}" >
                            @error('phone')
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
                <form id="phone-form" method="post" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phone">{{__('admin.phone')}}</label>
                            <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone-edit" name='phone' autocomplete="off" placeholder="{{__('admin.phone')}}" >
                            @error('phone')
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
        $(".edit-phone").on("click",function (e) {
            e.preventDefault();
            let id = $(this).attr("data-id");
            let phone = $(this).attr("data-phone");
            let url = "<?php echo route("phones.index"); ?>" +"/"+ id;
            $('#phone-form').attr('action',url);
            $('#phone-edit').attr('value',phone);
            jQuery.noConflict();
            $("#editPhonesModal").modal("show");




        })


    </script>
@endpush




