<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jobs\EmployeeWorker;
use League\Csv\Reader;
use App\Helpers\helper as Helper;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Database\QueryException;

class EmployeeController extends Controller
{

    protected $rules = [
        'Name Prefix' => 'required|string|max:100',
        'First Name' => 'required|string|max:100',
        'Middle Initial' => 'string|max:1',
        'Last Name' => 'required|string|max:100',
        'Gender' => 'required|in:M,F',
        'E Mail' => 'required|email',
        'Date of Birth' => 'date:m/d/Y',
        'Time of Birth' => 'date_format:g:i:s A',
        'Age in Yrs.' => 'nullable|regex:/^\d+(\.\d+)?$/',
        'Date of Joining' => 'required|date:m/d/Y',
        'Age in Company (Years)' => 'nullable|regex:/^\d+(\.\d+)?$/',
        'Phone No. ' => 'nullable|regex:/^\d{3}-\d{3}-\d{4}$/',
        'Place Name' => 'required|string|max:100',
        'County' => 'required|string|max:100',
        'City' => 'required|string|max:100',
        'Zip' => 'numeric|max:1000000',
        'Region' => 'required|string|max:100',
        'User Name' => 'required|string|max:100',
    ];

    public function load_db(Request $request){
        try {
            $file_path = $request->getContent();
            $file_content = file_get_contents($file_path);
            $reader = Reader::createFromString($file_content);
            $reader->setHeaderOffset(0);
            $employees = [];
            set_time_limit(0);
            $count = count($reader);
            foreach ($reader as $record) {
                // Create an instance of your model
                $validator = Validator::make($record, $this->rules);
                if ($validator->fails()) {
                    continue; // Skip invalid row
                }
                $employee = format_data($record);
                array_push($employees, $employee);
                if (count($employees) == $count / 100) {
                    //Break the task and run Job workers!!!
                    EmployeeWorker::dispatch($employees);
                    $employees = array();
                }
            }
    
            if (count($employees) != 0) {
                EmployeeWorker::dispatch($employees);
            }
    
            return response()->json(['message' => 'Successfully DB loaded!']);
        } catch(QueryException $e) {
            return response()->json(['message' => 'Fail to load DB!', 'error' => $e]);
        }
    }

    public function get_all_employee() {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    public function get_employee($id) {

        $employee = Employee::find($id);

        if ($employee) {
            return response()->json($employee, 200);
        } else {
            return response()->json(['result' => 'No employee!'], 200);
        }
    }

    public function del_employee($id) {

        $employee = Employee::destroy($id);
        if ($employee) {
            return response()->json(['result' => 'Successfully removed!'], 200);
        } else {
            return response()->json(['result' => 'Fail to remove!'], 200);
        }
    }

}
