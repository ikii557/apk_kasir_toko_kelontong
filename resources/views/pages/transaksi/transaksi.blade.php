@extends('layouts.app')
@section('content')



                        <div class="row">
                            <div class="col-lg-6 mt-4">

                            <div class="card ">
                            <h4 class="p-4">Data Transaksi</h4>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah Barang</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">metode pembayaran</th>
                                                <th scope="col">opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksis as $no=> $transaksi )

                                            <tr>
                                                <td>{{$no +1}}</td>
                                                <td>{{$transaksi->barang->nama_barang}}</td>
                                                <td><span class="label gradient-1 btn-rounded">{{$transaksi->jumlah_barang}}</span></td>
                                                <td><span class="label gradient-3 btn-rounded">Rp.{{$transaksi->total_harga}}</span></td>
                                                <td>{{$transaksi->metode_pembayaran}}</td>

                                                <td><span><a href="/edittransaksi" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="/hapus" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>

                                        </tr>
                                        @endforeach
                                            <!-- <tr>
                                                <td>2</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Pisang</td>
                                                <td><span class="label gradient-2 btn-rounded">20</span>
                                                <td><span class="label gradient-2 btn-rounded">Rp 300.000</span>
                                                <td>Cash</td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-3" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Milk tester</td>
                                                <td><span class="label gradient-3 btn-rounded">50</span></td>
                                                <td><span class="label gradient-3 btn-rounded">Rp.30.000</span></td>
                                                <td><span >kredit</span></td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <div class="card">
                            <h4 class="p-4">Tambah Transaksi</h4>
                            <div class="p-3  me-4">
                            <form id="/store/transaksi" method="POST">
                                @csrf

                                <!-- Nama Barang -->
                                <div class="form-group">
                                    <label for="barang_id">Nama Barang:</label>
                                    <select name="barang_id" id="barang_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Barang</option>
                                        @foreach ($barangs as $produk)
                                            <option
                                                value="{{ $produk->id }}"
                                                data-harga="{{ $produk->harga_barang }}"
                                                {{ old('barang_id') == $produk->id ? 'selected' : '' }}
                                            >
                                                {{ $produk->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Jumlah Barang -->
                                <div class="form-group">
                                    <label for="jumlah_barang">Jumlah Barang:</label>
                                    <input type="number" value="{{ old('jumlah_barang') }}" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
                                </div>

                                <!-- Total Harga -->
                                    <div class="form-group">
                                        <label for="total_harga">Total Harga:</label>
                                        <input type="text"  value="{{ old('total_harga') }}" name="total_harga" id="total_harga" class="form-control" readonly required>
                                    </div>

                                <!-- Metode Pembayaran -->
                                <div class="form-group">
                                    <label for="metode_pembayaran">Metode Pembayaran:</label>
                                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                        <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                        <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                        <option value="debit" {{ old('metode_pembayaran') == 'debit' ? 'selected' : '' }}>Debit</option>
                                        <option value="kredit" {{ old('metode_pembayaran') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                                    </select>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                            </form>


                            <!-- Script for Auto Calculation of Total Price -->
                            <script>
                                document.getElementById('barang_id').addEventListener('change', function() {
                                    let selectedOption = this.options[this.selectedIndex];
                                    let hargaBarang = selectedOption.getAttribute('data-harga');
                                    let jumlahBarang = document.getElementById('jumlah_barang').value;
                                    let total = hargaBarang * jumlahBarang || 0;

                                    document.getElementById('total_harga').value = formatCurrency(total);
                                });

                                document.getElementById('jumlah_barang').addEventListener('input', function() {
                                    let hargaBarang = document.getElementById('barang_id').selectedOptions[0].getAttribute('data-harga');
                                    let jumlahBarang = this.value;
                                    let total = hargaBarang * jumlahBarang || 0;

                                    document.getElementById('total_harga').value = formatCurrency(total);
                                });

                                // Function to format number as currency "Rp." with thousands separator and two decimals
                                function formatCurrency(amount) {
                                    return 'Rp. ' + new Intl.NumberFormat('id-ID', {
                                        style: 'decimal',
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0
                                    }).format(amount);
                                }
                            </script>


                            </div>
                        </div>
                    </div>
                </div>



@endsection
