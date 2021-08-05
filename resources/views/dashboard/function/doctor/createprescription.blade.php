@extends('dashboard.user.doctor.example')
@section('content')
    <style>
        input{
            tablindex:"0";
        }
    </style>
    <script type="text/javascript">
        var $theid = 1
        function addrow($id) {
            var $idname = "#" + $id;
            $theid += 1;
            $($idname).append('<div id="' + $theid + '" class="row"> ' +
                ' <div class="form-group col-lg-12 col-sm-12">'+
                        '<a class="btn-info btn-lg fa fa-bars " tablindex="0" data-toggle="collapse" data-target="#demo'+$theid+'" href="#"></a>'+
                        '<label for="collapsedata" class="float-right" style="font-weight: bold">第'+$theid+'筆</label>'+
                    '</div>'+
                    '<div class="row collapse show " id="demo'+$theid+'"  style="margin-top:10px; margin-right: 10px; margin-left: 10px;">'+
                        '<div class="form-group col-lg-6 col-sm-12">'+
                            '<label for="drug_name">藥物名稱</label>'+
                            '<input type="text" class="form-control" id="drug_name" name="drug_name['+$theid+']" placeholder="請輸入藥物名稱或代碼">'+
                '<span class="text-danger"></span>'+
                        '</div>'+
                        '<div class="form-group col-lg-6 col-sm-12">'+
                            '<label for="drug_code">代碼</label>'+
                            '<input type="text" class="form-control" id="drug_code" name="drug_code['+$theid+']" placeholder="請輸入處方代碼">'+
                '<span class="text-danger"></span>'+
                        '</div>'+
                        '<div class="form-group col-lg-6 col-sm-12">'+
                            '<label for="day">天數</label>'+
                            '<input type="number" min="0" class="form-control" id="day" name="day['+$theid+']" placeholder="請輸入天數">'+
                '<span class="text-danger"></span>'+
                        '</div>'+
                        '<div class="form-group col-lg-6 col-sm-12">'+
                            '<label for="drug_amount">數量</label>'+
                            '<input type="number" min="0" class="form-control" id="drug_amount" name="drug_amount['+$theid+']" placeholder="請輸入數目">'+
                '<span class="text-danger"></span>'+
                        '</div>'+
                            '<div class="form-group col-lg-3 col-sm-12 justify-content-center">'+
                                '<div class="box">'+
                                    '<label class="col-lg-12" for="morning">早上</label><br>'+
                                    '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                        '<input  type="radio" id="none-1'+$theid+'" name="morning['+$theid+']" value="1" class="custom-control-input">'+
                                            '<label class="custom-control-label" for="none-1'+$theid+'">none</label>'+
                                    '</div>'+
                                    '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                        '<input type="radio" id="before-1'+$theid+'" name="morning['+$theid+']" value="2" class="custom-control-input">'+
                                            '<label class="custom-control-label" for="before-1'+$theid+'">before</label>'+
                                    '</div>'+
                                    '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                        '<input type="radio" id="after-1'+$theid+'" name="morning['+$theid+']" value="3" class="custom-control-input">'+
                                            '<label class="custom-control-label" for="after-1'+$theid+'">after</label>'+
                                    '</div>'+
                                    '<input type="radio" style="display : none;" id="null-1'+$theid+'" name="morning['+$theid+']" value="0" class="" checked="checked">'+
                                    '<span class="text-danger"></span>'+
                                '</div>'+
                            '</div>'+
                        '<div class="form-group col-lg-3 col-sm-12 justify-content-center">'+
                            '<div class="box">'+
                                '<label class="col-lg-12" for="drug_name">中午</label><br>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                    '<input type="radio" id="none-2'+$theid+'" name="noon['+$theid+']" value="1" class="custom-control-input" checked="checked">'+
                                        '<label class="custom-control-label" for="none-2'+$theid+'">none</label>'+
                                '</div>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                    '<input type="radio" id="before-2'+$theid+'" name="noon['+$theid+']" value="2" class="custom-control-input">'+
                                        '<label class="custom-control-label" for="before-2'+$theid+'">before</label>'+
                                '</div>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                    '<input type="radio" id="after-2'+$theid+'" name="noon['+$theid+']" value="3" class="custom-control-input">'+
                                        '<label class="custom-control-label" for="after-2'+$theid+'">after</label>'+
                                '</div>'+
                                '<input type="radio" style="display : none;" id="null-2'+$theid+'" name="noon['+$theid+']" value="0" class="" checked="checked">'+
                                '<span class="text-danger"></span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group col-lg-3 col-sm-12 justify-content-center">'+
                            '<div class="box">'+
                                '<label class="col-lg-12" for="drug_name">晚上</label><br>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                    '<input type="radio" id="none-3'+$theid+'" name="night['+$theid+']" value="1" class="custom-control-input" checked="checked">'+
                                        '<label class="custom-control-label" for="none-3'+$theid+'">none</label>'+
                                '</div>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                    '<input type="radio" id="before-3'+$theid+'" name="night['+$theid+']" value="2" class="custom-control-input">'+
                                        '<label class="custom-control-label" for="before-3'+$theid+'">before</label>'+
                                '</div>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                    '<input type="radio" id="after-3'+$theid+'" name="night['+$theid+']" value="3" class="custom-control-input">'+
                                        '<label class="custom-control-label" for="after-3'+$theid+'">after</label>'+
                                '</div>'+
                                '<input type="radio" style="display : none;" id="null-3'+$theid+'" name="night['+$theid+']" value="0" class="" checked="checked">'+
                                '<span class="text-danger"></span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group col-lg-3 col-sm-12 justify-content-center">'+
                            '<div class="box">'+
                                '<label class="col-lg-12" for="drug_name">睡覺</label><br>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">'+
                                    '<input type="radio" id="none-4'+$theid+'" name="sleep['+$theid+']" value="1" class="custom-control-input">'+
                                        '<label class="custom-control-label" for="none-4'+$theid+'">none</label>'+
                                '</div>'+
                                '<div class="col-lg-3 col-sm-12 custom-control custom-checkbox   ">'+
                                    '<input type="radio" id="before-4'+$theid+'" name="sleep['+$theid+']" value="2" class="custom-control-input">'+
                                        '<label class="custom-control-label" for="before-4'+$theid+'">before</label>'+
                                '</div><br>'+
                                '<input type="radio" style="display : none;" id="null-4'+$theid+'" name="sleep['+$theid+']" value="0" class="" checked="checked">'+
                                    '<span class="text-danger"></span>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>');
            document.getElementById("gettheid").setAttribute('value', $theid);
        }
        function delrow() {
            if ($theid > 1) {

                var $idname = "#" + $theid;
                $($idname).remove();
                $theid -= 1;
            }
            document.getElementById("gettheid").setAttribute('value', $theid);
        }
        window.onload = function() {
            document.getElementById("gettheid").setAttribute('value', $theid);
        };
    </script>
    <div class="container">
        <div class="row bg-light rounded-lg" style="margin-top: 40px; margin-right: 5px; margin-left: 5px;">
            <form class="col-12 rounded-pill" action="{{route('user.drug.create.doctor')}}" method="post" style="color: black">
                <div class="row justify-content-center" style=" margin-top:10px; margin-left:10px; margin-right: 10px;">
                    @if(session('success'))
                        <div class="col alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                        <script type="text/javascript">
                            window.setTimeout(function() {
                                window.location.href = '{{route('user.home.doctor')}}';
                            }, 3000);
                        </script>
                    @endif
                    @if(session('fail'))
                        <div class="col alert alert-danger text-center">
                            {{ session('fail') }}
                        </div>
                    @endif
                </div>
                @csrf
                <div class="row" style=" margin-top:10px; margin-left:10px; margin-right: 10px;">
                    <div class="form-group col-lg-6 col-sm-12 form-inline justify-content-lg-start" >
                        <div class="box">
                            <label for="drug_name">病患姓名</label>
                            <input type="text" class="form-control" style="margin-left:5px" id="patient_name" name="patient_name" placeholder="請輸入病患姓名">
                        </div>
                        <span class="text-danger">@error('patient_name'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 form-inline justify-content-lg-start">
                        <div class="box">
                            <label for="drug_name">病患Account</label>
                            <input type="text" class="form-control" style="margin-left:5px" id="patient_account" name="patient_account" placeholder="請輸入病患Account">
                        </div>
                        <span class="text-danger">@error('patient_account'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 form-inline justify-content-lg-start">
                        <div class="box">
                            <label for="drug_name">醫師姓名</label>
                            <input type="text" class="form-control" style="margin-left:5px" id="doctor_name" name="doctor_name" placeholder="請輸入醫師姓名">
                        </div>
                        <span class="text-danger">@error('doctor_name'){{ $message }}@enderror</span>
                    </div>

                </div>

                <div class="row" style="margin-left:20px;">
                    <div class="form-group">
                        <button class="fa fa-plus-circle btn-lg btn-outline-primary" type="button"  aria-hidden="true" onclick="addrow('add_file_button')"></button>
                        <!--底下新增-->
                        <button class="fa fa-minus-circle icon btn-lg btn-outline-danger" type="button"  aria-hidden="true" onclick="delrow()"></button>
                        <!--底下刪除-->
                    </div>
                </div>
                <!--新增多筆資料輸入-->
                <div id="add_file_button">
                    <div id="1" class="row">
                        <div class="form-group col-lg-12 col-sm-12">
                            <a class="btn-info btn-lg fa fa-bars " tablindex="0" data-toggle="collapse" data-target="#demo" href="#"></a>
                            <label for="collapsedata" class="float-right" style="font-weight: bold">第1筆</label>
                        </div>
                        <div class="row collapse" id="demo"  style="margin-top:10px; margin-right: 10px; margin-left: 10px;">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="drug_name">藥物名稱</label>
                                <input type="text" class="form-control" id="drug_name" name="drug_name[1]" placeholder="請輸入藥物名稱或代碼">
                                <span class="text-danger">@error('drug_name.*'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="drug_code">代碼</label>
                                <input type="text" class="form-control" id="drug_code" name="drug_code[1]" placeholder="請輸入處方代碼">
                                <span class="text-danger">@error('drug_code.*'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="day">天數</label>
                                <input type="number" min="0" class="form-control" id="day" name="day[1]" placeholder="請輸入天數">
                                <span class="text-danger">@error('day.*'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="drug_amount">數量</label>
                                <input type="number" min="0" class="form-control" id="drug_amount" name="drug_amount[1]" placeholder="請輸入數目">
                                <span class="text-danger">@error('drug_amount.*'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                <div class="box" >
                                    <label class="col-lg-12" for="morning">早上</label><br>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="none-11" name="morning[1]" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="none-11">none</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="before-11" name="morning[1]" value="2" class="custom-control-input">
                                        <label class="custom-control-label" for="before-11">before</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="after-11" name="morning[1]" value="3" class="custom-control-input">
                                        <label class="custom-control-label" for="after-11">after</label>
                                    </div>
                                    <input type="radio" style="display : none;" id="null-11" name="morning[1]" value="0" class="" checked="checked">

                                </div>
                                <span class="text-danger">@error('morning.*'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                <div class="box">
                                    <label class="col-lg-12" for="drug_name">中午</label><br>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="none-21" name="noon[1]" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="none-21">none</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="before-21" name="noon[1]" value="2" class="custom-control-input">
                                        <label class="custom-control-label" for="before-21">before</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="after-21" name="noon[1]" value="3" class="custom-control-input">
                                        <label class="custom-control-label" for="after-21">after</label>
                                    </div>
                                    <input type="radio" style="display : none;" id="null-21" name="noon[1]" value="0" class="" checked="checked">

                                </div>
                                <span class="text-danger">@error('noon.*'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                <div class="box">
                                    <label class="col-lg-12" for="drug_name">晚上</label><br>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="none-31" name="night[1]" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="none-31">none</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="before-31" name="night[1]" value="2" class="custom-control-input">
                                        <label class="custom-control-label" for="before-31">before</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="after-31" name="night[1]" value="3" class="custom-control-input">
                                        <label class="custom-control-label" for="after-31">after</label>
                                    </div>
                                    <input type="radio" style="display : none;" id="null-31" name="night[1]" value="0" class="" checked="checked">

                                </div>
                                <span class="text-danger">@error('night.*'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col-lg-3 col-sm-12 justify-content-center">
                                <div class="box">
                                    <label class="col-lg-12" for="drug_name">睡覺</label><br>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="none-41" name="sleep[1]" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="none-41">none</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 custom-control custom-checkbox  custom-control-inline ">
                                        <input type="radio" id="before-41" name="sleep[1]" value="2" class="custom-control-input">
                                        <label class="custom-control-label" for="before-41">before</label>
                                    </div>
                                    <input type="radio" style="display : none;" id="null-41" name="sleep[1]" value="0" class="" checked="checked">

                                </div>
                                <span class="text-danger">@error('sleep.*'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"  style="margin-top:10px;">
                    <div class="form-group col-12 float-right">
                        <input id="gettheid" type="hidden" name="number_tr">
                        <button type="submit" class="form-control custom-button btn-lg btn-primary" >提交</button>
                    </div>
                    <div class="form-group col-12 float-right">
                        <button type="submit" href="{{route('user.home.doctor')}}" class="form-control custom-button btn-lg btn-danger" >取消</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
