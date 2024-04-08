<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChecklistItem;

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

                return view('content.pages.homedash', compact('transactions','drivers', 'vehicleBrands', 'loadCapacities'));
            } else {
                $errorMessage = $response->status() . ' - ' . $response->body();
                return view('content.pages.homedash', compact('errorMessage'));
            }
        }
    }

    public function vehicleToEDIFACT(Request $request)
    {
        // Fetch the vehicle data from the request
        $vehicleData = $request->input('vehicle');

        // Check if vehicleData is properly received
        dd($vehicleData);

        // Convert the vehicle data to EDIFACT format
        $edifactFLEET = $this->vehicleDELIVERY($vehicleData);

        // Return the EDIFACT data
        return response()->json(['edifact' => $edifactFLEET]);
    }


    private function vehicleDELIVERY($vehicleData)
    {
        // Construct EDIFACT message using vehicle data
        $edifactMessage = "UNA:+.? '"; // Service String Advice (SSA)
        $edifactMessage .= "UNB+UNOA:1+SENDERID+RECEIVERID+210101:1234+000000123'"; // Interchange Header
        $edifactMessage .= "UNH+0001+DELFOR:D:96A:UN:EAN008'"; // Message Header (Changed INVOIC to DELFOR for delivery)
        $edifactMessage .= "BGM+351+Delivery instruction'"; // Beginning of Message (Changed 380 to 351 for delivery instruction)
        $edifactMessage .= "DTM+137:{$vehicleData['created_at']}"; // Date/time of the message
        $edifactMessage .= "LIN+1++{$vehicleData['vehicle_id']}:EN'";
        $edifactMessage .= "PIA+1+VP:{$vehicleData['vehicle_id']}"; // Additional Product ID
        $edifactMessage .= "MEA+WT+G+KGM:{$vehicleData['load_capacity']}'"; // Measurement
        $edifactMessage .= "FTX+AAA++::{$vehicleData['vehicle_brand']} {$vehicleData['year_model']} {$vehicleData['vehicle_type']}'"; // Free Text
        $edifactMessage .= "RFF+ON:{$vehicleData['plate_number']}'"; // Reference
        $edifactMessage .= "UNS+S'"; // Section Control
        $edifactMessage .= "CNT+2:1'"; // Control total
        $edifactMessage .= "UNT+13+0001'"; // Message Trailer
        $edifactMessage .= "UNZ+1+000000123'"; // Interchange Trailer

        return $edifactMessage;
    }

    public function processToEDIFACT(Request $request)
    {
        // Fetch the transaction data from the request
        $transaction = $request->input('transaction');

        // Convert the transaction data to EDIFACT format
        $edifactData = $this->convertToEDIFACT($transaction);

        // Return the EDIFACT data
        return response()->json(['edifact' => $edifactData]);
    }

    private function convertToEDIFACT($transaction)
    {
        // Start with UNA segment
        $edifact = "UNA:+.? '" . PHP_EOL;

        // UNB segment (Interchange Header)
        $edifact .= "UNB+UNOA:1+SENDER+RECEIVER+200101:1020+1++INVOIC++1'" . PHP_EOL;

        // UNH segment (Message Header)
        $edifact .= "UNH+1+INVOIC:D:96A:UN:EDIFACT'" . PHP_EOL;

        // BGM segment (Beginning of Message)
        $edifact .= "BGM+220+" . $transaction['id'] . "+9'" . PHP_EOL;

        // Additional segments based on transaction data
        $edifact .= "DTM+137:" . date('Ymd', strtotime($transaction['transactionDate'])) . ":102'" . PHP_EOL;
        $edifact .= "NAD+BY+" . $transaction['productName'] . "'" . PHP_EOL;
        $edifact .= "NAD+SE+" . $transaction['transactionName'] . "'" . PHP_EOL;
        $edifact .= "MOA+9:" . $transaction['transactionAmount'] . "'" . PHP_EOL;
        $edifact .= "FTX+AAI+++" . $transaction['description'] . "'" . PHP_EOL;

        // End with UNT segment (Message Trailer)
        $edifact .= "UNT+7+1'" . PHP_EOL;

        return $edifact;
    }
}
