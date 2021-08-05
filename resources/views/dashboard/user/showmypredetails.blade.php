@extends('dashboard.user.doctor.example')
@section('content')
    <div class="container">
        <div class="row bg-light rounded-lg" style="margin-top: 40px; margin-right: 5px; margin-left: 5px;">
            <div class="col-12 rounded-pill" action="{{route('user.drug.create.doctor')}}" method="post" style="color: black">
                <div class="row justify-content-center" style=" margin-top:10px; margin-left:10px; margin-right: 10px;">
                </div>
                <!--新增多筆資料輸入-->
                @if(count($paginator)>0)
                    @foreach ($paginator as $key => $p)
                    <div id="add_file_button">
                        <div id="1" class="row">
                            <div class="form-group col-lg-12 col-sm-12">
                                <a class="btn-info btn-lg fa fa-bars " tablindex="0" data-toggle="collapse" data-target="#demo{{$key+1}}" href="#"></a>
                                <label for="collapsedata" class="float-right" style="font-weight: bold">第1筆</label>
                            </div>
                            <div class="row collapse show" id="demo{{$key+1}}"  style="margin-top:10px; margin-right: 10px; margin-left: 10px;">
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="drug_name">藥物名稱</label>
                                    <input type="text" class="form-control" id="drug_name" name="drug_name[{{$key+1}}]" placeholder="{{$p->drug_name}}" disabled>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="drug_code">代碼</label>
                                    <input type="text" class="form-control" id="drug_code" name="drug_code[{{$key+1}}]" placeholder="{{$p->drug_code}}" disabled>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="day">天數</label>
                                    <input type="number" min="0" class="form-control" id="day" name="day[{{$key+1}}]" placeholder="{{ $p->day }}" disabled>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="drug_amount">數量</label>
                                    <input type="number" min="0" class="form-control" id="drug_amount" name="drug_amount[{{$key+1}}]" placeholder="{{ $p->drug_amount }}" disabled>
                                </div>
                                <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                    <div class="box" >
                                        <label class="col-lg-12" for="note">叮囑</label><br>
                                        @switch($p->time_morning)
                                            @case(1)

                                            @break
                                            @case(2)

                                            @break
                                            @case(3)

                                            @break
                                        @endswitch
                                        @switch($p->time_noon)
                                            @case(1)

                                            @break
                                            @case(2)

                                            @break
                                            @case(3)

                                            @break
                                        @endswitch
                                        @switch($p->time_night)
                                            @case(1)

                                            @break
                                            @case(2)

                                            @break
                                            @case(3)

                                            @break
                                        @endswitch
                                        @switch($p->time_sleep)
                                            @case(1)
                                            @break
                                            @case(2)
                                            @break
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="alert alert-danger">產生錯誤</div>
                        <script type="text/javascript">
                            window.setTimeout(function() {
                                window.location.href = '{{route('user.home.patient')}}';
                            }, 5000);
                        </script>
                    </div>
                @endif
                <div class="form-group col-12 float-right ">
                    <button href="" class=" float-right btn btn-primary" style="margin:5px;"
                       onclick="event.preventDefault(); document.getElementById('home').submit()">返回上頁</button>
                    <form id="home" action="{{ route('user.home.patient') }}" method="get">
                        <input type="text" style="display: none" name="id" value="{{$p->id}}">
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
