<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Exports\UsersExport;
use Excel;

class Controller extends BaseController
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    
    public function exportViaConstructorInjection()
    {
        return $this->excel->download(new UsersExport, 'users.xlsx');
    }
    
    public function exportViaMethodInjection(Excel $excel)
    {
        return $excel->download(new UsersExport, 'users.xlsx');
    }

    public function show()
    {
    	// $result = DB::select("SELECT * FROM `tbl_details` WHERE `is_deleted` = 0");
        $result = DB::table('tbl_details')->where([ 'is_deleted' => 0 ])->paginate(10);
    	   return view('details', ['result'=>$result]);
        
    }

    public function viewEdit($details_id)
    { 
        $result_reg_details = DB::select("SELECT * FROM `tbl_details` WHERE `details_id`=$details_id");
        return view('view', ['result_reg_details'=>$result_reg_details]);
        
    }

    public function editReg(Request $request)
    {
        $details_id = $request->input('details_id');
        // dd($details_id);
        $id = $request->input('id');
        $title = $request->input('title');
        $body = $request->input('body');
        $update_JSON = ['id' => $id,'title' => $title,'body' => $body,];
        $result = DB::table('tbl_details')->where('details_id', $details_id)->update($update_JSON);
        if($result){
            //return redirect()->back()->with('success-message', 'Member updated successfully.');
            return Redirect::to('edit/'.$details_id)->with('success-message', 'Member updated successfully.');
        }
        else{
            return redirect()->back()->with('error-message', 'Something went wrong. Try again.');
        }
    }

    public function rejectReg($details_id)
    {
            $res_check = DB::table('tbl_details')->where(['details_id' => $details_id,'is_deleted' => 0])->count();
            if($res_check > 0){
                $result = DB::table('tbl_details')->where('details_id', $details_id)->update(['is_deleted' => 1]);
                if($result){
                    return redirect()->back()->with('success-message', 'Member successfully Deleted.');
                }
                else{
                    return redirect()->back()->with('error-message', 'Something went wrong. Try again.');
                }
            }
            else{
                return redirect()->back()->with('error-message', 'Sorry! This member is already rejected or deleted form our record.');
            }
    }

public function exportCsv(Request $request)
{
   $fileName = 'tasks.csv';
   $tasks = Task::all();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Id', 'Title', 'Body');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Id']  = $task->id;
                $row['Title']    = $task->title;
                $row['Body']    = $task->body;

                fputcsv($file, array($row['Id'], $row['Title'], $row['DesBodycription']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
