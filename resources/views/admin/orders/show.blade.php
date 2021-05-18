@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>{{ $order->kode }}</h1>
    <div class="section-header-breadcrumb">
    </div>
</div>

<div class="content">
    <div class="invoice-wrapper shadow-sm rounded bg-white py-5 px-3 px-md-4 px-lg-5">
        <div class="row mb-1">
            <div class="col-md-12 d-flex flex-row-reverse ">

                @if($order->status == 'completed' )
                <span class=" border border-success rounded p-1 mb-3 font-weight-bold text-success">{{$order->status}} </span>
                @elseif($order->status == 'created' )
                <span class=" border border-info rounded p-1 mb-3 font-weight-bold text-info">{{$order->status}} </span>
                @elseif($order->status == 'confirmed' )
                <span class=" border border-warning rounded p-1 mb-3 font-weight-bold text-warning">{{$order->status}} </span>
                @elseif($order->status == 'cancelled' )
                <span class=" border border-danger rounded p-1 mb-3 font-weight-bold text-danger">{{$order->status}} : {{ $order->isCancelled() ? ''. \General::datetimeFormat($order->cancelled_at) .'' : null}} </span>
                @else
                <span class=" border border-dark rounded p-1 mb-3 font-weight-bold text-dark">{{$order->status}} </span>
                @endif


            </div>
        </div>


        <div class="row border rounded px-3 py-3 mx-0">
            <div class="col-md-12 p-0 ">
                <p class="text-dark mb-2" style="font-weight: bold; font-size:16px; text-transform: capitalize;">Detail Pemesan</p>
                <address>
                    <div class="row pt-2">
                        <div class="col-sm-5">Nama</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->nama_depan_konsumen }} {{ $order->nama_belakang_konsumen }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Email</div>
                        <div class="col-sm-7 text-left text-dark"> {{ $order->email_konsumen }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">No Hp</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->no_hp_konsumen }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Tanggal Pemesanan</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ \General::datetimeFormat($order->tanggal_pemesanan) }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Batas Pemesanan</div>
                        <div class="col-sm-7 text-left text-danger text-capitalize"> {{ \General::datetimeFormat($order->batas_pembayaran) }}</div>
                    </div>

                    @php
                    $orderDate = date_create($order->tanggal_pemesanan);
                    $dueDate = date_create();
                    $dateDiff = date_diff($orderDate,$dueDate);
                    $diff = $dateDiff->d;
                    @endphp

                    <div class="row pt-2">
                        <div class="col-sm-5">Status Pembayaran</div>
                        @if($order->status_pembayaran == 'paid')
                        <div class="col-sm-7 text-left text-success font-weight-bold text-capitalize"> {{ $order->status_pembayaran }}</div>
                        @elseif($diff < 1 && $order->status_pembayaran == 'unpaid')
                            <div class="col-sm-7 text-left text-danger font-weight-bold text-capitalize"> {{ $order->status_pembayaran }}</div>
                            @elseif($diff >= 1 && $order->status_pembayaran == 'unpaid')
                            <div class="col-sm-7 text-left"><span id="expired" class="font-weight-bold text-danger text-capitalize">Unpaid (Transaksi expired)</span></div>
                            @endif
                    </div>

                    @if ($order->isCancelled())
                    <div class="row pt-2">
                        <div class="col-sm-5">Catatan Pembatalan</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->catatan_pembatalan}}</div>
                    </div>
                    @endif
                </address>
            </div>
        </div>

        <!-- shipping order -->
        <div class="row border rounded px-3 py-3 mx-0 mt-3">
            <div class="col-md-12 p-0 ">
                <p class="text-dark mb-2" style="font-weight: bold; font-size:16px; text-transform: capitalize;">Detail Pengiriman</p>
                <address>
                    <div class="row pt-2">
                        <div class="col-sm-5">Nama</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->pengiriman->nama_depan }} {{ $order->pengiriman->nama_belakang}}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Email</div>
                        <div class="col-sm-7 text-left text-dark"> {{ $order->pengiriman->email }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">No Hp</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->pengiriman->no_hp }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Alamat</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->pengiriman->alamat}} , {{ $order->pengiriman->kodepos}}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Kurir</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize">{{$order->nama_kurir}} ({{$order->layanan_kurir}})</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Status Pengiriman</div>
                        @if($order->pengiriman->status == 'processed')
                        <div class="col-sm-7 text-left text-info font-weight-bold text-capitalize"> {{ $order->pengiriman->status}} </div>
                        @elseif($order->pengiriman->status == 'shipped')
                        <div class="col-sm-7 text-left text-success font-weight-bold text-capitalize"> {{ $order->pengiriman->status}} </div>
                        @else
                        <div class="col-sm-7 text-left text-danger font-weight-bold text-capitalize"> {{ $order->pengiriman->status}} </div>
                        @endif
                    </div>

                </address>
            </div>
        </div>

        <table class="table mt-3" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Banyak</th>
                    <th>Berat Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->ItemPemesanan as $item)
                <tr>
                    <td class="text-capitalize">{{ $item->nama_produk }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->berat+0 }} gr</td>
                    <td>Rp {{ \General::priceFormat($item->harga) }}</td>
                    <td>Rp {{ \General::priceFormat($item->sub_total) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">pesanan kososng!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-lg-5 col-xl-4 col-xl-5 ml-sm-auto">
                <ul class="list-unstyled mt-4">
                    <li class="mid text-dark">Subtotal
                        <span class="d-inline-block float-right text-default font-weight-bold">Rp {{ \General::priceFormat($order->total_awal) }}</span>
                    </li>
                    <hr class="my-3" />
                    <li class="mid text-dark">Pajak({{$order->persen_pajak+0}}%)
                        <span class="d-inline-block float-right text-default font-weight-bold">Rp {{ \General::priceFormat($order->jumlah_pajak) }}</span>
                    </li>
                    <hr class="my-3" />
                    <li class="mid text-dark">Biaya Pengiriman ({{$order->pengiriman->total_berat }} gr)
                        <span class="d-inline-block float-right text-default font-weight-bold">Rp {{ \General::priceFormat($order->biaya_pengiriman) }}</span>
                    </li>
                    <hr class="my-3" />
                    <li class="text-dark font-weight-bold">Total
                        <span class="d-inline-block font-weight-bold float-right">Rp {{ \General::priceFormat($order->total_akhir) }}</span>
                    </li>
                </ul>


                @if (!$order->trashed())
                @if ($order->isPaid() && $order->isConfirmed())
                <a href="{{ url('admin/shipments/'. $order->pengiriman->id .'/edit')}}" class="btn btn-block mt-2 btn-lg btn-primary btn-pill"> Proses Pengiriman</a>
                @endif

                @if (in_array($order->status, [\App\Models\Pemesanan::CREATED, \App\Models\Pemesanan::CONFIRMED]))
                <a href="{{ url('admin/orders/'. $order->id .'/cancel')}}" class="btn btn-block mt-2 btn-lg btn-warning btn-pill"> Batal Pemesanan</a>
                @endif

                @if ($order->isDelivered())
                <a href="#" class="btn btn-block mt-2 btn-lg btn-success btn-pill" onclick="event.preventDefault();
						document.getElementById('complete-form-{{ $order->id }}').submit();"> Complete</a>

                {!! Form::open(['url' => 'admin/orders/complete/'. $order->id, 'id' => 'complete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::close() !!}
                @endif

                @if (!in_array($order->status, [\App\Models\Pemesanan::DELIVERED, \App\Models\Pemesanan::COMPLETED]))
                <!-- <a href="#" class="btn btn-block mt-2 btn-lg btn-danger btn-pill delete" order-id="{{ $order->id }}"> Hapus Pesanan</a>

                {!! Form::open(['url' => 'admin/orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!} -->
                @endif
                @else

                <!-- <a href="#" class="btn btn-block mt-2 btn-lg btn-danger btn-pill delete" order-id="{{ $order->id }}"> Remove Permanently</a>

                {!! Form::open(['url' => 'admin/orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!} -->
                @endif
            </div>
        </div>
    </div>
</div>
@endsection