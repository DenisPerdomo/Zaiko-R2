<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Register;
use App\Models\RegisterDepartment;
use App\Models\RegisterUbication;
use App\Models\Site;
use App\Models\Ubication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class RegisterController extends Controller
{
    

    public function sites(){

        $sites=Site::all();

        return $sites;

   }

   public function ubications($site){

    $ubications = Ubication::where('site_id',$site)->get();

    return $ubications;
    
}

    public function create(Request $request){

        return Inertia::render('Registers/Create',[

            'id' => $request->id,
            'departments' => Department::all(),
        ]);

    }
    
    public function store($id){

        $data = RequestFacade::validate([

            'user' => 'required',
            'comment' => 'nullable',
            'modification_date' => 'nullable',
            'department' => 'required',
            'ubication' => 'required',



        ]);


        if($data['modification_date'] == ''){

            $date = Carbon::now()->format('Y-m-d');
            $data['modification_date'] = $date;

        }

            Register::create([

            'user' => $data['user'],
            'comment' => $data['comment'],
            'device_id'=>$id

        ])->where('device_id',$id);

        
        $lastregister=Register::where('registers.device_id','=',$id)->first();

        $lastregister->update([

            'user' => $data['user'],
        
        ]);

        $registerubication= RegisterUbication::where('register_id',$lastregister->id);

        $registerubication->update([

            'modification_date' => $data['modification_date'],
            'ubications_id' => $data['ubication'],
        ]);

        $registerdepartment = RegisterDepartment::where('register_id',$lastregister->id);

        $registerdepartment->update([

            'modification_date' => $data['modification_date'],
            'departments_id' => $data['department'],
        ]);

        

        return back();
    }


    public function edit($id){

        return Inertia::render('Registers/Edit',[


            'register' => Register::where('device_id',$id)->first(),

        ]);

    }

    public function destroy($id){

        $register = Register::where('device_id',$id)->first();

        $register->delete();

        return back()->with('success','Register deleted successfully');

    }

}
