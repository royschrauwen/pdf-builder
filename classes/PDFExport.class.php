<?php
/**
 * EQUANS PDF Exporter
 *
 * @param Report $report
 * 
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class PDFExport {

private $mpdf;
private $defaultDestination = "I";
private $vReportTitle = 'idReport';
private $vReportAuthor = 'vDepartment';
private $vReportCreator = 'EQUANS';
private $vReportSubject = 'vWorkingTitle';
private $vStylingFileLocation = 'style\report.css';

public function __construct(private Report $report) {
    // Create PDF
    $this->mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);

    // Set metadata
    $this->setPDFMetaData();

    // Import styling
    $stylesheet = file_get_contents($this->vStylingFileLocation);
    $this->mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    }


/** Sets the metadata for the PDF. */
protected function setPDFMetaData() : void {
    $this->mpdf->SetTitle($this->report->get($this->vReportTitle));
    $this->mpdf->SetAuthor($this->report->get($this->vReportAuthor));
    $this->mpdf->SetCreator($this->vReportCreator);
    $this->mpdf->SetSubject($this->report->get($this->vReportSubject));
}


public function create() : void {
    try {

        $this->mpdf->SetHTMLHeader($this->report->getHeaderHTML());
        $this->mpdf->SetHTMLFooter($this->report->getFooterHTML());
        $this->mpdf->WriteHTML($this->report->getContentHTML());

        $this->exportPDF();    

    } catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
        // Process the exception, log, print etc.
        echo $e->getMessage();
    }
}


/**
 * Generates the PDF file and exports it
 *
 * @param string|null $destination The destination of the PDF file.
 * I -send the file inline to the browser (Inline)
 * D -send to the browser and force a file download (Download)
 * F -save to a local file (File)
 * S -return the document as a string (String)
 * If the destination is not specified or incorrect, the PDF will be defaulted
 */
private function exportPDF(string $destination = null) : void {

    // Confirm the destination or set the default
    $allowedDestinations = ["I", "D", "F", "S"];
    if (!in_array($destination, $allowedDestinations) || empty($destination)) {
        $destination = $this->defaultDestination;
    }

    $this->mpdf->Output($this->report->get($this->vReportTitle).'.pdf', $destination);
}


/** Puts the images in the PDF, max 2 per row */
private function displayImages() : void {
    $this->mpdf->WriteHTML($this->report->getImageHTML());
}

/** Puts the Follow Up Actions in the PDF */
private function displayFollowUpActions() : void {
    $this->mpdf->WriteHTML($this->report->getFollowUpActionsHTML());
}

}