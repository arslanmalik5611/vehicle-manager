<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Attendance History</title>
    <style>
        table {
            width: 100%;
            line-height: 10pt;
            text-align: left;
            /*border-spacing: 0;*/
            border-collapse: collapse;
        }

        .maintable th {
            border: 1px solid #000;
            font-size: 12px;
            /*line-height: 10px;*/
            text-align: center;
            padding: 5px;
            color: #fff;
            background-color: #000;
        }

        .maintable td {
            border: 1px solid #000;
            font-size: 12px !important;
            padding: 6px !important;
            /*text-align: center;*/
        }

    </style>
</head>
<body>
<style>
    .attendance-type-td {
        font-size: 15px !important;
    }
</style>
<div class="main">
    <div class="card text-dark shadow-2 mb-3" style="width: 70%; margin: auto">
        <div class="card-header">
            <table>
                <tr>
                    <td style="width: 170px">
                        <img src="{{$school->logo_url}}" width="150" alt="">
                    </td>
                    <td>
                        <h2 class="school-name">
                            {{$school->name}}
                        </h2>
                        <p>{{$school->address}}</p>
                        <p><span>Email : </span>{{$school->email}}</p>
                        <p><span>Phone :</span>{{$school->phone}}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            @if($data)
                <table class="table table-bordered tabs-table attendance-table maintable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Month</th>
                        <th>01</th>
                        <th>02</th>
                        <th>03</th>
                        <th>04</th>
                        <th>05</th>
                        <th>06</th>
                        <th>07</th>
                        <th>08</th>
                        <th>09</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                        <th>25</th>
                        <th>26</th>
                        <th>27</th>
                        <th>28</th>
                        <th>29</th>
                        <th>30</th>
                        <th>31</th>
                    </tr>
                    </thead>
                    <tbody class="attendanceBody">
                    @foreach($data as $user)
                        <tr>
                            <td>{{$user->user->first_name . ' ' . $user->user->last_name}}</td>
                            <td>{{$user->month}}</td>
                            @foreach($user->monthly_attendances as $attendance)
                                <td style="background-color: {{$attendance[1]}}">{{$attendance[0]}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; background: #ccc">Nothing Found</p>
            @endif
        </div>
    </div>
</div>
</body>
</html>



