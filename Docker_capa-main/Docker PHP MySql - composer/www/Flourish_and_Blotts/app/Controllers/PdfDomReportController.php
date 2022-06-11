<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LibrosModel;

class PdfDomReportController extends BaseController
{
    public function index(){
        $datos = $this->request->getVar();
        $dompdf = new \Dompdf\Dompdf();

        $model = new LibrosModel();
        $libros = $model->pdf_libro($datos['isbn_13']);

        $html = '<div><div class="row"><h1 style="text-align: center;">Flourish & Blotts</h1></div>';
        $html .= '<h2>'.$libros->getResult()[0]->titulo.'</h2>';
        $html .= '<p><b>QR de los ejemplares</b></p>';

        foreach( $libros->getResult() as $libro ) {
            if ( $libro->id_ejemplar > 9 ){
                $html .= '<p style="margin-top: 35px;margin-left:10%">'.$libro->isbn_13.'-'.$libro->id_ejemplar.'</p>';
            }
            else {
                $html .= '<p style="margin-top: 35px;margin-left:10%">'.$libro->isbn_13.'-0'.$libro->id_ejemplar.'</p>';
            }
        }
        $html .= '</div>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        
        $dompdf->stream("ejemplares.pdf",['Attachment'=>1]); // Force download
        die; // Required. If no dies, PDF was corrupted to browser
    }
}
