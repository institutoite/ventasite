<?php
namespace App\Http\Controllers\Dashboard;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\ProductoSucursal;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('customers.index', [
            'customers' => Customer::filter(request(['search']))->sortable()->paginate($row)->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'nullable|email|max:50|unique:customers,email',
            'phone' => 'required|string|max:15|unique:customers,phone',
            'shopname' => 'nullable|string|max:50',
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'bank_branch' => 'max:50',
            'city' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'fecha' => 'required',
            'empresa' => 'required',
        ];

        $validatedData = $request->validate($rules);
        // dd($validatedData);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/customers/';

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Customer::create($validatedData);

        return Redirect::route('customers.index')->with('success', '¡El cliente ha sido creado!');
    }

    public function importView()
    {
        return view('customers.import');
    }

    /*public function importStore(Request $request)
    {
        $request->validate(['upload_file' => 'required|file|mimes:xls,xlsx']);
        $the_file = $request->file('upload_file');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    =    $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'A', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                if($sheet->getCell( 'G' . $row )->getValue()!=""){
                        $imagen= $sheet->getCell( 'G' . $row )->getValue();
                        $product_image = $imagen;
                        $image_content = file_get_contents($product_image);
                        $image_name = basename($product_image);
                        $image_path = storage_path('app\\public\\customers\\' . $image_name);
                        file_put_contents($image_path, $image_content);
                    
                        $data=[];
                        $data[] = [
                            'photo' => basename(str_replace("\\","\\\\",$imagen)),
                            'name' => $sheet->getCell( 'B' . $row )->getValue(),
                            'phone' =>$sheet->getCell( 'C' . $row )->getValue(),
                            'empresa' =>$sheet->getCell( 'D' . $row )->getValue(),
                            'shopname' =>$sheet->getCell( 'E' . $row )->getValue(),
                            'address' =>$sheet->getCell( 'F' . $row )->getValue(),
                            'fecha' => $sheet->getCell( 'H' . $row )->getValue(),
                            'email' =>"",
                            'account_holder' =>"",
                            'account_number' =>"",
                            'bank_name' =>"",
                            'bank_branch' => "",
                            'city' => "",
                    ];
                    $startcount++;
                    Customer::insert($data);
                }
            }

        } catch (Exception $e) {
            return Redirect::route('customers.index')->with('error', '¡Hubo un problema al cargar los datos!');
        }
        return Redirect::route('customers.index')->with('success', '¡Los datos se han importado correctamente!');
    }*/
    public function importStore(Request $request)
    {
        $request->validate(['upload_file' => 'required|file|mimes:xls,xlsx']);
        $the_file = $request->file('upload_file');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $startcount = 2;
            foreach ($row_range as $row) {
                if ($sheet->getCell('G' . $row)->getValue() != "") {
                    $imagen = $sheet->getCell('G' . $row)->getValue();
                    $product_image = $imagen;
                    // dd($product_image);
                    $image_content = @file_get_contents($product_image);
                    $image_name = basename($product_image);
                    $image_path = storage_path('app\\public\\customers\\' . $image_name);
                    file_put_contents($image_path, $image_content);
                    
                    $data= [
                        'photo' => basename(str_replace("\\", "\\\\", $imagen)),
                        'name' => $sheet->getCell('B' . $row)->getValue(),
                        'phone' => $sheet->getCell('C' . $row)->getValue(),
                        'empresa' => $sheet->getCell('D' . $row)->getValue(),
                        'shopname' => $sheet->getCell('E' . $row)->getValue(),
                        'address' => $sheet->getCell('F' . $row)->getValue(),
                        'email' => null,
                        'account_holder' => null,
                        'account_number' => null,
                        'bank_name' => null,
                        'bank_branch' => null,
                        'city' => null,
                        'fecha' => Carbon::createFromTimestamp(($sheet->getCell('H' . $row)->getValue() - 25569) * 86400)->format('Y-m-d') ,
                    ];
                    // dd($data);
                    Customer::insert($data);
                    
                    $startcount++;
                }
            }
        } catch (Exception $e) {
            return Redirect::route('customers.index')->with('error', '¡Hubo un problema al cargar los datos!');
        }
        return Redirect::route('customers.index')->with('success', '¡Los datos se han importado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', [
            'customer' => $customer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email,'.$customer->id,
            'phone' => 'required|string|max:15|unique:customers,phone,'.$customer->id,
            'shopname' => 'required|string|max:50',
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'bank_branch' => 'max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/customers/';

            /**
             * Delete photo if exists.
             */
            if($customer->photo){
                Storage::delete($path . $customer->photo);
            }

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Customer::where('id', $customer->id)->update($validatedData);

        return Redirect::route('customers.index')->with('success', 'Customer has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        /**
         * Delete photo if exists.
         */
        if($customer->photo){
            Storage::delete('public/customers/' . $customer->photo);
        }

        Customer::destroy($customer->id);

        return Redirect::route('customers.index')->with('success', 'Customer has been deleted!');
    }
   
}
