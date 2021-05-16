<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportCustomerExport;
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

	public function inventory(Request $request)
	{

		$sql = "
		SELECT
			P.*,
			PI.qty as stock
		FROM inventori_produk PI
		LEFT JOIN produk P ON P.id = PI.produk_id
		ORDER BY stock ASC
		";

		$products = \DB::select(\DB::raw($sql));

		$this->data['products'] = $products;

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				\Session::flash('error', 'Invalid export request');
				return redirect('admin/reports/inventory');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'Laporan-Produk-Inventori-' . date('d-F-Y') . '.xlsx';

				return Excel::download(new ReportInventoryExport($products), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'Laporan-Produk-Inventori-' . date('d-F-Y') . '.pdf';
				$pdf = PDF::loadView('admin.reports.exports.inventory_pdf', $this->data);

				return $pdf->download($fileName);
			}
		}

		return view('admin.reports.inventory', $this->data);
	}


	public function payment(Request $request)
	{


		$startDate = $request->input('start');
		$endDate = $request->input('end');

		if ($startDate && !$endDate) {
			\Session::flash('error', 'tanggal akhir belum dipilih');
			return redirect('admin/reports/payment');
		}

		if (!$startDate && $endDate) {
			\Session::flash('error', 'tanggal awal belum dipilih');
			return redirect('admin/reports/payment');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				\Session::flash('error', 'tanggal akhir harus lebih besar dari tanggal awal');
				return redirect('admin/reports/payment');
			}

			$earlier = new \DateTime($startDate);
			$later = new \DateTime($endDate);
			$diff = $later->diff($earlier)->format("%a");

			if ($diff >= 31) {
				\Session::flash('error', 'jumlah hari yang dipilih tidak lebih dari 31 hari');
				return redirect('admin/reports/payment');
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
			O.kode,
			P.*
		FROM pembayaran P
		LEFT JOIN pemesanan O ON O.id = P.pemesanan_id
		WHERE DATE(P.created_at) >= :start_date
			AND DATE(P.created_at) <= :end_date
		ORDER BY created_at DESC
		";

		$payments = \DB::select(
			\DB::raw($sql),
			[
				'start_date' => $startDate,
				'end_date' => $endDate
			]
		);

		$this->data['payments'] = ($startDate && $endDate) ? $payments : [];

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				\Session::flash('error', 'Invalid export request');
				return redirect('admin/reports/payment');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'Laporan-Pembayaran-' . $startDate . '-' . $endDate . '.xlsx';

				return Excel::download(new ReportPaymentExport($payments), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'Laporan-Pembayaran-' . $startDate . '-' . $endDate . '.pdf';
				$pdf = PDF::loadView('admin.reports.exports.payment_pdf', $this->data);

				return $pdf->download($fileName);
			}
		}

		return view('admin.reports.payment', $this->data);
	}


	public function customer(Request $request)
	{

		$sql = " 
		SELECT * FROM users
		WHERE is_admin = 0
		ORDER BY created_at desc
		";

		$customers = \DB::select(\DB::raw($sql));

		$this->data['customers'] = $customers;

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				\Session::flash('error', 'Gagal melakukan export');
				return redirect('admin/reports/customer');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'Laporan-Pelanggan-' . date('d-F-Y') . '.xlsx';

				return Excel::download(new ReportCustomerExport($customers), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'Laporan-Pelanggan-' . date('d-F-Y') . '.pdf';
				$pdf = PDF::loadView('admin.reports.exports.customer_pdf', $this->data);

				return $pdf->download($fileName);
			}
		}

		return view('admin.reports.customer', $this->data);
	}
}
