<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class excel_barang extends CI_Controller {

// Load model
public function __construct()
{
parent::__construct();
$this->load->model('exportbarang_model');
}

// Main page
public function index()
{
$export = $this->exportbarang_model->listing();
$data = array( 'title' => 'Laporan Peminjaman Barang',
'provinsi' => $export
);
// $this->load->view('laporan', $data, FALSE);
}

// Export ke excel
public function export()
{
$export= $this->exportbarang_model->listing();
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Robby Rohman')
->setLastModifiedBy('Robby Rohman')
->setTitle('Laporan Peminjaman Barang BI Jabar')
->setSubject('Office 2007 XLSX Test Document')
->setDescription('Dokumen Laporan Peminjaman .')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

// Add some data
$spreadsheet->getActiveSheet()->mergeCells('A1:I1');
$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(100);
$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setBold(16);
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical('center');
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
];
$spreadsheet->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);
$spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFill()->setFillType(Fill::FILL_SOLID);
$spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFill()->getStartColor()->setARGB('29bb04');

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A1', 'LAPORAN PEMINJAMAN BARANG BANK INDONESIA KANTOR PERWAKILAN JAWA BARAT')
->setCellValue('A2', 'No')
->setCellValue('B2', 'Id permohonan')
->setCellValue('C2', 'Nama Pemohon')
->setCellValue('D2', 'Nama Barang')
->setCellValue('E2', 'Kuantitas')
->setCellValue('F2', 'Tanggal Permohonan')
->setCellValue('G2', 'Tanggal Peminjaman')
->setCellValue('H2', 'Tanggal Pengembalian')
->setCellValue('I2', 'Keterangan')
;

// Miscellaneous glyphs, UTF-8
$i=3; 
$nomor=1;
foreach($export as $export) {
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];
    $spreadsheet->getActiveSheet()->getStyle('A3:I'.$i)->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);


$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $nomor)
->setCellValue('B'.$i, $export->id_request)
->setCellValue('C'.$i, $export->nama_lengkap)
->setCellValue('D'.$i, $export->nama_barang)
->setCellValue('E'.$i, $export->qty)
->setCellValue('F'.$i, $export->tanggal_request)
->setCellValue('G'.$i, $export->tanggal_peminjaman)
->setCellValue('H'.$i, $export->tanggal_pengembalian)
->setCellValue('I'.$i, $export->keterangan)
;

$i++;
$nomor++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan Peminjaman.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */