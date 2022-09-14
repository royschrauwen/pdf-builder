<?php /** @noinspection PhpUnused */
/** @noinspection PhpUnused */

/** @noinspection PhpUnused */

use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

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

const OUTPUT_DOWNLOAD = "D";
const OUTPUT_INLINE = "I";
const OUTPUT_FILE= "F";
const OUTPUT_STRING = "S";

private Mpdf $mpdf;
private string $defaultDestination = "I";

private string $vReportCreator = 'EQUANS';

private string $vStylingFileLocation = 'style\report.css';

private Report $report;


public function __construct(
    Report $report
    ) {
        $this->report = $report;
    // Create PDF using the mPDF library
    try {
        $this->mpdf = new Mpdf([
            'setAutoTopMargin' => 'stretch',
            'setAutoBottomMargin' => 'stretch'
        ]);
    } catch (MpdfException $e) {
    }
}

/**
 * Creates the PDF file and exports it to the browser.
 *  
 * * @param string|null $destination The destination of the PDF file.
 * I -send the file inline to the browser (Inline)
 * D -send to the browser and force a file download (Download)
 * F -save to a local file (File)
 * S -return the document as a string (String)
 * If the destination is not specified or incorrect, the PDF will be defaulted
 */
public function create(string $destination = null) : void {
    try {

        // Set metadata
        $this->mpdf->SetTitle($this->report->getIdReport() . '.pdf');
        $this->mpdf->SetAuthor($this->report->getDepartment());
        $this->mpdf->SetCreator($this->vReportCreator);
        $this->mpdf->SetSubject($this->report->getWorkingTitle());

        // Import styling
        $stylesheet = file_get_contents($this->vStylingFileLocation);
        $this->mpdf->WriteHTML($stylesheet, HTMLParserMode::HEADER_CSS);

        // Add HTML content
        $this->mpdf->SetHTMLHeader($this->report->getHeaderHTML());
        $this->mpdf->SetHTMLFooter($this->report->getFooterHTML());
        $this->mpdf->WriteHTML($this->report->getContentHTML());

        // Confirm the destination or set the default
        $allowedDestinations = ["I", "D", "F", "S"];
        if (!in_array($destination, $allowedDestinations) || empty($destination)) {
            $destination = $this->defaultDestination;
        }

        // Export the PDF
        $this->mpdf->Output($this->report->getIdReport().'.pdf', $destination);

    } catch (MpdfException $e) { // Note: safer fully qualified exception name used for catch
        // Process the exception, log, print etc.
        echo $e->getMessage();
    }
}


}