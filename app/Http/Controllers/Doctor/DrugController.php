<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DrugController extends Controller
{
    //Methods
    function drug_url_img($String){
        $drug_name_url = "http://drugtw.com/api/drugs?q=".$String;
        $data = Http::get($drug_name_url)->json('drug_table');
        $count = count($data);
//            dd($data);
        if ($count > 1){
//            dd($count);
            return null;
        }elseif($count == 1){
            return $data;
        }

    }
    //Functions
    public function ShowProfile(){ //顯示 Dcotor 帳戶個資
        $search = DB::select('select clinic_id from doctors where user_id = :user_id',['user_id'=>Auth::user()->id]);
        $condition = $search[0]->clinic_id;
//        $search = DB::select('select * from clinic_hospitals where clinic_id = :clinic_id',['clinic_id'=>$condition]);
        $search = DB::table('clinic_hospitals')->where('clinic_id','=',$condition)->get();
//        dd($search[0]);
        $data = [
            'clinic_name' => $search[0]->name,
            'clinic_address'=> $search[0]->address,
            'clinic_phone'=> $search[0]->phone
        ];
//        $data = DB::table('clinic_hospitals')->where('clinic_id','=','3701022936')->get();
//        dd($data);
        return view('dashboard.user.profile',compact('data'));
    }

    public function create(Request $request){ //建立藥單
//        dd($request->all());
        $request->validate([
            'patient_name'=>'required',
            'patient_account'=>'required|exists:users,name',
            'doctor_name'=>'required',
            'drug_name.*'=>'required',
            'drug_code.*'=>'required',
            'day.*'=>'required',
            'drug_amount.*'=>'required',
            'morning.*'=>'numeric|in:1,2,3',
            'noon.*'=>'numeric|in:1,2,3',
            'night.*'=>'numeric|in:1,2,3',
            'sleep.*'=>'numeric|in:1,2',
        ]);
        $patient_name = $request->patient_name;
        $patient_account = $request->patient_account;
        $doctor_name = $request->doctor_name;
        $drug_name = $request->drug_name;
        $drug_code = $request->drug_code;
        $drug_day = $request->day;
        $drug_amount = $request->drug_amount;
        $morning = $request->morning;
        $noon = $request->noon;
        $night = $request->night;
        $search = DB::select('select clinic_id from doctors where user_id = :user_id',['user_id'=>Auth::user()->id]);
        $condition = $search[0]->clinic_id;
        $search = DB::table('clinic_hospitals')->where('clinic_id','=',$condition)->get();
        $search2 = DB::select('select id from users where name = :name',['name'=>$patient_account]);
        $condition2=$search2[0]->id;
        $time = Carbon::now();
        $datasave = [ //存入 table : prescriptions
            'doctor_name'=>$doctor_name,
            'patient_name'=>$patient_name,
            'clinic'=>$search[0]->name,
            'doctor_id'=>Auth::user()->id,
            'patient_id'=>$condition2,
            'clinic_id'=>$condition,
            "created_at" =>  $time, # new \Datetime()
            "updated_at" => $time,  # new \Datetime()
        ];
        $SavetoPre=DB::table('prescriptions')->insert($datasave);
        if ($SavetoPre){ //存入 table : scriptdetails
            $last = DB::table('prescriptions')->orderBy('id', 'DESC')->first();
            for($i = 0; $i < count($drug_name); $i++) {
//                dd($drug_name);

                $data = $this->drug_url_img($drug_name[$i+1]);
                $drug_pic_arr = Arr::get($data, 'drug_table.0.fig');
                $drug_pic_url = Arr::get($drug_pic_arr, '0');
                $datasave2 = [
                    'prescription_id' => $last->id,
                    'patient_id' => $condition2,
                    'drug_name' => $drug_name[$i+1],
                    'drug_pic_url' => $drug_pic_url,
                    'drug_code' => $drug_code[$i+1],
                    'drug_amount' => $drug_amount[$i+1],
                    'day' => $drug_day[$i+1],
                    'time_morning' => $morning[$i+1],
                    'time_noon' => $noon[$i+1],
                    'time_night' => $night[$i+1],
                    //                'time_sleep'=>$sleep[$x],
                    "created_at" => $time, # new \Datetime()
                    "updated_at" => $time,  # new \Datetime()
                ];
                $save=DB::table('scirptdetails')->insert($datasave2);
                if (!$save){
                    return redirect()->back()->with('fail','Build Fail!!');
                }
            }
            return redirect()->back()->with('success','Buile Success!!');
        }
    }

    public function searchrescriptionresult(Request $request){
//        dd(isset($request->searchitem));
        if (!isset($request->searchitem)){
            return redirect()->action([DrugController::class,'showprescription']);
        }
        $searchword = $request->searchitem;
//        dd($searchword);
        $cc = DB::table('users')->where('name','=',$searchword)->get('id');
//        dd(count($cc));
        if (count($cc)==0){
            $searchdata=[
                'updated_at'=>date($searchword),
                'created_at'=>date($searchword),
                'patient_name'=>$searchword,
            ];
        }else{
            $searchdata=[
                'updated_at'=>date($searchword),
                'created_at'=>date($searchword),
                'patient_name'=>$searchword,
                'patient_id'=>$cc[0]->id
            ];
        }
//        dd($searchdata);
        return redirect()->action([DrugController::class,'showprescription'],['search'=>$searchdata]);

    }

    public function showprescription(Request $request){
        $user=Auth::user()->id;
        $paginator=DB::table('prescriptions')->where('doctor_id','=',$user)->paginate(5);
        if(isset($request->deletesuccess)){
            $deletesuccess = $request->deletesuccess;
            return view('dashboard.user.doctor.home',compact(['paginator','deletesuccess']));
        }elseif (isset($request->deletefail)){
            $deletefail = $request->deletefail;
            return view('dashboard.user.doctor.home',compact(['paginator','deletefail']));
        }elseif(isset($request->search)){
            $data_array = $request->search;
            if(count($data_array)==3){
                $paginator = DB::table('prescriptions')->whereDate('updated_at','=',$data_array['updated_at'])
                    ->orWhereDate('created_at','=',$data_array['created_at'])
                    ->orWhere('patient_name','=',$data_array['patient_name'])
                    ->paginate(5);
            }else{
                $paginator = DB::table('prescriptions')->whereDate('updated_at','=',$data_array['updated_at'])
                    ->orWhereDate('created_at','=',$data_array['created_at'])
                    ->orWhere('patient_name','=',$data_array['patient_name'])
                    ->orWhere('patient_id','=',$data_array['patient_id'])
                    ->paginate(5);
            }
            return view('dashboard.user.doctor.home',compact('paginator'));
        }else{
            return view('dashboard.user.doctor.home',compact('paginator'));
        }

    }

    public function showmyown(){
        $user=Auth::user()->id;
        $paginator=DB::table('prescriptions')->where('patient_id','=',$user)->paginate(5);
//        dd($paginator);
        return view('dashboard.user.home',compact('paginator'));
    }

    public function showmyowndetail(Request $request){
        $paginator=DB::table('scirptdetails')->where('prescription_id','=',$request->id)->paginate(5);
//                dd($paginator);
        return view('dashboard.user.showmypredetails',compact('paginator'));
    }

    public function showeditprescription(Request $request){
        $request->validate([
            'id'=>'exists:prescriptions,id'
        ]);
//        dd($request->all());
        $prescriptions_id = $request->id;
        $search = DB::table('scirptdetails')->where('prescription_id','=',$request->id)->get();
        $data=$search;//$data->patient_id
        $patient=$search[0]->patient_id;
//        dd($patient);
        $patient = DB::table('users')->where('id','=',$patient)->first();
        $patient = $patient->name;
        $search = DB::table('prescriptions')->where('id','=',$request->id)->first();//->get => $search[0]
//        dd($data);
//        dd($search);
        if(isset($request->fail)){
            return view('dashboard.function.doctor.editprescription',compact('data','search','patient','prescriptions_id'))
                ->with('fail',$request->fail);
        }elseif ($request->success){
            return view('dashboard.function.doctor.editprescription',compact('data','search','patient','prescriptions_id'))
                ->with('success',$request->success);
        }
        return view('dashboard.function.doctor.editprescription',compact('data','search','patient','prescriptions_id'));
    }

    public function editprescription(Request $request){
        $doctor_name = $request->doctor_name;
        $drug_name = $request->drug_name;
        $drug_code = $request->drug_code;
        $drug_day = $request->day;
        $drug_amount = $request->drug_amount;
        $morning = $request->morning;
        $noon = $request->noon;
        $night = $request->night;
        $sleep = $request->sleep;
        $prescriptions_id = $request->p_id;
        $scriptdetails_id = $request->id;
        //因為是Post 若是不符回上個Controller，則 Validate 類別( GET Method )就會失效，所以要手動檢驗(龜速...)
//        dd($request->all());
        $update = DB::update(
            'update prescriptions set
                         doctor_name = ?,updated_at=?
                         where id = ?', [$doctor_name, Carbon::now(),$prescriptions_id]);
        for($i = 1; $i <= count($drug_name); $i++){
            $fail = '填寫的資訊有誤! 請仔細填寫!';
            if ($morning[$i] == 0 || $noon[$i] == 0 || $night[$i] == 0 || $sleep[$i] == 0 || $drug_day[$i] <= 0 || $drug_amount[$i] <= 0) {
                //處理失敗訊息
                return redirect()->action([DrugController::class, 'showeditprescription'],['id'=>$prescriptions_id,'fail'=>$fail]);
            }
            $data = $this->drug_url_img($drug_name[$i]);
//            dd($data);
            if (!isset($data)){
                return redirect()->action([DrugController::class, 'showeditprescription'],['id'=>$prescriptions_id,'fail'=>$fail]);
            }
            $update = DB::update(
            'update scirptdetails set
                         drug_code = ?,drug_amount=?,day=?,time_morning=?,time_noon=?,time_night=?,time_sleep=?,updated_at=?
                         where id = ?', [$drug_code[$i], $drug_amount[$i], $drug_day[$i], $morning[$i], $noon[$i], $night[$i], $sleep[$i], Carbon::now(),$scriptdetails_id[$i]]);
            if(!$update){
                return redirect()->action([DrugController::class, 'showeditprescription'],['id'=>$prescriptions_id,'fail'=>$fail]);
            }

        }
        if($update){
            //處理成功信息
            $success = '全部更新成功!';
            return redirect()->action([DrugController::class, 'showeditprescription'],['id'=>$prescriptions_id,'success'=>$success]);
        }
        return redirect()->action([DrugController::class, 'showeditprescription'],['id'=>$prescriptions_id,'fail'=>$fail]);
    }

    public function deleteprescription(Request $request){
        $request->validate([
            'id'=>'exists:prescriptions,id'
        ]);
//        dd($request);
        $deleted = DB::table('prescriptions')->delete($request->id);
        if ($deleted){
            return redirect()->action([DrugController::class, 'showprescription'], ['deletesuccess'=>'Delete Successfully!']);
        }else{
            return redirect()->action([DrugController::class, 'showprescription'], ['deletefail'=>'This data does not exists!']);
        }
    }


}
