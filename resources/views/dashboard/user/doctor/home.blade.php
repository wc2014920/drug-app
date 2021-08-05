@extends('dashboard.user.doctor.example')
@section('content')

    <div class="container">
        <div class="row justify-content-center" style="margin-top: 10px;">
            @if(isset($deletesuccess))

                <div class="col alert alert-success text-center">
                    {{$deletesuccess}}
                </div>
            @elseif(isset($deletefail))

                <div class="col alert alert-danger text-center">
                    {{$deletefail}}
                </div>
            @endif
        </div>
        <div class="row bg-light rounded-lg justify-content-center" style="margin-top: 20px;">
            <form class="col-12 rounded-pill" method="POST" action="{{ route('user.drug.search.doctor') }}" id="form-search">
                @csrf
                <div class="input-group mb-3 "style="margin-top: 15px;">
                    <input type="text" name="searchitem" class="form-control" placeholder="病患帳號 | 病患名稱 | 創建日期 | 修正日期 - [西元年-月-日]" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append rounded-pill">
                        <button class="fa fa-search btn-info btn-lg" type="button" id="button-addon2"
                                onclick="event.preventDefault(); document.getElementById('form-search').submit()"></button>
                    </div>
                </div>
            </form>
            <div class="form-group">
                <a href="{{route('user.drug.view.create.doctor')}}" class="btn btn-info" >新建</a>
                <a href="#" class="btn btn-danger" >刪除</a>
            </div>
            <table class="table table-hover" style="margin-left: 10px; margin-right: 10px;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Patient</th>
                        <th scope="col">創建時間</th>
                        <th scope="col">更新時間</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @if(count($paginator)>0)
                    @foreach ($paginator as $p)
                        <tr>
                            <td scope="row" >{{ $p->id }}</td>
                            <td>{{ $p->patient_name }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td >
                                <div class="col-auto ">
                                    <a href="" class=" float-right btn btn-danger " style="margin:5px;"
                                       onclick="event.preventDefault(); document.getElementById('form-delete').submit()">刪除</a>
                                    <a href="" class=" float-right btn btn-warning" style="margin:5px;"
                                       onclick="event.preventDefault(); document.getElementById('form-edit').submit()">編輯</a>
                                    <form id="form-edit" action="{{route('user.drug.edit.show.doctor')}}" method="get">

                                        <input type="text" style="display: none" name="id" value="{{$p->id}}">
                                    </form>
                                    <form id="form-delete" action="{{route('user.drug.delete.doctor')}}" method="post">
                                        @csrf
                                        <input type="text" style="display: none" name="id" value="{{$p->id}}">
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr><td class="text-center" colspan="4">你還未為病人建立藥單，請 <a href="{{route('user.drug.view.create.doctor')}}">新增</a></td></tr>
                @endif
                </tbody>
            </table>
            <form class="col-4">
                <div class="box justify-content-center">
                    <div class="pagination-block " style="display: flex; justify-content: center;">
                        {{$paginator->links('dashboard.user.doctor.paginationlinks')}}
                    </div>
                </div>

            </form>
        </div>


    </div>

@endsection
