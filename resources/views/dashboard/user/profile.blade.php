@extends('dashboard.user.doctor.example')
@section('content')
    <div class="container">
        <div class="row bg-light rounded-lg" style="margin-top: 40px;">
            <div class="col">
                <table class="table table-hover" style="margin-left: 10px; margin-right: 10px;">
                    <tbody>
                    <tr>
                        <th scope="row">
                            Username :
                        </th>
                        <td>
                            {{ Auth::user()->name }}
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Email :
                        </th>
                        <td>
                            {{ Auth::user()->email }}
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Phone :
                        </th>
                        <td>
                            @if(isset(Auth::user()->cellphone))
                                {{ Auth::user()->cellphone }}
                            @else
                                None
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Permission :
                        </th>
                        <td>
                            @if(Auth::user()->is_doctor)
                                Patient | Doctor
                            @else
                                Doctor
                            @endif
                        </td>
                        <td></td>
                    </tr>
            @if(isset($data))
                @if(Auth::user()->is_doctor)
                    <tr>
                        <th scope="row">
                            Clinic :
                        </th>
                        <td>
                            {{$data['clinic_name']}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Ph.clinic :
                        </th>
                        <td>
                            {{$data['clinic_phone']}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Address.clinic :
                        </th>
                        <td>
                            {{$data['clinic_address']}}
                        </td>
                    </tr>
                @endif
            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
