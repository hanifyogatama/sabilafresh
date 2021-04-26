<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemesanan;

use App\Exports\ReportProductExport;
use App\Exports\ReportInventoryExport;
use App\Exports\ReportPaymentExport;

use Maatwebsite\Excel\Facades\Excel;

use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->data['exports'] = [
            'xlsx' => 'Excel',
            'pdf' => 'PDF',
        ];
    }

    public function product(Request $request)
    {


        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if ($startDate && !$endDate) {
            \Session::flash('error', 'The end date is required if the start date is present');
            return redirect('admin/reports/product');
        }

        if (!$startDate && $endDate) {
            \Session::flash('error', 'The start date is required if the end date is present');
            return redirect('admin/reports/product');
        }

        if ($startDate && $endDate) {
            if (strtotime($endDate) < strtotime($startDate)) {
                \Session::flash('error', 'The end date should be greater or equal than start date');
                return redirect('admin/reports/product');
            }

            $earlier = new \DateTime($startDate);
            $later = new \DateTime($endDate);
            $diff = $later->diff($earlier)->format("%a");

            if ($diff >= 31) {
                \Session::flash('error', 'The number of days in the date ranges should be lower or equal to 31 days');
                return redirect('admin/reports/product');
            }
        } else {
            $currentDate = date('Y-m-d');
            $startDate = date('Y-m-01', strtotime($currentDate));
            $endDate = date('Y-m-t', strtotime($currentDate));
        }
        $this->data['startDate'] = $startDate;
        $this->data['endDate'] = $endDate;

        $sql = "
		SELECT
			OI.produk_id,
			OI.nama_produk,
			OI.sku,
			SUM(OI.qty) as items_sold,
			COALESCE(SUM(OI.sub_total - OI.jumlah_pajak),0) net_revenue,
			COUNT(OI.pemesanan_id) num_of_orders,
			PI.qty as stock
		FROM item_pemesanan OI
		LEFT JOIN pemesanan O ON O.id = OI.pemesanan_id
		LEFT JOIN inventori_produk PI ON PI.produk_id = OI.produk_id
		WHERE DATE(O.tanggal_pemesanan) >= :start_date
			AND DATE(O.tanggal_pemesanan) <= :end_date
			AND O.status = :status
			AND O.status_pembayaran = :status_pembayaran
		GROUP BY OI.produk_id, OI.nama_produk, OI.sku, PI.qty
		";

        $products = \DB::select(
            \DB::raw($sql),
            [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => Pemesanan::COMPLETED,
                'status_pembayaran' => Pemesanan::PAID,
            ]
        );

        $this->data['products'] = ($startDate && $endDate) ? $products : [];

        if ($exportAs = $request->input('export')) {
            if (!in_array($exportAs, ['xlsx', 'pdf'])) {
                \Session::flash('error', 'Invalid export request');
                return redirect('admin/reports/product');
            }

            if ($exportAs == 'xlsx') {
                $fileName = 'laporan-produk-' . $startDate . '-' . $endDate . '.xlsx';

                return Excel::download(new ReportProductExport($products), $fileName);
            }

            if ($exportAs == 'pdf') {
                $fileName = 'laporan-produk-' . $startDate . '-' . $endDate . '.pdf';
                $pdf = PDF::loadView('admin.reports.exports.product_pdf', $this->data);

                return $pdf->download($fileName);
            }
        }

        return view('admin.reports.product', $this->data);
    }
}
