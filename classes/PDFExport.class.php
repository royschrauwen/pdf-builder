<?php
/**
 * EQUANS PDF Exporter
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class PDFExport {

private $mpdf;
private $defaultDestination = "D";

public function __construct(private Report $report) {
    // Create PDF
    $this->mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);

    // Set metadata
    $this->setMetaData();

    // Import styling
    $stylesheet = file_get_contents('style\report.css');
    $this->mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
}


/** Sets the metadata for the PDF. */
private function setMetaData() : void {
    $this->mpdf->SetTitle($this->report->get('idReport'));
    $this->mpdf->SetAuthor($this->report->get('vDepartment'));
    $this->mpdf->SetCreator('EQUANS');
    $this->mpdf->SetSubject($this->report->get('vWorkingTitle'));
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

    $this->mpdf->Output($this->report->get('idReport').'.pdf', $destination);
}


/** Creates the PDF file using the Evaluation template */
public function createEvaluationPDF() : void {
    try {

        // Create header
        $this->mpdf->SetHTMLHeader('
        <table class="page-header">
            <tr>
                <td colspan="2"><img class="header-logo" src="images\logo.jpg" alt=""></td>
                <td><span class="workingTitle">' . $this->report->get('vWorkingTitle') . '</span></td>
            </tr>
            <tr>
                <td><b>Registratienr</b><br>' . $this->report->get('idReport') . '</td>
                <td><b>Meldingstype</b><br>' . $this->report->get('vType') . '</td>
                <td><b>EQUANS bedrijf</b><br>' . $this->report->get('vDepartment') . '</td>
                <td><b>Datum en tijd</b><br>' . $this->report->get('dtDateTime') . '</td>
                <td><b>Afdrukdatum</b><br> {DATE j-m-Y}</td>
            </tr>
        </table>
        ');

        $this->mpdf->SetHTMLFooter('
        <table class="page-footer">
            <tr>
                <td><b>ENKEL VOOR INTERN GEBRUIK</b></td>
                </tr><tr>
                <td><i>Neem contact op met de lokale QA afdeling van ' . $this->report->get('vDepartment') . ' voor meer informatie</i></td>
            </tr>
        </table>
        ');


        $this->mpdf->WriteHTML('
        <div class="page-content">
            <table class="rapport-section">
                <tr>
                    <td><b>Melder</b> ' . $this->report->get('vReportedByName') . '</td>
                    <td><b>Tel</b> ' . $this->report->get('vReportedByPhone') . '</td>
                    <td><b>E-mailadres</b> ' . $this->report->get('vReportedByEmail') . '</td>
                </tr>

                <tr>
                    <td><b>Aanleiding</b><br>' . $this->report->get('vCause') . '</td>
                    <td><b>Referentie</b><br>' . $this->report->get('vReference') . '</td>
                    <td><b>Klant of intern?</b><br>' . $this->report->get('vCustomerInternal') . '</td>
                </tr>
            </table>
            <table class="rapport-section">
                <tr>
                    <td colspan="3">
                        <b>Omschrijving van de constatering</b><br>' . nl2br($this->report->get('vDescription')) . '
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $this->report->get('vNorm') . '</td>
                    <td><b>Normparagraaf</b><br>' . $this->report->get('vNormParagraph') . '</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Proces(sen) waar constatering heeft plaatsgevonden</b><br>' . $this->report->get('vProcess') . '
                    </td>
                </tr>
                <tr>
                    <td><b>Niveau impact</b> ' . $this->report->get('vImpactLevel') . '</td>
                    <td><b>Segment</b> ' . $this->report->get('vSegment') . '</td>
                    <td><b>Klantnaam</b> ' . $this->report->get('vClientName') . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Projectnaam en -nummer</b> ' . $this->report->get('vProjectNameNumber') . '</td>
                </tr>
            </table>
        ');


        // Images, max 2 per row
        if(count($this->report->get('aImages')) > 0) {
            $this->mpdf->WriteHTML('<table class="rapport-afbeeldingen rapport-section">');
            foreach (array_chunk($this->report->get('aImages'), 2) as $row) {
                $this->mpdf->WriteHTML('<tr>');
                foreach ($row as $value) { 
                    $this->mpdf->WriteHTML('
                    <td><center>
                        <img class="rapport-afbeelding" src="' . $value . '" alt="">
                    </center></td>
                    ');
                } 
                $this->mpdf->WriteHTML('</tr>');
            }
            $this->mpdf->WriteHTML('</table>');
        }


        $this->mpdf->WriteHTML('
            <table class="rapport-section">
                <tr>
                    <td><b>Omschrijving directe Aanleiding</b><br>
                    ' . nl2br($this->report->get('vCauseDescription')) . '</td>
                </tr>
                <tr>
                    <td><b>Oorzaakanalyse</b><br>
                    ' . nl2br($this->report->get('vCauseAnalysis')) . '</td>
                </tr>
                <tr>
                    <td><b>Omvanganalyse van de constatering</b><br>
                    ' . nl2br($this->report->get('vSizeAnalysis')) . '</td>
                </tr>
                <tr>
                    <td><b>Verbetervoorstel</b><br>
                    ' . nl2br($this->report->get('vHowShouldBeSolved')) . '</td>
                </tr>
                <tr>
                    <td><b>Reeds genomen acties</b><br>
                    ' . nl2br($this->report->get('vActionsTaken')) . '</td>
                </tr>
                <tr>
                    <td><b>Plandatum</b><br>
                    ' . $this->report->get('vPlanningDate') . '</td>
                </tr>
            </table>
        ');


        // Follow Up Actions in case of a follow up
        if(count($this->report->get('aFollowUpActions')) > 0) {

            $this->mpdf->WriteHTML('
            <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>
            ');

            for ($i=0; $i < count($this->report->get('aFollowUpActions')) ; $i++) { 
                $this->mpdf->WriteHTML('
                <table class="vervolgacties">
                    <tr>
                        <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
                    </tr>
                    <tr class="vervolgactie-omschrijving">
                        <td colspan="5">' . $this->report->get('aFollowUpActions')[$i]->get('description') . '</td>
                    </tr>
                    <tr>
                        <td><b>Intern/extern</b></td>
                        <td><b>Voorgestelde actiehouder</b></td>
                        <td><b>Daadwerkelijke actiehouder</b></td>
                        <td><b>Plandatum</b></td>
                    </tr>
                    <tr>
                        <td>' . $this->report->get('aFollowUpActions')[$i]->get('actionType') . '</td>
                        <td>' . $this->report->get('aFollowUpActions')[$i]->get('reportedActionHolder') . '</td>
                        <td>' . $this->report->get('aFollowUpActions')[$i]->get('linkedActionHolder') . '</td>
                        <td>' . $this->report->get('aFollowUpActions')[$i]->get('plannedDate') . '</td>
                    </tr>
                </table>
                ');
            }
        }

        $this->mpdf->WriteHTML('
            <table class="rapport-section">
                <tr>
                    <td><b>Doeltreffendheid van de actie</b></td>
                </tr>
                <tr>
                    <td>' . $this->report->get('vEffectiveness') . '</td>
                </tr>
            </table>
        </div>
        ');

        $this->exportPDF("I");    

    } catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
        // Process the exception, log, print etc.
        echo $e->getMessage();
    }
}

}