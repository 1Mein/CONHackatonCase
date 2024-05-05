<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Record;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RecordController extends Controller
{
    public function index(){

        $records = Record::all();

        return response()->json($records);
    }

    public function show(Record $record){
        return response()->json($record);
    }

    public function store(Request $request){
        try {
            $data = $request->validate([
                'time' => 'required|date',
                'number' => 'required|integer',
                'service_id' => 'required|integer|exists:services,id',
            ]);

            $user_id = User::where('number', $data['number'])->pluck('id')->first()??throw new \Exception('User with this number not found');
            unset($data['number']);
            $data['user_id'] = $user_id;

            $windows = Service::find($data['service_id'])->windows()->pluck('window_number');
            $timeRecords = Record::where('time', $data['time'])->pluck('window_number');
            $freeWindow = $windows->diff($timeRecords)->first()??throw new \Exception('Can not find free window');

            $data['window_number'] = $freeWindow;

            $report = Record::create($data);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e){
            return response()->json(['error' =>  $e->getMessage()], 404);
        }

        return response()->json(['success' => true, 'message' => 'Data has been successfully stored'], 200);
    }
}
