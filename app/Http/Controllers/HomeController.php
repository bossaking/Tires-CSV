<?php

namespace App\Http\Controllers;

use App\Models\Tire;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tires = Tire::all();
        return view('home')->with('tires', $tires);
    }

    public function createNew(){
        return view('new-tire');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function createNewTire(Request $request)
    {
        Tire::create([
            'name' => $request->input('name'),
            'model' => $request->input('model'),
            'price' => $request->input('price'),
            'date' => $request->input('date'),
        ]);
        Toastr::success('Poprawnie dodano rekord do bazy','Udało się!');
        return view('new-tire');
    }

    public function generateCSV(){
        $fileName = 'tires.csv';
        $tires = Tire::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Model', 'Price', 'Date');

        $callback = function() use($tires, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tires as $tire) {
                $row['Name']  = $tire->name;
                $row['Model']    = $tire->model;
                $row['Price']    = $tire->price;
                $row['Date']  = $tire->date;

                fputcsv($file, array($row['Name'], $row['Model'], $row['Price'], $row['Date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
