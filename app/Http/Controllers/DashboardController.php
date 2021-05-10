<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Package;
use App\Models\PackageApplication;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
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
        $user = Auth::user();

        if ($user != null && $user->has_subscribed != 1)
        {
            $packages = Package::where('is_open','=', true)->limit(3)->get();
        }else{
            $packages = Package::where('is_open','=', true)->get();
        }

        $runningPackages = $packages = PackageApplication::where('user_id','=', $user->id)
            ->leftJoin('packages', 'packages.id', 'package_applications.package_id')
            ->leftJoin('stages', 'stages.id','package_applications.status')->select([
                'package_applications.*', 'stage', 'name', 'description', 'amount','requirements','is_open'])->get();

        return view('dashboard', ['packages' => $packages, 'applications' => $runningPackages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
