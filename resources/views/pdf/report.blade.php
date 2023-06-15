<!DOCTYPE html>
<html>
<head>
    <title>Employee Attendance Log</title>
    <style>
        body {
            background-color: blue;
            color: white;
            font-family: Arial, sans-serif;
        }

        .page-heading {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .sub-heading {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid white;
        }

        th {
            background-color: red;
        }
    </style>
</head>
<body>
    @php
        $start =  \Carbon\Carbon::createFromFormat('Y-m-d', $from)->format('d-M-Y');
        $stop =  \Carbon\Carbon::createFromFormat('Y-m-d', $to)->format('d-M-Y');
    @endphp
    <div class="page-heading">Zimbabwe Electricity Transmission & Distribution Company</div>
    <div class="sub-heading">Attendance Sheet from {{$start}} to {{$stop}}</div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>EC Number</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $att)
                <tr>
                    @php
                        $emp = \App\Models\Employee::find($att->employee_id);
                        $formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d', $att->date)->format('d-M-Y');
                    @endphp
                    <td>{{$emp->fname}} {{$emp->lname}}</td>
                    <td>{{$emp->ecnum}}</td>
                    <td>{{$formattedDate}}</td>
                    <td>{{$att->time_in}}</td>
                    <td>{{$att->time_out}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
