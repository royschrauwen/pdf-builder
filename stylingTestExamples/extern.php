<?php

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/ExternalEvaluation.class.php';

include_once 'dummyDataExternalEvaluation.inc.php';


// Creating the PDF
$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);
$mpdf->SetTitle($report->get('idReport'));

$stylesheet = file_get_contents('style\report.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHTMLHeader('
<table class="page-header">
    <tr>
        <td><img class="header-logo" src="images/logo.jpg" alt=""></td>
        <td><span class="werktitel">' . $report->get('vWorkingTitle') . '</span></td>
        <td><b>Datum en tijd</b><br>' . $report->get('dtDateTime') . '</td>
    </tr>
    <tr>
        <td colspan="1"><b>Registratienr</b> ' . $report->get('idReport') . '</td>
        <td colspan="2"><b>Meldingstype</b> ' . $report->get('vType') . '</td>
    </tr>
    <tr>
        <td colspan="1"><b>EQUANS bedrijf</b> ' . $report->get('vDepartment') . '</td>
        <td colspan="2"><b>Afdrukdatum</b> {DATE j-m-Y}</td>

    </tr>
</table>
');

$mpdf->WriteHTML('
<div class="page-content">
<table class="rapport-section">
    <tr>
        <td colspan="3"><b>Melder</b> ' . $report->get('vReportedByName') . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Referentie</b> ' . $report->get('vReference') . '</td>
    </tr>
    <tr>
        <td colspan="3">
            <b>Omschrijving van de constatering</b><br>' . nl2br($report->get('vDescription')) . '
        </td>
    </tr>
    <tr>
        <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $report->get('vNorm') . '</td>
        <td colspan="1"><b>Normparagraaf</b><br>' . $report->get('vNormParagraph') . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Klantnaam</b> ' . $report->get('vClientName') . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Oorzaakanalyse</b><br>
        ' . nl2br($report->get('vCauseAnalysis')) . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Omvanganalyse van de constatering</b><br>
        ' . nl2br($report->get('vSizeAnalysis')) . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verbetervoorstel</b><br>
        ' . nl2br($report->get('vHowShouldBeSolved')) . '</td>
    </tr>
</table>
');


// Vervolgacties indien aanwezig
if(count($report->get('aFollowUpActions')) > 0) {

    $mpdf->WriteHTML('
    <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>
    ');

    for ($i=0; $i < count($report->get('aFollowUpActions')) ; $i++) { 
        $mpdf->WriteHTML('
        <table class="vervolgacties">
            <tr>
                <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
            </tr>
            <tr class="vervolgactie-omschrijving">
                <td colspan="5">' . $report->get('aFollowUpActions')[$i]['actie'] . '</td>
            </tr>
            <tr>
                <td><b>Intern/extern</b></td>
                <td><b>Voorgestelde actiehouder</b></td>
                <td><b>Daadwerkelijke actiehouder</b></td>
                <td><b>Plandatum</b></td>
            </tr>
            <tr>
                <td>' . $report->get('aFollowUpActions')[$i]['internExtern'] . '</td>
                <td>' . $report->get('aFollowUpActions')[$i]['voorgesteldeActiehouder'] . '</td>
                <td>' . $report->get('aFollowUpActions')[$i]['daadwerkelijkeActiehouder'] . '</td>
                <td>' . $report->get('aFollowUpActions')[$i]['plandatum'] . '</td>
            </tr>
        </table>
        ');
    }

}

$mpdf->WriteHTML('
    <table class="rapport-section">
        <tr>
            <td><b>Doeltreffendheid van de actie</b></td>
        </tr>
        <tr>
            <td>' . $report->get('vEffectiveness') . '</td>
        </tr>
    </table>
</div>
');

$mpdf->Output($report->get('idReport').'.pdf', 'I');