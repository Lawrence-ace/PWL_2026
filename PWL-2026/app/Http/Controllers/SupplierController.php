<?php
 
namespace App\Http\Controllers;
 
use App\Models\Supplier;
use Illuminate\Http\Request;
 
class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('supplier.index', compact('suppliers'));
    }
 
    public function create()
    {
        return view('supplier.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
        ]);
 
        $supplier = Supplier::create($request->only(['supplier_name', 'phone', 'email']));
 
        // Dipanggil lewat popup (AJAX) dari halaman Tambah Produk
        if ($request->expectsJson()) {
            return response()->json([
                'id' => $supplier->id,
                'supplier_name' => $supplier->supplier_name,
                'phone' => $supplier->phone,
                'email' => $supplier->email,
            ], 201);
        }
 
        // Kalau datang dari form tambah produk, kembali ke sana
        // dan langsung pilih supplier yang baru dibuat.
        if ($request->input('from') === 'product') {
            return redirect()->route('product.create')
                ->withInput(['supplier_id' => $supplier->id])
                ->with('success', 'Supplier berhasil ditambahkan! Silakan lanjutkan mengisi produk.');
        }
 
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }
 
    public function show(Supplier $supplier)
    {
        //
    }
 
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }
 
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
        ]);
 
        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui!');
    }
 
    public function destroy(Supplier $supplier)
    {
        if ($supplier->products()->count() > 0) {
            return redirect()->route('supplier.index')->with('error', 'Supplier "' . $supplier->supplier_name . '" tidak dapat dihapus karena masih terkait dengan ' . $supplier->products()->count() . ' produk.');
        }
 
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}