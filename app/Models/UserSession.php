<?php

namespace App\Models;

use App\Helpers\SiteHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSession extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = ['dob_formatted', 'joining_date_formatted', 'leave_date_formatted'];

    public function user()
    {
        return $this->belongsTo(User::class)->with('role');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class)->with('expense_head')->latest();
    }

    public function incomes(){
        return $this->hasMany(Income::class)->with('income_head')->latest();
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'object_id', 'id')->where('object', 'UserSession')->latest();
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function user_attendances()
    {
        return $this->hasMany(UserAttendance::class)->with('attendance_type');
    }

    public function payroll()
    {
        return $this->hasOne(Payroll::class);
    }

    public function manyPayroll()
    {
        return $this->hasMany(Payroll::class)->with('payment_method')->latest();
    }


    public function getDobFormattedAttribute()
    {
        return SiteHelper::reformatReadableDate($this->dob);
    }

    public function getJoiningDateFormattedAttribute()
    {
        return SiteHelper::reformatReadableDate($this->joining_date);
    }

    public function getLeaveDateFormattedAttribute()
    {
        if ($this->leave_date)
            return SiteHelper::reformatReadableDate($this->leave_date);
        else
            return '';
    }
}
