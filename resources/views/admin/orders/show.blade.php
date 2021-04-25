@extends('admin.layout')

@section('content')
<div class="content">
    <div class="invoice-wrapper rounded border bg-white py-5 px-3 px-md-4 px-lg-5">
        <div class="d-flex justify-content-between">
            <h2 class="text-dark font-weight-medium">Order ID #{{ $order->kode }}</h2>
            <div class="btn-group">
                <button class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-content-save"></i> Save</button>
                <button class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-printer"></i> Print</button>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-xl-4 col-lg-4">
                <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Billing Address</p>
                <address>
                    {{ $order->nama_depan_konsumen }} {{ $order->nama_belakang_konsumen }}
                    <br> Alamat: {{ $order->alamat_konsumen }}
                    <br> Email: {{ $order->email_konsumen }}
                    <br> No Hp: {{ $order->no_hp_konsumen }}
                    <br> Kode pos: {{ $order->kode_pos_konsumen }}
                </address>
            </div>
            <div class="col-xl-4 col-lg-4">
                <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Shipment Address</p>
                <address>
                    {{ $order->pengiriman->nama_depan }} {{ $order->pengiriman->nama_belakang}}
                    <br> {{ $order->pengiriman->alamat }}
                    <br> Email: {{ $order->pengiriman->email }}
                    <br> Phone: {{ $order->pengiriman->no_hp }}
                    <br> Postcode: {{ $order->pengiriman->kodepos }}
                </address>
            </div>
            <div class="col-xl-4 col-lg-4">
                <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Details</p>
                <address>
                    ID: <span class="text-dark">#{{ $order->kode }}</span>
                    <br> {{ \General::datetimeFormat($order->tanggal_pemesanan) }}
                    <br> Status: {{ $order->status }} {{ $order->isCancelled() ? '('. \General::datetimeFormat($order->cancelled_at) .')' : null}}
                    @if ($order->isCancelled())
                    <br> Cancellation Note : {{ $order->catatan_pembatalan}}
                    @endif
                    <br> Payment Status: {{ $order->status_pembayaran }}
                    <br> Shipped by: {{ $order->layanan_kurir }}
                </address>
            </div>
        </div>
        <table class="table mt-3 table-striped table-responsive table-responsive-large" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->ItemPemesanan as $item)
                <tr>
                    <td>{{ $item->sku }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{!! \General::showAttributes($item->atribut) !!}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ \General::priceFormat($item->harga) }}</td>
                    <td>{{ \General::priceFormat($item->sub_total) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">pesanan kososng!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-lg-5 col-xl-4 col-xl-3 ml-sm-auto">
                <ul class="list-unstyled mt-4">
                    <li class="mid pb-3 text-dark">Subtotal
                        <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->total_awal) }}</span>
                    </li>
                    <li class="mid pb-3 text-dark">Tax(0%)
                        <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->jumlah_pajak) }}</span>
                    </li>
                    <li class="mid pb-3 text-dark">Shipping Cost
                        <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->biaya_pengiriman) }}</span>
                    </li>
                    <li class="pb-3 text-dark">Total
                        <span class="d-inline-block float-right">{{ \General::priceFormat($order->total_akhir) }}</span>
                    </li>
                </ul>
                @if (!$order->trashed())
                @if ($order->isPaid() && $order->isConfirmed())
                <a href="{{ url('admin/shipments/'. $order->pengiriman->id .'/edit')}}" class="btn btn-block mt-2 btn-lg btn-primary btn-pill"> Procced to Shipment</a>
                @endif

                @if (in_array($order->status, [\App\Models\Pemesanan::CREATED, \App\Models\Pemesanan::CONFIRMED]))
                <a href="{{ url('admin/orders/'. $order->id .'/cancel')}}" class="btn btn-block mt-2 btn-lg btn-warning btn-pill"> Cancel</a>
                @endif

                @if ($order->isDelivered())
                <a href="#" class="btn btn-block mt-2 btn-lg btn-success btn-pill" onclick="event.preventDefault();
						document.getElementById('complete-form-{{ $order->id }}').submit();"> Mark as Completed</a>

                {!! Form::open(['url' => 'admin/orders/complete/'. $order->id, 'id' => 'complete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::close() !!}
                @endif

                @if (!in_array($order->status, [\App\Models\Pemesanan::DELIVERED, \App\Models\Pemesanan::COMPLETED]))
                <a href="#" class="btn btn-block mt-2 btn-lg btn-secondary btn-pill delete" order-id="{{ $order->id }}"> Remove</a>

                {!! Form::open(['url' => 'admin/orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
                @endif
                @else
                <a href="{{ url('admin/orders/restore/'. $order->id)}}" class="btn btn-block mt-2 btn-lg btn-outline-secondary btn-pill restore"> Restore</a>
                <a href="#" class="btn btn-block mt-2 btn-lg btn-danger btn-pill delete" order-id="{{ $order->id }}"> Remove Permanently</a>

                {!! Form::open(['url' => 'admin/orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection