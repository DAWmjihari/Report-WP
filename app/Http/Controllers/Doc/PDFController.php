<?php

namespace App\Http\Controllers\Doc;

use App\Appointment;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $services = collect();
            $customers = $request->get('customers');

            foreach ($customers as $key => $customer) {
                $service = ["title" =>  Service::find(Appointment::find($customer["pivot"]['appointment_id'])['service_id'])->toArray()['title'],"price" =>Service::find(Appointment::find($customer["pivot"]['appointment_id'])['service_id'])->toArray()['price']];
                $customer['service'] =  $service['title'];
                $services->push($service);
                $customers[$key] = $customer;
            }
            $services = $services->unique()->all();
            $pdf = PDF::loadView('pdf.invoice', compact('services', 'customers'));
            return response($pdf->download('pdf.invoice'));
        }
        return redirect()->back();
    }
}