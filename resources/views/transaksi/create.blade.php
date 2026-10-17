@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Transaksi') }}</h1>

    <form action="{{ route('transaksi.store') }}" method="post" id="transaksi-form">
        @csrf

        <div class="mb-3">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary step-btn" data-step-target="0">Detail Transaksi</button>
                <button type="button" class="btn btn-outline-primary step-btn" data-step-target="1">Ringkasan</button>
                <button type="button" class="btn btn-outline-primary step-btn" data-step-target="2">Konfirmasi</button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4" data-step="0">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Transaksi</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}">
                            @error('tanggal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="metode_bayar">Metode Pembayaran</label>
                            <select class="form-control @error('metode_bayar') is-invalid @enderror" name="metode_bayar" id="metode_bayar">
                                <option value="cash" {{ old('metode_bayar') === 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="transfer" {{ old('metode_bayar') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                                <option value="lainnya" {{ old('metode_bayar') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('metode_bayar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tipe">Tipe Transaksi</label>
                            <select class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="tipe">
                                <option value="pemasukan" {{ old('tipe') === 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ old('tipe') === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('tipe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan" rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Item Produk</h6>
                            <button type="button" class="btn btn-sm btn-primary" id="add-item">+ Tambah Item</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody id="items-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 d-none" data-step="1">
                    <div class="card-body">
                        <h6 class="mb-3">Ringkasan Pesanan</h6>
                        <ul class="list-group" id="summary-list"></ul>
                        <div class="mt-3 text-right">
                            <strong>Total Bayar: </strong><span id="summary-total">Rp 0</span>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 d-none" data-step="2">
                    <div class="card-body">
                        <p>Pastikan data transaksi sudah benar sebelum menyimpan.</p>
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        <a href="{{ route('transaksi.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" id="prev-step">Sebelumnya</button>
                    <button type="button" class="btn btn-outline-primary" id="next-step">Berikutnya</button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">Ringkasan</h6>
                        <div id="side-summary"></div>
                        <div class="mt-3 text-right">
                            <strong>Total: </strong><span id="side-total">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
@php
    $productsForJs = $produk
        ->map(fn ($item) => [
            'id' => $item->id,
            'name' => $item->nama_produk,
            'price' => $item->harga_satuan,
        ])
        ->values()
        ->all();
@endphp

<script type="application/json" id="products-data">@json($productsForJs)</script>
<script>
    const products = JSON.parse(document.getElementById('products-data').textContent || '[]');

    const itemsBody = document.getElementById('items-body');
    const addItemBtn = document.getElementById('add-item');
    const summaryList = document.getElementById('summary-list');
    const summaryTotal = document.getElementById('summary-total');
    const sideSummary = document.getElementById('side-summary');
    const sideTotal = document.getElementById('side-total');

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID').format(value || 0);
    }

    function buildOptions(selectedId) {
        let options = '<option value="">Pilih Produk</option>';
        products.forEach(product => {
            const selected = selectedId == product.id ? 'selected' : '';
            options += `<option value="${product.id}" data-price="${product.price}" ${selected}>${product.name}</option>`;
        });
        return options;
    }

    function addRow(data = {}) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select class="form-control produk-select" name="items[][produk_id]" required>
                    ${buildOptions(data.produk_id || '')}
                </select>
            </td>
            <td>
                <input type="number" min="1" class="form-control qty-input" name="items[][qty]" value="${data.qty || 1}" required>
            </td>
            <td>
                <input type="number" step="0.01" class="form-control harga-input" name="items[][harga_saat_jual]" value="${data.harga_saat_jual || 0}" readonly>
            </td>
            <td class="subtotal-cell">Rp 0</td>
            <td>
                <button type="button" class="btn btn-sm btn-danger remove-item">Hapus</button>
            </td>
        `;
        itemsBody.appendChild(row);
        reindexRows();
        recalc();
    }

    function reindexRows() {
        itemsBody.querySelectorAll('tr').forEach((row, index) => {
            row.querySelectorAll('select, input').forEach((input) => {
                const name = input.getAttribute('name');
                if (!name) return;
                input.setAttribute('name', name.replace('items[]', `items[${index}]`));
            });
        });
    }

    function recalc() {
        let total = 0;
        summaryList.innerHTML = '';
        sideSummary.innerHTML = '';

        itemsBody.querySelectorAll('tr').forEach(row => {
            const productSelect = row.querySelector('.produk-select');
            const qtyInput = row.querySelector('.qty-input');
            const priceInput = row.querySelector('.harga-input');
            const subtotalCell = row.querySelector('.subtotal-cell');

            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedOption?.dataset?.price || 0);
            const qty = parseFloat(qtyInput.value || 0);

            if (priceInput.value !== String(price)) {
                priceInput.value = price;
            }

            const subtotal = price * qty;
            subtotalCell.textContent = `Rp ${formatRupiah(subtotal)}`;
            total += subtotal;

            if (selectedOption && selectedOption.value) {
                const text = `${selectedOption.text} × ${qty}`;
                const listItem = `<li class="list-group-item d-flex justify-content-between"><span>${text}</span><span>Rp ${formatRupiah(subtotal)}</span></li>`;
                summaryList.insertAdjacentHTML('beforeend', listItem);
                sideSummary.insertAdjacentHTML('beforeend', `<div class="d-flex justify-content-between"><span>${text}</span><span>Rp ${formatRupiah(subtotal)}</span></div>`);
            }
        });

        summaryTotal.textContent = `Rp ${formatRupiah(total)}`;
        sideTotal.textContent = `Rp ${formatRupiah(total)}`;
    }

    itemsBody.addEventListener('input', function (event) {
        if (event.target.classList.contains('qty-input') || event.target.classList.contains('produk-select')) {
            recalc();
        }
    });

    itemsBody.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            event.target.closest('tr').remove();
            reindexRows();
            recalc();
        }
    });

    addItemBtn.addEventListener('click', function () {
        addRow();
    });

    const steps = document.querySelectorAll('[data-step]');
    let currentStep = 0;

    function showStep(index) {
        steps.forEach(step => step.classList.add('d-none'));
        steps[index].classList.remove('d-none');
        recalc();
    }

    document.getElementById('next-step').addEventListener('click', function () {
        if (currentStep < steps.length - 1) {
            currentStep += 1;
            showStep(currentStep);
        }
    });

    document.getElementById('prev-step').addEventListener('click', function () {
        if (currentStep > 0) {
            currentStep -= 1;
            showStep(currentStep);
        }
    });

    document.querySelectorAll('.step-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            currentStep = parseInt(this.dataset.stepTarget, 10);
            showStep(currentStep);
        });
    });

    addRow();
    showStep(0);
</script>
@endpush
