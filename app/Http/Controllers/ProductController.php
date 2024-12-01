<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\supplier;
use Maatwebsite\Excel\Facades\Excel;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportExcel(){
        return Excel::download(new ProductsExport, 'product.xlsx');
    }

    public function index(Request $request)
    {
        $query = Product::with('supplier');

        // Cek apakah ada parameter 'search' di request
        if ($request->has('search') && $request->search != '') {
            // Melakukan pencarian berdasarkan nama produk atau informasi
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%');
            });
        }

        // Paginate hasil query
        $products = $query->paginate(10);
        // return $products;

        return view("master-data.product-master.index-product", compact('products'));
    }



    /**
     * Show the form for creating a new resource.
     */
    // Menampilkan form creating-product
    public function addProduct()
    {
        $suppliers = Supplier::all();
        return view('master-data.product-master.create-product', compact('suppliers'));
    }


    // public function create()
    // {
    //     return view('master-data.product-master.detail-product');
    // }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string',
            'type' => 'required|string|max:255',
            'information' => 'nullable|string',
            'qty' => 'required|integer|min:0',
            'producer' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Simpan ke database
        Product::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.detail-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        return view('master-data.product-master.edit-product', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'information' => 'required|string',
            'qty' => 'required|integer',
            'producer' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'product_name' => $request->product_name,
            'unit' => $request->unit,
            'type' => $request->type,
            'information' => $request->information,
            'qty' => $request->qty,
            'producer' => $request->producer,
            'supplier_id' => $request->supplier_id,
        ]);
        return redirect()->route('product-index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product){
            $product->delete();
            return redirect()->route('product-index')->with('success', 'Produk berhasil dihapus.');
        }
        return redirect()->route('product-index')->with('error', 'Produk tidak ditemukan.');
    }

}
