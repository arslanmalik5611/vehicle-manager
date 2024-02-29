<?php

namespace App\Http\Controllers;

use App\Helpers\SiteHelper;
use App\Models\Attachment;
use App\Models\AttendanceType;
use App\Models\Role;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Models\UserAttendance;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class UserSessionController extends Controller
{
    public function index()
    {
        return view('user.list');
    }

    public function detailView()
    {
        return view('user.detail');
    }

    public function all()
    {
        $UserSessions = UserSession::with(['user', 'session'])->orderByDesc('id')->get();
        return response()->json([
            'status' => true,
            'data' => $UserSessions
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'salary' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $picture = $request->file('picture');
        $picture_name = '';
        if ($picture) {
            $picture_name = Str::random(10) . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('uploads/user'), $picture_name);
        }

        $User = User::create([
            'role_id' => $request->role_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => SiteHelper::reformatDbDate($request->dob),
            'religion' => $request->religion,
            'address' => $request->address,
            'address_temporary' => $request->address_temporary,
            'picture' => $picture_name,
        ]);

        $UserSession = UserSession::create([
            'user_id' => $User->id,
            'session_id' => $request->session_id,
            'designation' => $request->designation,
            'qualification' => $request->qualification,
            'salary' => $request->salary,
            'bank_information' => $request->bank_information,
            'joining_date' => SiteHelper::reformatDbDate($request->joining_date),
        ]);

        $UserSessionGet = UserSession::find($UserSession->id);
        $UserSessionGet->personal_number = $UserSession->id . str_pad($UserSession->id, 8, '0', STR_PAD_LEFT);
        $UserSessionGet->save();
        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function show(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => UserSession::with(['user', 'session'])->find($request->id)
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'salary' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->first()
            ]);
        }

//      USER SESSION UPDATE
        $UserSession = UserSession::find($request->id);
        $UserSession->session_id = $request->session_id;
        $UserSession->designation = $request->designation;
        $UserSession->salary = $request->salary;
        $UserSession->leave_date = SiteHelper::reformatDbDate($request->leave_date);
        $UserSession->leave_notes = $request->leave_notes;
        $UserSession->bank_information = $request->bank_information;
        $UserSession->joining_date = SiteHelper::reformatDbDate($request->joining_date);
        $UserSession->save();

//        USER SESSION DETAIL UPDATE FROM USER TABLE
        $User = User::find($UserSession->user_id);

        $User->role_id = $request->role_id;;
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->email = $request->email;
        $User->address = $request->address;
        $User->address_temporary = $request->address_temporary;
        $User->religion = $request->religion;
        $User->phone = $request->phone;
        $User->gender = $request->gender;
        $User->dob = SiteHelper::reformatDbDate($request->dob);

        if ($request->password) {
            $User->password = Hash::make($request->password);
        }

        if ($request->picture) {
            $picture = $request->file('picture');
            $picture_name = Str::random(10) . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('uploads/user'), $picture_name);

            $User->picture = $picture_name;
        }
        $User->save();

        return response()->json([
            'status' => true,
            'message' => 'Record updated successfully'
        ]);
    }

    public function detail(Request $request)
    {
        $UserSession = UserSession::with(['user', 'session', 'user_attendances', 'attachments', 'expenses', 'manyPayroll', 'incomes'])->find($request->id);


        $AttendanceTypes = AttendanceType::all();
        $Present = $AttendanceTypes->where('code', '=', 'present')->first();
        $lateWithExcuse = $AttendanceTypes->where('code', '=', 'late_with_excuse')->first();
        $Late = $AttendanceTypes->where('code', '=', 'late')->first();
        $Leave = $AttendanceTypes->where('code', '=', 'leave')->first();
        $Absent = $AttendanceTypes->where('code', '=', 'absent')->first();
        $Holiday = $AttendanceTypes->where('code', '=', 'holiday')->first();
        $HalfDay = $AttendanceTypes->where('code', '=', 'half_day')->first();

        $present_count = $UserSession->user_attendances->where('attendance_type_id', '=', $Present->id)->count();
        $late_with_excuse_count = $UserSession->user_attendances->where('attendance_type_id', '=', $lateWithExcuse->id)->count();
        $late_count = $UserSession->user_attendances->where('attendance_type_id', '=', $Late->id)->count();
        $leave_count = $UserSession->user_attendances->where('attendance_type_id', '=', $Leave->id)->count();
        $absent_count = $UserSession->user_attendances->where('attendance_type_id', '=', $Absent->id)->count();
        $holiday_count = $UserSession->user_attendances->where('attendance_type_id', '=', $Holiday->id)->count();
        $half_day_count = $UserSession->user_attendances->where('attendance_type_id', '=', $HalfDay->id)->count();

        $period = now()->subMonths(11)->monthsUntil(now());

        $attendanceArray = [];
        foreach ($period as $date) {
            for ($i = 01; $i <= 31; $i++) {
                $day = $i;
                if ($i <= 9)
                    $day = '0' . $i;

                $month_date = $date->year . '-' . $date->month . '-' . $day;
                $UserAttendance = UserAttendance::with('attendance_type')->firstWhere(['user_session_id' => $request->id, 'attendance_at' => $month_date]);
                $code = '-';
                $color = '';
                if ($UserAttendance) {
                    $code = $UserAttendance->attendance_type->attendance_type_class;
                    $color = $UserAttendance->attendance_type->color;
                }

                $month = SiteHelper::reformatReadableMonthNice($date->year . '-' . $date->month);

                $attendanceArray[$month][$month_date] = [$code, $color];

            }
        }
        $attendanceArrayReversed = array_reverse($attendanceArray, true);
//        $newArray = collect($reversed);

        return response()->json([
            'status' => true,
            'data' => $UserSession,
            'attendances' => $attendanceArrayReversed,
            'present_count' => $present_count,
            'late_with_excuse_count' => $late_with_excuse_count,
            'late_count' => $late_count,
            'leave_count' => $leave_count,
            'absent_count' => $absent_count,
            'holiday_count' => $holiday_count,
            'half_day_count' => $half_day_count,
        ]);
    }

    public function delete(Request $request)
    {
        $UserSession = UserSession::find($request->id);
        $user_id = $UserSession->id;
        $UserSession->delete();
        User::where(['id' => $user_id])->delete();

        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }

    public function saveStudentDocument(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'attachment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->first()
            ]);
        }

        $picture = $request->file('attachment');
        $type = $picture->getClientOriginalExtension();
        $picture_name = Str::random(10) . '.' . $type;
        $picture->move(public_path('uploads/user/attachments'), $picture_name);

        Attachment::create([
            'name' => $request->title,
            'file_name' => $picture_name,
            'type' => $type,
            'object' => 'UserSession',
            'object_id' => $request->id
        ]);

        return response([
            'status' => true,
            'message' => 'Record Saved Successfully',
            'data' => Attachment::where('object_id', $request->id)->where('object', 'UserSession')->get()
        ]);
    }

    public function generateUserCard(Request $request)
    {
        $User = UserSession::with(['user', 'session'])->find($request->id);
        $personal_number = $User->personal_number;

//        QrCode::size(500)
//            ->format('png')
//            ->generate("$personal_number", public_path('uploads/qr-code/' .$personal_number. '.png'));
//
//        $path = asset('uploads/qr-code/'.$personal_number.'.png');

        PDF::loadView('invoice.user-card-template', ['data' => $User, 'school' => School::find(1)], [], [
            'title' => 'Fee Voucher',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'format' => [160, 110],
            ])->save(public_path() . '/uploads/user/cards/' . $personal_number . '.pdf');

        $open_path = env('BASE_URL') . 'public/uploads/user/cards/'.$personal_number.'.pdf';
        return response()->json([
            'status' => true,
            'message' => 'Card Generate Successfully',
            'card_path' => $open_path
        ]);
    }

    public function getUser($role_id){
        
        if ($role_id == 'all') {
            $User = User::all();
        } else {
            $User = User::whereIn('role_id', [$role_id])->get();
        }
        // return $User;
        return response()->json([
            'status' => true,
            'data' => $User
        ]);

        // ->when($request->class_id, function ($q, $class_id) {
        //     $q->where('class_id', $class_id);
    }
}
