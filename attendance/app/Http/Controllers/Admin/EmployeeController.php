<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return view('admin.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $employee = Employee::create($request->except(['_token']));
        $employee = \App\Models\Employee::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'dob'       => $request->dob,
            'city'      => $request->city,
            'status'    => 1,
        ]);

        $password = $this->randomString(12);
        $user = \App\Models\User::create([
            'employee_id'   => $employee->id,
            'name'          => $employee->name,
            'email'         => $employee->email,
            'password'      => bcrypt($password),
            'role'          => 'user',
            'create_date'   => now()->format('Y-m-d'),
            'status'        => 1,
        ]);

        $user->password = $password;

        try {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\NewEmployeeMail($user));
        } catch (\Exception $ex) {
            Log::debug($ex);
        }

        return redirect()
            ->route('employee.index')
            ->with('success', 'Permohonan employee telah dikirim');
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
    public function edit(Request $request, $id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('admin.employee.edit', compact('employee'));
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
        $employee = Employee::where('id', $id)->first();
        $user = User::where('employee_id', $employee->id)->first();

        if ($employee) {
            $employee->update([
                'name'  => $request->name,
                'email' => $request->email,
                'dob'   => $request->dob,
                'city'  => $request->city,
                'status'=> $request->status,
            ]);
        }

        if ($user) {
            $user->update([
                'name'  => $employee->name,
                'email' => $employee->email,
            ]);
        }

        return redirect()
            ->route('employee.index')
            ->with('success', 'Data employee telah diubah');
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

    function randomString(int $length = 8): string {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode('', $pass);
    }
}
