<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\LmsG50Carrier;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get('https://fleet-g43.bbox-express.com/api/vehicle');

        if ($response->successful()) {
            $drivers = $response->json()['driver'];

            $vehicleBrands = [];
            $loadCapacities = [];
            foreach ($drivers as $driver) {
                $vehicleBrands[] = $driver['vehicle_brand'];
                $loadCapacities[] = (float) $driver['load_capacity'];
            }

            $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

            if ($response->successful()) {
                $transactions = $response->json();



                return view('content.pages.HomeDash', compact('transactions','drivers', 'vehicleBrands', 'loadCapacities'));
            } else {
                $errorMessage = $response->status() . ' - ' . $response->body();
                return view('content.pages.HomeDash', compact('errorMessage'));
            }
        }
    }
    public function vehicleToEDIFACT(Request $request)
    {

        $vehicleData = $request->input('vehicle');

        $edifactData = "UNA:+.? '";
        $edifactData .= "UNB+UNOA:2+SENDER+RECEIVER+YYMMDD:HHMM+0001++++++EDIFACT'";
        $edifactData .= "UNH+1+ORDERS:D:96A:UN:EAN008'";
        $edifactData .= "BGM+220+ORDERREFERENCE+9'";
        $edifactData .= "DTM+4:20220409:102'";
        $edifactData .= "NAD+BY+123456789::9'";
        $edifactData .= "LIN+1++ITEM1'";
        $edifactData .= "QTY+21:1'";
        $edifactData .= "FTX+AAA+++Vehicle Details'";
        $edifactData .= "RFF+PD:V123'";

        $edifactData .= "LOC+VES+{$vehicleData['id']}+{$vehicleData['vehicle_id']}+{$vehicleData['vehicle_brand']}+{$vehicleData['year_model']}+{$vehicleData['vehicle_type']}+{$vehicleData['plate_number']}+{$vehicleData['load_capacity']}+{$vehicleData['status']}'";
        $edifactData .= "UNT+9+1'";
        $edifactData .= "UNZ+1+0001'";


        return response()->json([
            'success' => true,
            'edifact' => $edifactData,
        ]);
    }



    public function processToEDIFACT(Request $request)
    {

        $transaction = $request->input('transaction');

        $edifactData = $this->convertToEDIFACT($transaction);

        return response()->json(['edifact' => $edifactData]);
    }

    private function convertToEDIFACT($transaction)
    {

        $edifact = "UNA:+.? '" . PHP_EOL;


        $edifact .= "UNB+UNOA:1+SENDER+RECEIVER+200101:1020+1++INVOIC++1'" . PHP_EOL;


        $edifact .= "UNH+1+INVOIC:D:96A:UN:EDIFACT'" . PHP_EOL;


        $edifact .= "BGM+220+" . $transaction['id'] . "+9'" . PHP_EOL;


        $edifact .= "DTM+137:" . date('Ymd', strtotime($transaction['transactionDate'])) . ":102'" . PHP_EOL;
        $edifact .= "NAD+BY+" . $transaction['productName'] . "'" . PHP_EOL;
        $edifact .= "NAD+SE+" . $transaction['transactionName'] . "'" . PHP_EOL;
        $edifact .= "MOA+9:" . $transaction['transactionAmount'] . "'" . PHP_EOL;
        $edifact .= "FTX+AAI+++" . $transaction['description'] . "'" . PHP_EOL;


        $edifact .= "UNT+7+1'" . PHP_EOL;

        return $edifact;
    }

}
