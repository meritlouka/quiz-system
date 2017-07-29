<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Redirect;
use Response;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
class AdminController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  request
     * @return view
     */
    protected function store(Request $request)
    {   
        $rules = array(
           'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
        );
        $data = $request->all();
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('register_admin')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            

            User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => sha1($data['password']),
                'is_admin' => 1
            ]);

            return response()
                ->view('settings.register_success');
        }
    }
   
    protected function changePassword(Request $request)
    { 
        $rules = array(
            'password' => 'required|min:5|confirmed',
        );

        $data = $request->all();
        $validator = Validator::make($data, $rules);


        if ($validator->fails()) {
            return Redirect::to('addAdmin')
                           ->withErrors($validator);
        } 
        else {

            $user = Auth::user();
            $user->update(['password' => sha1($data['password'])]); 
           
            return response()
                ->view('admin.admin');
        }    

    }
  
    protected function deleteMyAccount(Request $request)
    { 
            $user = Auth::user()->delete();
            return Redirect::to('logout');   
    }
    protected function resetAllTables(Request $request)
    { 
        
        $tables = DB::select('SHOW TABLES');
        $colName = 'Tables_in_' . env('DB_DATABASE');
        DB::beginTransaction();
        //turn off referential integrity
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach($tables as $table) {

            $tableName= $table->$colName;
            DB::statement("Truncate TABLE $tableName");
        }
        

        //turn referential integrity back on
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        User::create([
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => sha1(12345),
                'is_admin' => 1
            ]);
        DB::commit();
        return response()
                ->view('admin.admin');
    }

}