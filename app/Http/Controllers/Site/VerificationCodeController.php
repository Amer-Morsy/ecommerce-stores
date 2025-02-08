<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationRequest;
use App\Http\services\VerificationService;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{
    public $verificationService;

    public function __construct(VerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    public function verify(VerificationRequest $request)
    {

        $check = $this->verificationService->checkOTPCode($request->code);

        if (!$check) {  // code not correct

            return redirect()->route('get.verification.form')->withErrors(['code' => 'ألكود الذي ادخلته غير صحيح ']);

        } else {
            $this->verificationService->removeOTPCode($request->code);
            return redirect()->route('home');
        }
    }

    public function getVerifyPage()
    {
        return view('auth.verification');
    }
}
