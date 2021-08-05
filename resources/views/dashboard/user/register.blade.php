<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Register</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if(!isset($coderror))
        <?php $coderror = "";?>
    @endif
    <script type="text/javascript">
        function TogglePart(partToshow){
            if(partToshow !== 'doctor'){
               $('#act').hide();
            }else {
                $('#act').show();
            }
        }
        function onLoad_event_1(){
            $('#act').show();
        }
    </script>
    @if (session()->has('success'))
        <script>
            setTimeout(function() {
                window.location.href = "{{route('home')}}"
            }, 2000); // 2 second
        </script>
        @elseif(session()->has('fail'))
        <script>
            setTimeout(function(){
                window.location.href = "{{route('home')}}"
            }, 5000); // 5 second
        </script>
    @endif
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body onload="onLoad_event_1()">
<div class="overflow-hidden" style="visibility: hidden">
    @error('code'){{ $coderror = $message }}@enderror
</div>
<div class="continer">
    <div class="row">
        <div class="col-md-4 offset-md-4" style="margin-top: 45px;">
            <h4>User Register</h4><br>
                <form action="{{ route('user.create') }}" method="post" autocomplete="off">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('fail'))
                    <div class="alert alert-danger">
                        {{ session('fail') }}
                    </div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name."
                           value="{{old('name')}}">
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email address."
                           value="{{old('email')}}">
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="cellphone">cellphone</label>
                    <input type="" class="form-control" name="cellphone" placeholder="Enter cellphone ( include International code ).">
                    <span class="text-danger">@error('cellphone'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password."
                           value="{{old('password')}}">
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" placeholder="Enter confirm password."
                           value="{{old('cpassword')}}">
                    <span class="text-danger">@error('cpassword'){{ $message }}@enderror</span>
                </div>
                <label>Role</label><br>
                <div class="form-group d-flex justify-content-around">
                    <div class="custom-control custom-checkbox  custom-control-inline ">
                        <input type="radio" id="Doctor" name="role" value="doctor" class="custom-control-input" onclick="TogglePart('doctor')">
                        <label class="custom-control-label" for="Doctor">Doctor</label>
                    </div>
                    <div class="custom-control custom-checkbox  custom-control ">
                        <input type="radio" id="Patient" name="role" value="patient" class="custom-control-input" onclick="TogglePart('')">
                        <label class="custom-control-label" for="Patient">Patient</label>
                    </div>
                    <span class="text-danger">@error('role'){{ $message }}@enderror</span>
                </div>
                <a class="btn-link float-right" type="button" data-toggle="collapse" data-target="#AboutRoles" aria-expanded="false" aria-controls="collapseExample">
                    About Roles
                </a><br>
                <div class="collapse" id="AboutRoles">
                    <div class="card card-body">
                        If you choose a doctor as your account identity,
                        you can have additional functions for general users,
                        or you can only choose patient-general users as your identity.
                    </div>
                </div>
                <div class="form-group" id="act" style="display: none">
                    <label>Organization Code</label>
                    <input type="text" id="code" name="code" class="form-control" placeholder="Please enter your organization code">
                    <span class="text-danger">@error('code'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Register</button>
                </div>
                <br>
                <a class="float-right" href="{{ route('user.login') }}">I already have an Account</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
