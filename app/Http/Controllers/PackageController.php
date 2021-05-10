<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        if ($user != null && $user->has_subscription == true)
        {
            $packages = Package::where('is_open','=', true)->get();
        }else{
            $packages = Package::where('is_open','=', true)->where('subscribers_only', '=', false)->get();
        }
        return view('packages.index', ['packages' => $packages]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
            'requirement' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['success' => false, 'message' => $validator->errors()->toArray()], 422);
        }

        $package = Package::create([
            'name' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'requirements' => $request->requirement
        ]);

        if ( $package == null )
        {
            return response()->json(['success' => false, 'message' => ['An error occured package not added']], 422);
        }

        return response()->json(['success' => true, 'message' => 'Package was added successfully'], 200);
    }

    public function destroy(){
        return view('packages.index');
    }
    public function create(){
        $packages = Package::all();
        return view('packages.create',['packages'=>$packages]);
    }

    public function apply(Request $request){
        $package_id = $request->package_id;

        //check if job exists
        $job = Package::find($package_id);
        if ($job == null)
        {
            return response()->json(['success' => false, 'message' => ['job does not exist']], 422);
        }
        //check if job already applied for
        $user_id = Auth::user()->id;

        $count = PackageApplication::where('user_id', $user_id)->where('package_id', $package_id)->count();
        if ($count > 0)
        {
            return response()->json(['success' => false, 'message' => ['You already applied for this package']], 422);
        }
        //apply for job
        $jobApplication = PackageApplication::create([
            'package_id' => $package_id,
            'user_id' => $user_id,
            'is_completed' => false
        ]);

        if ($jobApplication == null )
            return response()->json(['success' => false, 'message' => ['Job application failed. Please try again']], 422);

        return response()->json(['success' => true, 'message' => 'You applied for this job successfully'], 200);
    }

    public function update_package_status(Request $request){
        $package_id = $request->package_id;

        $package = PackageApplication::find($package_id);
        if (!$package)
            return response()->json(['success' => false, 'message' => ['This application does not exist']], 422);

        $package->status = $request->status;
        $package->save();
        return response()->json(['success' => true, 'message' => 'Application status updated successfully'], 200);
    }

    public function applications()
    {
        $user = Auth::user();
        $packages = PackageApplication::where('user_id','=', $user->id)
            ->leftJoin('packages', 'packages.id', 'package_applications.package_id')
            ->leftJoin('stages', 'stages.id','package_applications.status')->select([
                'package_applications.*', 'stage', 'name', 'description', 'amount','requirements','is_open'])->get();
        return view('packages.applications', ['packages' => $packages]);
    }

    public function review()
    {
        $applications = PackageApplication::where('is_completed', '=', false)
            ->leftJoin('packages', 'packages.id', 'package_applications.package_id')
            ->leftJoin('stages', 'stages.id','package_applications.status')->select([
                'package_applications.*', 'stage', 'name', 'description', 'amount','requirements','is_open'])->get();
        return view('packages.review', ['applications' => $applications]);
    }

    public function upload_document(Request $request)
    {
        $files = $request->file('document');
        $packageId = $request->id;
        $filePaths = [];

        if($files != null)
        {

            foreach ($files as $file) {
                $filePath = $file->store('public/' . $packageId );

                $pathArr = explode('/', $filePath);
                array_shift($pathArr);
                $filePaths[] = implode('/', $pathArr);
            }

            $package = PackageApplication::find($packageId);
            if ($package == null )
            {
                return response()->json(['success' => false, 'message' => ['Document failed to upload']], 422);
            }

            $package->documents = serialize($filePaths);
            $package->status = 3;
            $package->save();



            return response()->json(['success' => true, 'message' => 'Document was uploaded succesfully'], 200);
        }
        return response()->json(['success' => false, 'message' => ['Document field is empty']], 422);
    }
}
