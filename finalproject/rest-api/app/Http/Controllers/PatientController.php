<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;



class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();

        $data = [
            'message' => 'Get All Patients',
            'data' => $patients
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request) #cara menangkap data = request
    {
        #menambahkan validasi
        $request->validate([
            'name' => "required",
            'phone' => "required|numeric",
            'address' => "required",
            'status' => "required",
            'in_date_at' => "required",
            'out_date_at' => "required"
        ]);


        $patient = Patient::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at
        ]);

        $data = [
            'message' => 'Patient is created',
            'data' => $patient
        ];

        return response()->json($data, 201);
    }

    #method show
    public function show($id)
    {
        $patient = Patient::find($id);

        if ($patient) {
            $data = [
                'message' => 'Get detail patient',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data patient not found',
            ];

            return response()->json($data, 404);
        }
    }

    #method PUT

    public function update(Request $request, $id)
    {

        #kalau ingin mengupdate satu data aja 
        /*
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan 
                */

        $patients = Patient::find($id);

        if ($patients) {
            $patients->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
                'in_date_at' => $request->in_date_at,
                'out_date_at' => $request->out_date_at
            ]);

            /* 'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status' => $request->status ?? $patients->status,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at
                */

            $data = [
                'message' => 'Data is updated',
                'data' => $patients
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data patient not found',
            ];

            return response()->json($data, 404);
        }
    }

    #method DESTROY

    public function destroy($id)
    {

        $patient = Patient::find($id);

        if ($patient) {
            $patient->delete();

            $data = [
                'message' => 'Data patient is deleted'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }
    }


    #method GET resources by name
    public function search($name)
    {
        $patient = Patient::find($name);

        if ($patient) {
            $patient->name();

            $data = [
                'message' => 'Data is found',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data not found',
            ];

            return response()->json($data, 404);
        }
    }

    public function positive()
    {
        $patient = Patient::where('status', 'positive')->get();

        if ($patient) {

            $data = [
                'message' => 'Data is found',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function recovered()
    {
        $patient = Patient::where('status', 'recovered')->get();

        if ($patient) {

            $data = [
                'message' => 'Data is found',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function dead()
    {
        $patient = Patient::where('status', 'dead')->get();

        if ($patient) {

            $data = [
                'message' => 'Data is found',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data not found',
            ];

            return response()->json($data, 404);
        }
    }
}
