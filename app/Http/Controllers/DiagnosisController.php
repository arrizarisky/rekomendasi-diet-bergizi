<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\DiagnosisHelper;

class DiagnosisController extends Controller
{
    public function form()
    {
        $gejalaPertanyaan = DiagnosisHelper::gejalaPertanyaan();
        return view('form', compact('gejalaPertanyaan'));
    }

    public function diagnose(Request $request)
    {
        $validated = $request->validate([
            'umur' => 'required|numeric|min:1',
            'gender' => 'required|in:male,female',
            'berat' => 'required|numeric|min:1',
            'tinggi' => 'required|numeric|min:1',
            'gejala' => 'required|array|min:1',
        ]);
        $diagnosisResult = DiagnosisHelper::diagnose($request);     
        return view('result', ['diagnosisResult' => $diagnosisResult]);
    }
}
