<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supplier::all();
        return view("master-data.product-master.supplier-index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data.supplier-master.create-supplier");
    }

    public function store(Request $request)
    {
        $validasi_data = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_address' => 'required|string|max:100',
            'phone' => 'required|string|max:15', // Perbaiki validasi
            'comment' => 'required|string',
        ]);

        Supplier::create($validasi_data);

        return redirect()->back()->with('success', 'Supplier created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('master-data.product-master.edit-supplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_address' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'comment' => 'required|string',
        ]);

        $product = Supplier::findOrFail($id);
        $product->update([
            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
            'phone' => $request->phone,
            'comment' => $request->comment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
