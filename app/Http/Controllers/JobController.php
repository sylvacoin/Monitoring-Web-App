<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $jobs = Job::where('is_open','=', true)->get();
        return view('job.index', ['jobs' => $jobs, 'user_has_subscribed' => Auth::user()->has_subscribed ]);
    }

    public function apply(Request $request)
    {
        $job_id = $request->job_id;

        //check if job exists
        $job = Job::find($job_id);
        if ($job == null)
        {
            return response()->json(['success' => false, 'message' => ['job does not exist']], 422);
        }
        //check if job already applied for
        $user_id = Auth::user()->id;

        $count = JobApplication::where('user_id', $user_id)->where('job_id', $job_id)->count();
        if ($count > 0)
        {
            return response()->json(['success' => false, 'message' => ['You already applied for this job']], 422);
        }
        //apply for job
        $jobApplication = JobApplication::create([
            'job_id' => $job_id,
            'user_id' => $user_id,
            'is_hired' => false
        ]);

        if ($jobApplication == null )
            return response()->json(['success' => false, 'message' => ['Job application failed. Please try again']], 422);

        return response()->json(['success' => true, 'message' => 'You applied for this job successfully'], 422);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $jobs = Job::all();
        return view('job.create', ['jobs' => $jobs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $file = '';

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'salary' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone' => 'required',
            'company_email' => 'required|email',
            'requirement' => 'required',
            'description' => 'required',
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()){
            return response()->json(['success' => false, 'message' => $validator->errors()->all()], 422);
        }

        if ($files = $request->file('company_logo'))
        {
            $filePath = $request->company_logo->store('public/logos');
            $pathArr = explode('/', $filePath);
            array_shift($pathArr);
            $file = implode('/', $pathArr);
        }

        $job = Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirement,
            'salary' => $request->salary,
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'company_logo' => $file,
            'is_open' => true
        ]);

        if ($job == null )
        {
            return response()->json(['success' => false, 'message' => ['An error occured while creating job']], 422);
        }
        return response()->json(['success' => true, 'message' => 'Job was created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        if (!isset($request->id) || empty($request->id))
        {
            return response()->json(['success' => false, 'message'=>['Data was not found']], 422);
        }

        $id = $request->id;
        $job = Job::find($id);

        if ($job == null )
        {
            return response()->json(['success' => false, 'message'=>['Data was not found']], 422);
        }

        $job->delete();
        return response()->json(['success' => true, 'message'=>'Job was deleted successfully'], 200);
    }
}
