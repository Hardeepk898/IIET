Dear Administrator,<br><br>

Please find below details for new admission. <br><br>
<b>Firstname:</b> {{$data['firstname']}}<br>
<b>Lastname:</b> {{$data['lastname']}}<br>
<b>Email:</b> {{$data['email']}}<br>
<b>Phone:</b> {{$data['phone']}}<br>
<b>DOB:</b> {{$data['dob']}}<br>
<b>Guardian Name:</b> {{$data['guardian_name']}}<br>
<b>Religion:</b> {{$data['religion']}}<br>
<b>Gender:</b> {{($data['gender'] == 1)?'Male':'Female'}}<br>
<b>Address 1:</b> {{$data['address1']}}<br>
<b>Address 2:</b> {{$data['address2']}}<br>
<b>City:</b> {{$data['city']}}<br>
<b>State:</b> {{$data['state']}}<br>
<b>Country:</b> {{$data['country']}}<br>
<b>Postcode:</b> {{$data['postcode']}}<br>
<b>Course:</b> {{$data['course']}}<br>
<b>Center:</b> {{$data['center']}}<br>
<b>Category:</b> <?php
switch ($data['category']) {
    case 1:
        echo 'Gen';
        break;
    case 2:
        echo 'SC';
        break;
    case 3:
        echo 'ST';
        break;
    case 4:
        echo 'OBC';
        break;
    default:
        echo '';
        break;
}
?>
<br>
<b>School Name:</b> {{$data['school_name']}}<br>
<b>Class:</b> {{$data['class']}}<br>
<b>Education Details:</b> <br>
<table>
    <tr>
        <th>Examination</th>
        <th>Board/University</th>
        <th>Passing Year</th>
        <th>Total Marks</th>
        <th>Percentage</th>
    </tr>
    @foreach($data['education'] as $edu)
    <tr>
        <td>{{$edu['examination']}}</td>
        <td>{{$edu['university']}}</td>
        <td>{{$edu['passing_year']}}</td>
        <td>{{$edu['total_marks']}}</td>
        <td>{{$edu['percentage_marks']}}%</td>
    </tr>
    @endforeach
</table>

<br><br>

Thanks,<br>
Private Job Recruitment Cell Team<br>
