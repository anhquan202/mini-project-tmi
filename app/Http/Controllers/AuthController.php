<?php

namespace App\Http\Controllers;

use App\Services\Auth\IAuthService;
use App\Services\Mail\IMailService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected IAuthService $iAuthServic, protected IMailService $iMailService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createVerifyPasswowrdCodeMail(Request $request)
    {
        try {
            $this->iMailService->sendVerifyResetCodeMail($request['email']);

            return response()->json(['message' => 'Mail đã được gửi, vui lòng kiểm  tra']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }

    }
}
