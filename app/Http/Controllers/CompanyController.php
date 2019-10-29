<?php

namespace App\Http\Controllers;


use App\Company;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\NewNotification;

class CompanyController extends Controller
{

    private $table = 'companies';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cop = $this->getCompaniesPaginate();
        $comps =  json_encode($cop->items());
        //return response()->json($cop);

        return view('company.index', compact('cop', 'comps'));
    }

    public function getCompaniesPaginate(){
        return Company::paginate(10);
    }

    public function getCompanies(){
        return Company::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:30|min:4',
            'address' => 'required|max:30|min:6',
            'website' => 'required|max:30|min:6',
            'email' => 'required|max:100|min:6',
            'logo' => 'dimensions:min_width=100,min_height=100',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = time().$file->getClientOriginalName();
            $nameFile = $file->move(storage_path().'/app/public/logos',$name);
        }

        $newCompany = new Company();
        $newCompany->name = $request->name;
        $newCompany->address = $request->address;
        $newCompany->website = $request->website;
        $newCompany->logo = $nameFile;
        $newCompany->email = $request->email;
        $newCompany->save();


        $this->sendMail($newCompany);

        return $request->name;
    }

    public function sendMail($com){

        $employees = new EmployeeController();
        $receivers = $employees->getEmployees();
        $resp = Mail::to($receivers)->send(new NewNotification($com));
    }

    public function getCompany(Request $request){
        return Company::find($request->company);
    }

    public function editCompany($id){
        $company = Company::find($id);
        return view('company.edit', compact('company'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'name' => 'required|max:30|min:4',
            'address' => 'required|max:30|min:6',
            'website' => 'required|max:30|min:6',
            'email' => 'required|max:100|min:6',
        ]);

        $company = Company::find($id[1]);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->save();

        return $company->name;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id', '=', $id)->delete();
    }
}
