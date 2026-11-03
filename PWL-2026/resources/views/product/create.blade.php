@extends('layouts.app')
 
@section('title', 'Tambah Produk Baru')
 
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="mb-3">
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Produk
            </a>
        </div>
 
        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1 fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-box-seam text-maroon"></i>
                        Tambah Produk Baru
                    </h5>
                    <p class="text-muted small mb-0">Isi formulir berikut untuk mendaftarkan produk baru ke sistem.</p>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="barcode_number" class="form-label">Kode Barcode <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                            <input 
                                type="text" 
                                class="form-control @error('barcode_number') is-invalid @enderror" 
                                id="barcode_number" 
                                name="barcode_number" 
                                value="{{ old('barcode_number') }}" 
                                placeholder="Contoh: BRG-001 atau 899123456789"
                                required
                            >
                            @error('barcode_number')
                                <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-tag"></i></span>
                            <input 
                                type="text" 
                                class="form-control @error('product_name') is-invalid @enderror" 
                                id="product_name" 
                                name="product_name" 
                                value="{{ old('product_name') }}" 
                                placeholder="Contoh: Kopi Bubuk Robusta 250g"
                                required
                            >
                            @error('product_name')
                                <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="supplier_id" class="form-label mb-0">Supplier / Pemasok <span class="text-danger">*</span></label>
                            <a href="{{ route('supplier.create', ['from' => 'product']) }}" class="small text-maroon text-decoration-none fw-medium" data-bs-toggle="modal" data-bs-target="#supplierModal" role="button">
                                <i class="bi bi-plus"></i> Tambah Supplier Baru
                            </a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                            <select 
                                class="form-select @error('supplier_id') is-invalid @enderror" 
                                id="supplier_id" 
                                name="supplier_id" 
                                required
                            >
                                <option value="" disabled {{ old('supplier_id') ? '' : 'selected' }}>-- Pilih Supplier --</option>
                                @forelse ($supp as $s)
                                    <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->supplier_name }} ({{ $s->phone ?? $s->email }})
                                    </option>
                                @empty
                                    <option value="" disabled>Belum ada data supplier</option>
                                @endforelse
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($supp->isEmpty())
                            <div id="noSupplierAlert" class="alert alert-warning py-2 px-3 mt-2 small d-flex align-items-center gap-2">
                                <i class="bi bi-exclamation-triangle"></i>
                                <span>Belum ada supplier. Silakan <a href="{{ route('supplier.create', ['from' => 'product']) }}" class="alert-link" data-bs-toggle="modal" data-bs-target="#supplierModal" role="button">buat supplier</a> terlebih dahulu sebelum menambahkan produk.</span>
                            </div>
                        @endif
                    </div>
 
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="buy_price" class="form-label">Harga Beli (Modal) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-semibold text-muted">Rp</span>
                                <input 
                                    type="number" 
                                    class="form-control @error('buy_price') is-invalid @enderror" 
                                    id="buy_price" 
                                    name="buy_price" 
                                    value="{{ old('buy_price') }}" 
                                    placeholder="0"
                                    min="0"
                                    required
                                >
                                @error('buy_price')
                                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="sell_price" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-semibold text-muted">Rp</span>
                                <input 
                                    type="number" 
                                    class="form-control @error('sell_price') is-invalid @enderror" 
                                    id="sell_price" 
                                    name="sell_price" 
                                    value="{{ old('sell_price') }}" 
                                    placeholder="0"
                                    min="0"
                                    required
                                >
                                @error('sell_price')
                                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
 
                    <!-- Footer Buttons: Split Layout (Left: Batal, Right: Simpan) -->
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-maroon px-4">
                            <i class="bi bi-check2-circle me-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
{{-- Modal tambah supplier (tanpa meninggalkan halaman produk) --}}
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="supplierForm" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="supplierModalLabel"><i class="bi bi-truck text-maroon me-2"></i>Tambah Supplier Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="supplierFormError" class="alert alert-danger py-2 small d-none"></div>
                    <div class="mb-3">
                        <label for="m_supplier_name" class="form-label">Nama Supplier / Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="m_supplier_name" name="supplier_name" placeholder="Contoh: PT. Sumber Makmur Abadi" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="m_phone" class="form-label">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="m_phone" name="phone" placeholder="Contoh: 081234567890" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-1">
                        <label for="m_email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="m_email" name="email" placeholder="Contoh: kontak@supplier.com" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-maroon" id="supplierSubmitBtn">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl   = document.getElementById('supplierModal');
    const form      = document.getElementById('supplierForm');
    const submitBtn = document.getElementById('supplierSubmitBtn');
    const errorBox  = document.getElementById('supplierFormError');
    const select    = document.getElementById('supplier_id');
    const noAlert   = document.getElementById('noSupplierAlert');
    const fields    = ['supplier_name', 'phone', 'email'];
 
    function resetErrors() {
        errorBox.classList.add('d-none');
        errorBox.textContent = '';
        fields.forEach(function (f) {
            const input = form.elements[f];
            input.classList.remove('is-invalid');
            input.nextElementSibling.textContent = '';
        });
    }
 
    modalEl.addEventListener('show.bs.modal', function () {
        form.reset();
        resetErrors();
    });
    modalEl.addEventListener('shown.bs.modal', function () {
        form.elements['supplier_name'].focus();
    });
 
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        resetErrors();
        submitBtn.disabled = true;
 
        try {
            const response = await fetch(@json(route('supplier.store')), {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    supplier_name: form.elements['supplier_name'].value,
                    phone: form.elements['phone'].value,
                    email: form.elements['email'].value
                })
            });
 
            if (response.status === 422) {
                const data = await response.json();
                Object.keys(data.errors || {}).forEach(function (f) {
                    const input = form.elements[f];
                    if (input) {
                        input.classList.add('is-invalid');
                        input.nextElementSibling.textContent = data.errors[f][0];
                    }
                });
                return;
            }
            if (!response.ok) {
                throw new Error('Gagal menyimpan supplier (kode ' + response.status + ').');
            }
 
            const supplier = await response.json();
 
            // Tambah ke dropdown & langsung pilih, data produk lain tidak tersentuh
            Array.from(select.options).forEach(function (o) {
                if (o.value === '' && o.textContent.indexOf('Belum ada data supplier') !== -1) o.remove();
            });
            const option = new Option(
                supplier.supplier_name + ' (' + (supplier.phone || supplier.email) + ')',
                supplier.id, true, true
            );
            select.add(option);
            select.value = String(supplier.id);
            select.classList.remove('is-invalid');
            if (noAlert) noAlert.remove();
 
            bootstrap.Modal.getInstance(modalEl).hide();
        } catch (err) {
            errorBox.textContent = err.message || 'Terjadi kesalahan, coba lagi.';
            errorBox.classList.remove('d-none');
        } finally {
            submitBtn.disabled = false;
        }
    });
});
</script>
@endpush