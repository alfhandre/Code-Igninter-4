<?php

namespace App\Controllers;
use App\Models\M_mahasiswa;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use TCPDF;
use App\Libraries\MY_TCPDF AS TCPDF;

class C_mahasiswa extends BaseController
{
    protected $M_mahasiswa;
    public function __construct()
    {
        $this->M_mahasiswa = new M_mahasiswa();
    }

    public function display()
    {
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $search = $this->request->getGet('cari');
        if($search){
            $mahasiswa = $this->M_mahasiswa->like('nama', $search)->paginate(3, 'mahasiswa');
        }else{
            $mahasiswa = $this->M_mahasiswa->paginate(3, 'mahasiswa');
        }
        $pager = $this->M_mahasiswa->pager;
        return view('v_display_mahasiswa', compact('mahasiswa', 'pager'));
    }

    public function create(){
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        return view('v_create_mahasiswa');
    }

    public function save(){
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $data['nim'] = $this->request->getPost('NIM');
        $data['nama'] = $this->request->getPost('nama');
        $data['umur'] = $this->request->getPost('umur');
        $this->M_mahasiswa->saveData($data);
        session()->setFlashdata('msg', 'Berhasil menambahkan data mahasiswa');
        return redirect()->to('/mahasiswa');
    }

    public function detail($NIM){
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $mahasiswa = $this->M_mahasiswa->getOne($NIM);
        return view('v_detail_mahasiswa', compact('mahasiswa'));
    }

    public function edit($NIM){
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $mahasiswa = $this->M_mahasiswa->getOne($NIM);
        return view('v_edit_mahasiswa', compact('mahasiswa'));
    }
    public function update($NIM){
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $data['nama'] = $this->request->getPost('nama');
        $data['umur'] = $this->request->getPost('umur');
        $this->M_mahasiswa->updateData($data, $NIM);
        session()->setFlashdata('msg', 'Data mahasiswa berhasil di update');
        return redirect()->to('/mahasiswa');
    }

    public function displayImport(){
        return view('v_import');
    }


    public function saveImport(){
        $file_excel = $this->request->getFile('fileexcel');
			$ext = $file_excel->getClientExtension();
			if($ext == 'xls') {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
        $spreadsheet = $render->load($file_excel);
	
		$data = $spreadsheet->getActiveSheet()->toArray();
        $this->export($data);
        // return redirect()->to('/mahasiswa/display/import');
    }

    private function export($data){
      $spreadsheet = new Spreadsheet();
 
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Nama');
      $sheet->setCellValue('B1', 'NIM');
      $sheet->setCellValue('C1', 'UTS');
      $sheet->setCellValue('D1', 'UAS');
      $sheet->setCellValue('E1', 'FINAL');
      $rows = 2;
 
      for($i = 1; $i < count($data); $i++){
        $sheet->setCellValue('A' . $rows, $data[$i][0]);
          $sheet->setCellValue('B' . $rows, $data[$i][1]);
          $sheet->setCellValue('C' . $rows, $data[$i][2]);
          $sheet->setCellValue('D' . $rows, $data[$i][3]);
          $sheet->setCellValue('E' . $rows, (0.40 * $data[$i][2]) + (0.60 * $data[$i][3]));
          $rows++; 
      }
        
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-Mahasiswa';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    public function convertPDF()
	{
        $mahasiswa = $this->M_mahasiswa->getAll();
		$html = view('pdf',[
			'mahasiswa'=> $mahasiswa,
		]);

		 // create new PDF document
         $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
         // set document information
         $pdf->SetCreator(PDF_CREATOR);
         $pdf->SetAuthor('MrHalo');
         $pdf->SetTitle('PDF Mahasiswa');
         $pdf->SetSubject('PDF Mahasiswa');
 
         // set default header data
         $pdf->SetHeaderData(PDF_HEADER_LOGO);
 
         // set margins
         $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
         $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
 
         // Set font
         // dejavusans is a UTF-8 Unicode font, if you only need to
         // print standard ASCII chars, you can use core fonts like
         // helvetica or times to reduce file size.
         $pdf->SetFont('dejavusans', '', 12, '', true);
 
         // Add a page
         // This method has several options, check the source code documentation for more information.
         $pdf->AddPage();
 
         // Print text using writeHTMLCell()
         $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
         // ---------------------------------------------------------
         $this->response->setContentType('application/pdf');
         // Close and output PDF document
         // This method has several options, check the source code documentation for more information.
         $pdf->Output('data-mahasiswa.pdf', 'I');
		
	}
}

