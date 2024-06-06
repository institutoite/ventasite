<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Marca;
use App\Models\Almacen;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sucursal;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductoSucursal;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use ZipArchive;

use GuzzleHttp\Client;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all();
        return view("products.listar",["productos"=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'categories' => Category::all(),
            'almacens' => Almacen::all(),
            'marcas' => Marca::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->fotos[0]);
        $product_code = IdGenerator::generate([
            'table' => 'products',
            'field' => 'product_code',
            'length' => 4,
            'prefix' => 'PC'
        ]);

        $rules = [
            'product_image' => 'image|file|max:1024',
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'almacen_id' => 'required|integer',
            'product_garage' => 'string|nullable',
            'descripcion' => 'string|required',
            'product_store' => 'string|nullable',
            'buying_date' => 'date_format:Y-m-d|max:10|nullable',
            'expire_date' => 'date_format:Y-m-d|max:10|nullable',
        ];

        $validatedData = $request->validate($rules);

        // save product code value
        $validatedData['product_code'] = $product_code;

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('product_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/products/';

            $file->storeAs($path, $fileName);
            $validatedData['product_image'] = $fileName;
        }
        $producto= new Product();
        $producto->product_name=$request->product_name;
        $producto->category_id=$request->category_id;
        $producto->marca_id=$request->marca_id;
        $producto->supplier_id=$request->supplier_id;
        $producto->almacen_id=$request->almacen_id;
        $producto->product_code=$validatedData['product_code'];
        
        //$producto->product_image=$request->product_image;
        
        $producto->imagen2=$request->imagen2;
        $producto->imagen3=$request->imagen3;
        $producto->buying_price=$request->buying_price;
        $producto->selling_price=$request->selling_price;
        $producto->precio1=$request->precio1;
        $producto->precio2=$request->precio2;
        $producto->precio3=$request->precio3;
        $producto->precio4=$request->precio4;
        $producto->descripcion=$request->descripcion;
        $producto->product_garage=$request->product_garage;
        $producto->product_store=$request->product_store;
        $producto->buying_date=$request->buying_date;
        $producto->expire_date=$request->expire_date;
    
        $foto = $request->file('fotos')[0];
        $nombre=$this->GuardarImagenFisico($foto);
        $producto->product_image=$nombre;
        $foto2 = $request->file('fotos')[1];
        $nombre=$this->GuardarImagenFisico($foto2);
        $producto->imagen2=$nombre;
        $foto3 = $request->file('fotos')[2];
        $nombre=$this->GuardarImagenFisico($foto3);
        $producto->imagen3=$nombre;
        $producto->save();
        return Redirect::route('products.index')->with('success', 'Product has been created!');
    }
    

    public function GuardarImagenFisico($imagen){
        $nombreArchivo=Str::random(5)."products".'.'.$imagen->getClientOriginalExtension();
        $imagen->storeAs('products',$nombreArchivo,'public');
        return $nombreArchivo;
    }

    public function showProduct(Product $product){
        $categoriaProductoActual = $product->category_id;
        $productosimilar = Product::where('category_id', $categoriaProductoActual)
            ->where('id', '!=', $product->id)
            ->first();
        return view("products.showproduct",compact("product","productosimilar"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Barcode Generator
        $generator = new BarcodeGeneratorHTML();

        $barcode = $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128);

        return view('products.show', [
            'product' => $product,
            'barcode' => $barcode,
        ]);
    }
    public function productosDeUnaQuery(Request $request){
        if($request->query!=""){
            
            return response()->json($products);
        }else{
            $products=Product::all();
            return response()->json($products);
        }
    }
    // public function productosDeUnaCategoria(Request $request){
    //     if($request->categoria!=""){
    //         $category= Category::find($request->categoria);
    //         $products = $category->productos;
    //         return response()->json($products);
    //     }else{
    //         $products=Product::all();
    //         return response()->json($products);
    //     }
    // }
    // public function productosDeUnaCategoria(Request $request){
    //     $perPage = 5; // Número de productos por página
    //     if($request->categoria != ""){
    //         $category = Category::find($request->categoria);
    //         $products = $category->productos()
    //                              ->skip(($request->page - 1) * $perPage) // Saltar productos según el número de página
    //                              ->take($perPage) // Tomar una cantidad específica de productos
    //                             ->get();
    //         return response()->json($products);
    //     } else {
    //         $products = Product::skip(($request->page - 1) * $perPage)
    //                         ->take($perPage)
    //                         ->get();
    //         return response()->json($products);
    //     }
    // }

    public function productosFiltrados(Request $request ){
        // $request = new Request();
        // $request->query="eléctrica";
        // $request->categoria="";
        // $request->marca="";
        // $request->page=1;
       
        $perPage = 5;
        $query = Product::query();
        
        // $variable="ESPERO";
        if($request->categoria != ""){
            // $variable.="entre al if de categoria";
            $query->whereHas('category', function($q) use ($request) {
                $q->where('id', $request->categoria);
            });
        }
        
        if($request->marca != ""){
            // $variable.="entre al if de marca";
            //$query->where('marca', $request->marca);
            $query->whereHas('marca', function($qq) use ($request) {
                $qq->where('id', $request->marca);
            });
        }
        
        if($request->que!=""){
            $query->where('product_name', 'like', '%'.$request->que.'%')
            ->orWhere('descripcion', 'like', '%'.$request->que.'%');
            
        }
        
        $products = $query->skip(($request->page - 1) * $perPage)
        // $products = $query->skip((1-1) * $perPage)
        ->take($perPage)
        ->get();
        
       // dd($products);
        return response()->json($products);
    }

    public function productosDeUnaMarca(Request $request){
        if($request->marca!=""){
            $marca= Marca::find($request->marca);
            $products = $marca->productos;
            return response()->json($products);
        }else{
            $products=Product::all();
            return response()->json($products);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'categories' => Category::all(),
            'almacens' => Almacen::all(),
            'marcas' => Marca::all(),
            'producto' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $rules = [
            'product_name' => 'required|string',
            'product_image' => 'image|file|max:1024',
            'category_id' => 'required|integer',
            'buying_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'almacen_id' => 'required|integer',
        ];

        //dd($product);
        $validatedData = $request->validate($rules);
        $product->product_name=$request->product_name;
        $product->category_id=$request->category_id;
        $product->marca_id=$request->marca_id;
        $product->supplier_id=1;
        $product->almacen_id=$request->almacen_id;
        $product->buying_price=$request->buying_price;
        $product->selling_price=$request->selling_price;
        $product->precio2=$request->precio2;
        $product->precio3=$request->precio3;
        $product->precio4=$request->precio4;
        $product->descripcion=$request->descripcion;
        $product->product_garage=$request->product_garage;
        $product->product_store=$request->product_store;
        $product->buying_date=$request->buying_date;
        $product->expire_date=$request->expire_date;
    
        
        if($request->hasFile('product_image')){
            if (Storage::disk("public")->exists("products/".$product->product_image)) {
                Storage::disk('public')->delete('products/'.$product->product_image);
                $imagen=$request->file('product_image');
                $nombreArchivo=Str::random(5)."products".'.'.$imagen->getClientOriginalExtension();
                $product->product_image=$nombreArchivo;
                $imagen->storeAs('products',$nombreArchivo,'public');
            }
        }
        
        if($request->hasFile('imagen2')){
            if (Storage::disk("public")->exists("products/".$product->imagen2)) {
                Storage::disk('public')->delete('products/'.$product->imagen2);
                $imagen=$request->file('imagen2');
                $nombreArchivo=Str::random(5)."products".'.'.$imagen->getClientOriginalExtension();
                $product->imagen2=$nombreArchivo;
                $imagen->storeAs('products',$nombreArchivo,'public');
            }
        }
        if($request->hasFile('imagen3')){
            if (Storage::disk("public")->exists("products/".$product->imagen3)) {
                Storage::disk('public')->delete('products/'.$product->imagen3);
                $imagen=$request->file('imagen3');
                $nombreArchivo=Str::random(5)."products".'.'.$imagen->getClientOriginalExtension();
                $product->imagen3=$nombreArchivo;
                $imagen->storeAs('products',$nombreArchivo,'public');
            }
        }
        $product->save();
        return Redirect::route('products.index')->with('success', '¡El producto ha sido actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->estado = 0;
        $product->save();
        return Redirect::route('products.index')->with('success', '¡El producto ha sido eliminado!');
    }
    public function darAlta(Request $request)
    {
        $product = Product::find($request->id);
        $product->estado = 1;
        $product->save();
        return response()->json(["ok"=>"todo salio bien "]);
    }

    /**
     * Show the form for importing a new resource.
     */
    public function importView()
    {
        return view('products.import');
    }

    /*public function importStore(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|file|mimes:xls,xlsx',
        ]);
        
        $the_file = $request->file('upload_file');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            
            // $row_limit    = $sheet->getHighestDataRow();
            $row_limit    =    $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'A', $column_limit );
            $startcount = 2;
            $data = array();
            
            foreach ( $row_range as $row ) {
                if($sheet->getCell( 'H' . $row )->getValue()!=""){
                    $vectorImages=explode(",",$sheet->getCell( 'H' . $row )->getValue());
                    for ($k=0; $k < count($vectorImages) ; $k++) { 
                            $product_image = $vectorImages[$k];
                            $image_content = file_get_contents($product_image);
                            $image_name = basename($product_image);
                            $image_path = storage_path('app/public/products/' . $image_name);
                            file_put_contents($image_path, $image_content);
                        
                    }                
                    switch (count($vectorImages)) {
                        case 1:
                            $imagen1=basename(str_replace("\\","\\\\",$vectorImages[0]));
                            $imagen2=NULL;
                            $imagen3=NULL;
                            break;
                        case 2:
                            $imagen1=basename(str_replace("\\","\\\\",$vectorImages[0]));
                            $imagen2=basename(str_replace("\\","\\\\",$vectorImages[1]));
                            $imagen3=NULL;
                            break;
                        case 3:
                            $imagen1=basename(str_replace("\\","\\\\",$vectorImages[0]));
                            $imagen2=basename(str_replace("\\","\\\\",$vectorImages[1]));
                            $imagen3=basename(str_replace("\\","\\\\",$vectorImages[2]));
                            break;
                        
                        default:
                            # code...
                            break;
                    }

                    $categoria= Category::where("name",$sheet->getCell( 'I' . $row )->getValue())->get()->first()->id;
                    $marca= Marca::where("marca",$sheet->getCell( 'J' . $row )->getValue())->get()->first()->id;
                    $almacen= Almacen::where("almacen",$sheet->getCell( 'k' . $row )->getValue())->get()->first()->id;


                    $data=[];
                    $data[] = [
                        'product_code' => $sheet->getCell( 'A' . $row )->getValue(),
                        'product_name' => $sheet->getCell( 'B' . $row )->getValue(),
                        
                        'buying_price' =>$sheet->getCell( 'C' . $row )->getValue(),
                        'precio1' =>$sheet->getCell( 'D' . $row )->getValue(),
                        'precio2' =>$sheet->getCell( 'E' . $row )->getValue(),
                        'precio3' =>$sheet->getCell( 'F' . $row )->getValue(),
                        'precio4' =>$sheet->getCell( 'G' . $row )->getValue(),

                        'product_image' =>$imagen1,
                        'imagen2' => $imagen2,
                        'imagen3' => $imagen3,

                        'category_id' => $categoria,
                        'marca_id' => $marca,
                        'almacen_id' => $almacen,
                        'product_store' =>$sheet->getCell( 'L' . $row )->getValue(),
                        
                        
                        
                        'supplier_id' => $almacen,
                        'product_garage' =>"",
                        'product_store' =>"",
                        'buying_date' =>null,
                        'expire_date' =>null,
            
                    ];
                    $startcount++;
                    Product::insert($data);
                }
            }

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('products.index')->with('error', '¡Hubo un problema al cargar los datos!');
        }
        return Redirect::route('products.index')->with('success', '¡Los datos se han importado correctamente!');
    }
*/
/*public function importStore(Request $request)
{
    $request->validate([
        'upload_file' => 'required|file|mimes:xls,xlsx',
    ]);

    $the_file = $request->file('upload_file');
    try {
        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);
        $column_range = range('A', $column_limit);
        $startcount = 2;
        //dd($row_range);
        foreach ($row_range as $row) {
            if ($sheet->getCell('H' . $row)->getValue() != "") {
                $vectorImages = explode(",", $sheet->getCell('H' . $row)->getValue());
                $images = [];
                
                for ($k = 0; $k < count($vectorImages); $k++) {
                    $product_image = trim($vectorImages[$k]);
                    try {
                        // Verifica si la URL es válida
                         	dd($product_image);	
                            //$image_content = file_get_contents($product_image);
                            if (is_readable($product_image)) {
				    $ch = curl_init();
				    curl_setopt($ch, CURLOPT_URL, 'file://' . $product_image);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				    $image_content = curl_exec($ch);
				    dd($image_content);
				    if ($image_content === false) {
				        echo "Error de CURL: " . curl_error($ch);
				    }
				    curl_close($ch);
				    // Ahora $image_content tiene el contenido del archivo
				} else {
				    echo "El archivo no existe o no es legible.";
				}
				                            
                            
                           
                            if ($image_content !== false) {
                                $image_name = basename($product_image);
                                $image_path = storage_path('app\\public\\products\\' . $image_name);
                                
                                file_put_contents($image_path, $image_content);
                                $images[] = $image_name;
                            } else {
                                throw new Exception("No se pudo obtener el contenido de la imagen: $product_image");
                            }
                        
                    } catch (Exception $e) {
                        // Maneja la excepción (puedes registrar el error en un log)
                        echo 'Error: ' . $e->getMessage() . "\n";
                    }
                }

                // Inicializa las variables de imágenes
                $imagen1 = $images[0] ?? null;
                $imagen2 = $images[1] ?? null;
                $imagen3 = $images[2] ?? null;

                // Obtén los IDs de las relaciones
                $categoria = Category::where("name", $sheet->getCell('I' . $row)->getValue())->first()->id ?? null;
                $marca = Marca::where("marca", $sheet->getCell('J' . $row)->getValue())->first()->id ?? null;
                $almacen = Almacen::where("almacen", $sheet->getCell('K' . $row)->getValue())->first()->id ?? null;

                // Crea el array de datos del producto
                $data = [
                    'product_code' => $sheet->getCell('A' . $row)->getValue(),
                    'product_name' => $sheet->getCell('B' . $row)->getValue(),
                    'buying_price' => $sheet->getCell('C' . $row)->getValue(),
                    'precio1' => $sheet->getCell('D' . $row)->getValue(),
                    'precio2' => $sheet->getCell('E' . $row)->getValue(),
                    'precio3' => $sheet->getCell('F' . $row)->getValue(),
                    'precio4' => $sheet->getCell('G' . $row)->getValue(),
                    'product_image' => $imagen1,
                    'imagen2' => $imagen2,
                    'imagen3' => $imagen3,
                    'category_id' => $categoria,
                    'marca_id' => $marca,
                    'almacen_id' => $almacen,
                    'product_store' => $sheet->getCell('L' . $row)->getValue(),
                    'supplier_id' => $almacen,
                    'product_garage' => "",
                    'product_store' => "",
                    'buying_date' => null,
                    'expire_date' => null,
                ];

                
                Product::insert($data);
                $startcount++;
            }
        }

    } catch (Exception $e) {
        return Redirect::route('products.index')->with('error', '¡Hubo un problema al cargar los datos!');
    }
    
    return Redirect::route('products.index')->with('success', '¡Los datos se han importado correctamente!');
}*/

/*public function importStore(Request $request)
{
    $request->validate([
        'upload_file' => 'required|file|mimes:xls,xlsx',
    ]);
    

    $the_file = $request->file('upload_file');
    try {
        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();

        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);
        $column_range = range('A', $column_limit);
        $startcount = 2;

        foreach ($row_range as $row) {
            if ($sheet->getCell('H' . $row)->getValue() != "") {
                $vectorImages = explode(",", $sheet->getCell('H' . $row)->getValue());
                $images = [];
                
                for ($k = 0; $k < count($vectorImages); $k++) {
                    $product_image = trim($vectorImages[$k]);
                    

                    // Ajusta la ruta del archivo en el servidor
                    
                    $direccion=str_replace("\\","\\\\",$product_image);
                    $image_name = basename($direccion);
                    $image_path = storage_path('app/public/products/MTAG900T.jpg');
                    $image_content =  urlencode(htmlspecialchars(file_get_contents("D:\IMAGENES\MASEROJO1\MTAG900T.jpg")));
                    dd($image_content);
                    Storage::put($image_path, $image_content);
                    file_put_contents($image_path, $image_content);
                            
                            
                    // Verifica y obtiene el contenido de la imagen en el servidor
                    if (is_readable($server_path)) {
                        $image_content = file_get_contents($server_path);
                        if ($image_content !== false) {
                            $image_name = basename($product_image);
                            $image_path = 'public/products/' . $image_name;

                            // Guarda el contenido de la imagen en el almacenamiento público
                            Storage::put($image_path, $image_content);
                            $images[] = $image_name;
                        } else {
                            throw new Exception("No se pudo obtener el contenido de la imagen: $server_path");
                        }
                    } else {
                        throw new Exception("El archivo no es legible: $server_path");
                    }
                }

                // Inicializa las variables de imágenes
                $imagen1 = $images[0] ?? null;
                $imagen2 = $images[1] ?? null;
                $imagen3 = $images[2] ?? null;

                // Obtén los IDs de las relaciones
                $categoria = Category::where("name", $sheet->getCell('I' . $row)->getValue())->first()->id ?? null;
                $marca = Marca::where("marca", $sheet->getCell('J' . $row)->getValue())->first()->id ?? null;
                $almacen = Almacen::where("almacen", $sheet->getCell('K' . $row)->getValue())->first()->id ?? null;

                // Crea el array de datos del producto
                $data = [
                    'product_code' => $sheet->getCell('A' . $row)->getValue(),
                    'product_name' => $sheet->getCell('B' . $row)->getValue(),
                    'buying_price' => $sheet->getCell('C' . $row)->getValue(),
                    'precio1' => $sheet->getCell('D' . $row)->getValue(),
                    'precio2' => $sheet->getCell('E' . $row)->getValue(),
                    'precio3' => $sheet->getCell('F' . $row)->getValue(),
                    'precio4' => $sheet->getCell('G' . $row)->getValue(),
                    'product_image' => $imagen1,
                    'imagen2' => $imagen2,
                    'imagen3' => $imagen3,
                    'category_id' => $categoria,
                    'marca_id' => $marca,
                    'almacen_id' => $almacen,
                    'product_store' => $sheet->getCell('L' . $row)->getValue(),
                    'supplier_id' => $almacen,
                    'product_garage' => "",
                    'product_store' => "",
                    'buying_date' => null,
                    'expire_date' => null,
                ];

                Product::insert($data);
                $startcount++;
            }
        }

    } catch (Exception $e) {
        return redirect()->route('products.index')->with('error', '¡Hubo un problema al cargar los datos!');
    }

    return redirect()->route('products.index')->with('success', '¡Los datos se han importado correctamente!');
}*/

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    function exportData(){
        $products = Product::all()->sortByDesc('product_id');

        $product_array [] = array(
            'Product Name',
            'Category Id',
            'Supplier Id',
            'Product Code',
            'Product Garage',
            'Product Image',
            'Product Store',
            'Buying Date',
            'Expire Date',
            'Buying Price',
            'Selling Price',
        );

        foreach($products as $product)
        {
            $product_array[] = array(
                'Product Name' => $product->product_name,
                'Category Id' => $product->category_id,
                'Supplier Id' => $product->supplier_id,
                'Product Code' => $product->product_code,
                'Product Garage' => $product->product_garage,
                'Product Image' => $product->product_image,
                'Product Store' =>$product->product_store,
                'Buying Date' =>$product->buying_date,
                'Expire Date' =>$product->expire_date,
                'Buying Price' =>$product->buying_price,
                'Selling Price' =>$product->selling_price,
            );
        }

        $this->ExportExcel($product_array);
    }

    public function agragarProductosAunaSucursal(Request $request){
        $product=Product::findOrFail($request->producto_id);
        return response()->json($product);
    }

    
    public function guardarProductosAunaSucursal(Request $request)
    {
        $producto_id=$request->product_id;
        $sucursal_id=$request->sucursal_id; 
        $cantidad=$request->stock;
        // Verificar si el registro existe en la tabla intermedia
        $stock_existente = ProductoSucursal::where('product_id', $producto_id)
            ->where('sucursal_id', $sucursal_id)
            ->first();

        if ($stock_existente) {
            // Si el registro existe, actualizar el stock
            $stock_existente->stock += $cantidad;
            $stock_existente->save();
        } else {
            // Si el registro no existe, insertar un nuevo registro
            $product_sucursal=new ProductoSucursal();
            $product_sucursal->product_id=$producto_id;
            $product_sucursal->sucursal_id=$sucursal_id;
            $product_sucursal->stock=$cantidad;
            $product_sucursal->save(); 

            // ProductoSucursal::create([
            //     'product_id' => $producto_id,
            //     'sucursal_id' => $sucursal_id,
            //     'stock' => $cantidad,
            // ]);
        }

        return response()->json(['message' => 'Stock actualizado correctamente']);
    }
    


    public function importStore(Request $request)
    {
        // Validar el archivo subido
        $request->validate([
            'upload_file' => 'required|file|mimes:xlsx,xls',
        ]);
        
        $zip = new ZipArchive();
        if($zip->open($request->upload_zip)===true){
            
            dd("IF DENTRO=>".$request->all());
            $extractPath="/home/tqatssbl/public_html";
        	$zip->extractTo($extractPath);
        	$zip->close();
        }
        dd("DESPUES DE IF => ".$request->all());
        
        $the_file = $request->file('upload_file');
        
        
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
          
            // $row_limit    = $sheet->getHighestDataRow();
            $row_limit    =    $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'A', $column_limit );
            $startcount = 2;
            $data = array();
            
            $contador=0;

           
            foreach ( $row_range as $row ) {
            	
                if($sheet->getCell( 'H' . $row )->getValue()!=""){
                    $vectorImages=explode(",",$sheet->getCell( 'H' . $row )->getValue());
                    // if($contador==1)
                    // dd($vectorImages);
                    $contador=$contador+1;
                    $variable="";
                    for ($k=0; $k < count($vectorImages) ; $k++) { 
                            $product_image = "/home/tqatssbl/public_html/storage/products/IMAGENES/".$vectorImages[$k];
                            $image_content = file_get_contents($product_image);
                            $image_name = basename($product_image);
                            $image_path = storage_path('app/public/products/' . $image_name);
                            file_put_contents($image_path, $image_content);
                        
                    } 
                    
                    
                                  
                    switch (count($vectorImages)) {
                        case 1:
                            $imagen1=basename(str_replace("\\","/",$vectorImages[0]));
                            $imagen2=NULL;
                            $imagen3=NULL;
                            break;
                        case 2:
                            $imagen1=basename(str_replace("\\","/",$vectorImages[0]));
                            $imagen2=basename(str_replace("\\","/",$vectorImages[1]));
                            $imagen3=NULL;
                            break;
                        case 3:
                            $imagen1=basename(str_replace("\\","/",$vectorImages[0]));
                            $imagen2=basename(str_replace("\\","/",$vectorImages[1]));
                            $imagen3=basename(str_replace("\\","/",$vectorImages[2]));
                            break;
                        
                        default:
                            # code...
                            break;
                    }

                    $categoria= Category::where("name",$sheet->getCell( 'I' . $row )->getValue())->get()->first()->id;
                    $marca= Marca::where("marca",$sheet->getCell( 'J' . $row )->getValue())->get()->first()->id;
                    $almacen= Almacen::where("almacen",$sheet->getCell( 'k' . $row )->getValue())->get()->first()->id;


                    $data=[];
                    $data[] = [
                        'product_code' => $sheet->getCell( 'A' . $row )->getValue(),
                        'product_name' => $sheet->getCell( 'B' . $row )->getValue(),
                        
                        'buying_price' =>$sheet->getCell( 'C' . $row )->getValue(),
                        'precio1' =>$sheet->getCell( 'D' . $row )->getValue(),
                        'precio2' =>$sheet->getCell( 'E' . $row )->getValue(),
                        'precio3' =>$sheet->getCell( 'F' . $row )->getValue(),
                        'precio4' =>$sheet->getCell( 'G' . $row )->getValue(),

                        'product_image' =>$imagen1,
                        'imagen2' => $imagen2,
                        'imagen3' => $imagen3,

                        'category_id' => $categoria,
                        'marca_id' => $marca,
                        'almacen_id' => $almacen,
                        'product_store' =>$sheet->getCell( 'L' . $row )->getValue(),
                        
                        
                        
                        'supplier_id' => $almacen,
                        'product_garage' =>"",
                        'product_store' =>"",
                        'buying_date' =>null,
                        'expire_date' =>null,
            
                    ];
                    //dd("boy por aca");
                    $startcount++;
                    Product::insert($data);
                }
            }

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('products.index')->with('error', '¡Hubo un problema al cargar los datos!');
        }
       

    }



}
