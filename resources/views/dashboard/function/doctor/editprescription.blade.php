@extends('dashboard.user.doctor.example')
@section('content')
    <style>
        input{
            tablindex:"0";
        }
    </style>
    <script type="text/javascript">

    </script>
{{--    {{route('user.drug.edit')}}--}}
    <div class="container">
        <div class="row bg-light rounded-lg" style="margin-top: 40px; margin-right: 5px; margin-left: 5px;">
            <form class="col-12 rounded-pill" action="{{route('user.drug.edit.doctor')}}" method="post" style="color: black">
                <div class="row justify-content-center" style=" margin-top:10px; margin-left:10px; margin-right: 10px;">

                </div>
                @csrf
                <div class="row" style=" margin-top:10px; margin-left:10px; margin-right: 10px;">
                    @if(isset($search))
                    <div class="form-group col-lg-6 col-sm-12 form-inline justify-content-lg-start" >
                        <div class="box">
                            <label for="drug_name">病患姓名</label>
                            <input type="text" class="form-control" style="margin-left:5px" id="patient_name" name="patient_name" value="{{$search->patient_name}}" placeholder="{{$search->patient_name}}" disabled>
                        </div>
{{--                        <span class="text-danger">@error('patient_name'){{ $message }}@enderror</span>--}}
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 form-inline justify-content-lg-start">
                        <div class="box">
                            <label for="drug_name">病患Account</label>
                            <input type="text" class="form-control" style="margin-left:5px" id="patient_account" name="patient_account" value="{{$patient}}" placeholder="{{$patient}}" disabled>
                        </div>
{{--                        <span class="text-danger">@error('patient_account'){{ $message }}@enderror</span>--}}
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 form-inline justify-content-lg-start">
                        <div class="box">
                            <label for="drug_name">醫師姓名</label>
                            <input type="text" class="form-control" style="margin-left:5px" id="doctor_name" name="doctor_name" value="{{$search->doctor_name}}" placeholder="{{$search->doctor_name}}" >
                        </div>
{{--                        <span class="text-danger">@error('doctor_name'){{ $message }}@enderror</span>--}}
                    </div>
                    @endif
                </div>

                <!--編輯多筆資料輸入-->
                @if(isset($data))
                <div id="add_file_button">

                        @if(count($data)>0)
                        @foreach($data as $key => $value)
                        <div id="{{$key+1}}" class="row">
                            <div class="form-group col-lg-12 col-sm-12">
                                <a class="btn-info btn-lg fa fa-bars " tablindex="0" data-toggle="collapse" data-target="#demo{{$key+1}}" href="#"></a>
                                <label for="collapsedata" class="float-right" style="font-weight: bold">第{{$key+1}}筆</label>
                            </div>
                            <div class="row collapse" id="demo{{$key+1}}"  style="margin-top:10px; margin-right: 10px; margin-left: 10px;">
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="drug_name">藥物名稱</label>
                                    <input type="text" class="form-control" id="drug_name" name="drug_name[{{$key+1}}]" value="{{$value->drug_name}}" placeholder="{{$value->drug_name}}">
{{--                                    <span class="text-danger">@error('drug_name.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="drug_code">代碼</label>
                                    <input type="text" class="form-control" id="drug_code" name="drug_code[{{$key+1}}]" value="{{$value->drug_code}}" placeholder="{{$value->drug_code}}">
{{--                                    <span class="text-danger">@error('drug_code.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="day">天數</label>
                                    <input type="number" min="0" class="form-control" id="day" name="day[{{$key+1}}]" value="{{$value->day}}" placeholder="{{$value->day}}">
{{--                                    <span class="text-danger">@error('day.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="drug_amount">數量</label>
                                    <input type="number" min="0" class="form-control" id="drug_amount" name="drug_amount[{{$key+1}}]" value="{{$value->drug_amount}}" placeholder="{{$value->drug_amount}}">
{{--                                    <span class="text-danger">@error('drug_amount.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                    <div class="box" >
                                        <label class="col-lg-12" for="morning">早上</label><br>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="none-1{{$key+1}}" name="morning[{{$key+1}}]" value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="none-1{{$key+1}}">none</label>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="before-1{{$key+1}}" name="morning[{{$key+1}}]" value="2" class="custom-control-input">
                                            <label class="custom-control-label" for="before-1{{$key+1}}">before</label>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="after-1{{$key+1}}" name="morning[{{$key+1}}]" value="3" class="custom-control-input">
                                            <label class="custom-control-label" for="after-1{{$key+1}}">after</label>
                                        </div>
                                        <input type="radio" style="display : none;" id="null-1{{$key+1}}" name="morning[{{$key+1}}]" value="0" class="" checked="checked">

                                    </div>
{{--                                    <span class="text-danger">@error('morning.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                    <div class="box">
                                        <label class="col-lg-12" for="drug_name">中午</label><br>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="none-2{{$key+1}}" name="noon[{{$key+1}}]" value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="none-2{{$key+1}}">none</label>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="before-2{{$key+1}}" name="noon[{{$key+1}}]" value="2" class="custom-control-input">
                                            <label class="custom-control-label" for="before-2{{$key+1}}">before</label>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="after-2{{$key+1}}" name="noon[{{$key+1}}]" value="3" class="custom-control-input">
                                            <label class="custom-control-label" for="after-2{{$key+1}}">after</label>
                                        </div>
                                        <input type="radio" style="display : none;" id="null-2{{$key+1}}" name="noon[{{$key+1}}]" value="0" class="" checked="checked">

                                    </div>
{{--                                    <span class="text-danger">@error('noon.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                    <div class="box">
                                        <label class="col-lg-12" for="drug_name">晚上</label><br>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="none-3{{$key+1}}" name="night[{{$key+1}}]" value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="none-3{{$key+1}}">none</label>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="before-3{{$key+1}}" name="night[{{$key+1}}]" value="2" class="custom-control-input">
                                            <label class="custom-control-label" for="before-3{{$key+1}}">before</label>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="after-3{{$key+1}}" name="night[{{$key+1}}]" value="3" class="custom-control-input">
                                            <label class="custom-control-label" for="after-3{{$key+1}}">after</label>
                                        </div>
                                        <input type="radio" style="display : none;" id="null-3{{$key+1}}" name="night[{{$key+1}}]" value="0" class="" checked="checked">

                                    </div>
{{--                                    <span class="text-danger">@error('night.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                    <div class="box">
                                        <label class="col-lg-12" for="drug_name">睡覺</label><br>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="none-4{{$key+1}}" name="sleep[{{$key+1}}]" value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="none-4{{$key+1}}">none</label>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                            <input type="radio" id="before-4{{$key+1}}" name="sleep[{{$key+1}}]" value="2" class="custom-control-input">
                                            <label class="custom-control-label" for="before-4{{$key+1}}">before</label>
                                        </div>
                                        <input type="radio" style="display : none;" id="null-4{{$key+1}}" name="sleep[{{$key+1}}]" value="0" class="" checked="checked">

                                    </div>
{{--                                    <span class="text-danger">@error('sleep.*'){{ $message }}@enderror</span>--}}
                                </div>
                                <input type="hidden" name="id[{{$key+1}}]" value="{{$value->id}}">
                            </div>
                        </div>
                        @endforeach
                        @endif

                </div>

                <div class="row"  style="margin-top:10px;">
                    <div class="form-group col-12 float-right">
                        <input id="number_tr" type="hidden" name="number_tr" value="{{count($data)}}">
                        <input type="hidden" name="p_id" value="{{$prescriptions_id}}">
                        <button type="submit" class="form-control custom-button btn-lg btn-primary text-center ">提交</button>
                    </div>
                    <div class="form-group col-12 float-right">
                        <a type="button"  class="form-control custom-button btn-lg btn-danger text-center " href="{{route('user.home.doctor')}}">取消</a>
                    </div>
                </div>
                @else
                    <div class="alert alert-danger text-center text-lg-center">你正行非法授權之事</div>
                    <script type="text/javascript">
                        window.setTimeout(function() {
                            window.location.href = '{{route('home')}}';
                        }, 5000);
                    </script>
                @endif
                @if(isset($success))
                    <div class="col alert alert-success text-center">
                        {{ $success }}
                    </div>
                    <script type="text/javascript">
                        window.setTimeout(function() {
                            window.location.href = '{{route('user.home.doctor')}}';
                        }, 5000);
                    </script>
                @endif
                @if(isset($fail))
                    <div class="col alert alert-danger text-center">
                        {{ $fail }}
                    </div>
                @endif
            </form>

        </div>
    </div>

@endsection
