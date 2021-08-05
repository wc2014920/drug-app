@extends('dashboard.user.doctor.example')
@section('content')
    <div class="container">
        <div class="row bg-light rounded-lg" style="margin-top: 40px;">
            <table class="table table-hover" style="margin-left: 10px; margin-right: 10px;">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">醫院機構</th>
                    <th scope="col">醫師</th>
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
                            <td>{{ $p->clinic }}</td>
                            <td>{{ $p->doctor_name }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td >
                                <div class="col-auto ">
                                    <a href="" class=" float-right btn btn-danger " style="margin:5px;"
                                       onclick="event.preventDefault(); document.getElementById('form-detail').submit()">查看</a>

                                    <form id="form-detail" action="{{ route('user.home.detail.patient') }}" method="get">
                                        <input type="text" style="display: none" name="id" value="{{$p->id}}">
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr><td class="text-center" colspan="4">抱歉，你還未有藥單</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

