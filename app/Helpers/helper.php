<?php
use Carbon\Carbon;

function format_data($record) {

    $employee = [];
    $employee['id'] = $record['Emp ID'];
    $employee['name_prefix'] = $record['Name Prefix'];
    $employee['first_name'] = $record['First Name'];
    $employee['middle_initial'] = $record['Middle Initial'];
    $employee['last_name'] = $record['Last Name'];
    $employee['gender'] = $record['Gender'];
    $employee['email'] = $record['E Mail'];
    $raw_date_of_birth = $record['Date of Birth'];
    $formated_date_of_birth = Carbon::createFromFormat('m/d/Y', $raw_date_of_birth)->format("Y-m-d");
    $employee['date_of_birth'] = $formated_date_of_birth;
    $raw_time_of_birth = $record['Time of Birth'];
    $formatted_time_of_birth = Carbon::createFromFormat('g:i:s A', $raw_time_of_birth)->format('H:i:s');
    $employee['time_of_birth'] = $formatted_time_of_birth;
    $employee['age_in_years'] = $record['Age in Yrs.'];
    $raw_date_of_joining = $record['Date of Joining'];
    $formated_date_of_joining = Carbon::createFromFormat('m/d/Y', $raw_date_of_joining)->format("Y-m-d");
    $employee['date_of_joining'] = $formated_date_of_joining;
    $employee['age_in_company'] = $record['Age in Company (Years)'];
    $employee['phone_no'] = $record['Phone No. '];
    $employee['place_name'] = $record['Place Name'];
    $employee['county'] = $record['County'];
    $employee['city'] = $record['City'];
    $employee['zip'] = $record['Zip'];
    $employee['region'] = $record['Region'];
    $employee['user_name'] = $record['User Name'];

    return $employee;
}