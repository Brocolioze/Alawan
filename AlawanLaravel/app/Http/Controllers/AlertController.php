<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\Alert;
use App\Http\Resources\AlertResource;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class AlertController extends Controller
{

    public function getAllAlerts()
    {
        try{
            $alerts = Alert::whereNull('dateFind')->get();
            Log::debug($alerts);
            foreach($alerts as $alert){
                if($alert->alerteFound == 0){
                    $alert->alerteFound = false;
                }
                else{
                    $alert->alerteFound = true;
                }
            }
            Log::debug($alerts);
            return response()->json($alerts);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(['message' => 'Failed to delete alert: ' . $e->getMessage()], 500);
        }
        


    }

    public function addAlert(Request $request)
    {
        try {
            Log::debug('tu rentres xderdans');
            $alert = new Alert([
                'idAnimal' => $request->input('idAnimal'),
                'dateLost' => Carbon::now()->format('Y-m-d'),
                'dateFind' => $request->input('dateFind'),
                'place' => "Pavillon des Sciences, 3500 Rue de Courval, Trois-Rivières, QC G8Z 1T2",
                'description' => $request->input('description'),
                'alerteFound' => 0
            ]);
            Log::debug($alert);
            $alert->save();
            Log::debug("sauvegarde");
            return response()->json(true);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function deleteAlert($id)
    {
        try {
            $alert = Alert::findOrFail($id);
            $alert->delete();

            return response()->json(['message' => 'Alert deleted successfully'], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete alert: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Alert not found'], 404);
        }
    }

    public function getAlert(Request $request)
    {
        try{
            $alert = Alert::where('idAnimal',$request->id)->where('dateFind',NULL)->first();
            if($alert->alerteFound == 1){
                $alert->alerteFound = true;
            }
            else{
                $alert->alerteFound = false;
            }
            return response()->json($alert);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(['message' => 'Failed to delete alert: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            Log::debug($e);
            return response()->json(['message' => 'Alert not found'], 404);
        }
    }

}
