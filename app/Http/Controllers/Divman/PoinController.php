<?php

namespace App\Http\Controllers\Divman;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Resident;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PoinController extends Controller
{
    
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Helper;
        
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->isdivman)
                return redirect('/s');
                
            return $next($request);
        });
    }

    public function index()
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();

        $resident = Resident::where('resident.idtahun', $ta)->paginate(16);

        if($this->helper->isMobile())
            return view('m.divman.poin.index', [
                'tahun' => $tahun,
                'resident' => $resident
            ]);

        return view('divman.poin.index', [
            'tahun' => $tahun,
            'resident' => $resident
        ]);
    }

    
    public function download()
    {
        $resident = Resident::where('resident.idtahun', $this->helper->idTahunAktif())->get();

        $spreadsheet = new Spreadsheet();

        // Settingan awal fil excel
        $spreadsheet->getProperties()->setCreator('Unires UMY')
                               ->setLastModifiedBy('Unires UMY')
                               ->setTitle('Rekapan Poin '.$this->helper->tahunAktif())
                               ->setSubject('Rekapan Poin '.$this->helper->tahunAktif())
                               ->setDescription('Rekapan Poin '.$this->helper->tahunAktif())
                               ->setKeywords('Rekapan Poin '.$this->helper->tahunAktif());

        $sheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Set Header
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kamar');
        $sheet->setCellValue('D1', 'Poin');

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A1')->applyFromArray($style_col);
        $sheet->getStyle('B1')->applyFromArray($style_col);
        $sheet->getStyle('C1')->applyFromArray($style_col);
        $sheet->getStyle('D1')->applyFromArray($style_col);

        $pos = 2;
        foreach ($resident as $key => $r) {
            $sheet->setCellValue('A'.$pos, $key+1);
            $sheet->setCellValue('B'.$pos, $r->nama);
            $sheet->setCellValue('C'.$pos, $r->kamar->nomor);
            $sheet->setCellValue('D'.$pos, $r->getPoin());
            
            // Apply Style ke Row lainnya
            $sheet->getStyle('A'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('B'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('C'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('D'.$pos)->applyFromArray($style_row);

            // Set Height Row
            $sheet->getRowDimension($pos)->setRowHeight(20);

            $pos++;
        }
        // Set Width Column ke AutoSize, agar Column menyesuaikan lebar value Row
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        $sheet->setTitle('Data Poin');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Rekapan Poin '.$this->helper->tahunAktif().'.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}
