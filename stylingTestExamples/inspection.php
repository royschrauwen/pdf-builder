<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/classes/Report.class.php';
require_once __DIR__ . '/classes/Inspection.class.php';
require_once __DIR__ . '/classes/Finding.class.php';
require_once __DIR__ . '/classes/FollowUpAction.class.php';
require_once __DIR__ . '/classes/Theme.class.php';

include_once 'dummyDataInspection.inc.php';



try {

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);
$mpdf->SetTitle($report->get('idReport'));

$stylesheet = file_get_contents('style/report.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHTMLHeader('
<table class="page-header">
    <tr>
        <td><img class="header-logo" src="images/logo.jpg" alt=""></td>
        <td><b>Meldingstype</b><br>' . $report->get('vType') . '</td>
        <td><b>Datum</b><br>' . $report->get('vDate') . '</td>
    </tr>
    <tr>
        <td><b>Registratienr</b><br>' . $report->get('idReport') . '</td>
        <td colspan="2"><b>EQUANS bedrijf</b><br>' . $report->get('vDepartment') . '</td>
    </tr>
</table>
');

$mpdf->SetHTMLFooter('
<table class="page-footer">
    <tr>
        <td><i>Neem contact op met de lokale HSE afdeling van ' . $report->get('vDepartment') . ' voor meer informatie</i></td>
    </tr>
</table>
');

$mpdf->WriteHTML('
<div class="page-content">
    <table class="rapport-section">
        <tr>
            <td><b>Melder</b><br>' . $report->get('vReportedByName') . '</td>
            <td><b>Tel</b><br>' . $report->get('vReportedByPhone') . '</td>
            <td><b>Meegelopen</b><br>' . $report->get('vPresentColleagues') . '</td>
        </tr>

        <tr>
            <td><b>Projectnaam en -nummer</b><br>' . $report->get('vProjectNameNumber') . '</td>
            <td><b>Klantnaam</b><br>' . $report->get('vClientName') . '</td>
            <td><b>Locatiebeschrijving</b><br>' . $report->get('vLocationDescription') . '</td>
        </tr>
    </table>
');




foreach ($report->get('aThemes') as $theme) {

    $mpdf->WriteHTML('
    <div class="inspection-theme">
    <p class="inspection-theme-header"><b>Thema: ' . $theme->get('vThemeName') . '</b></p>
    ');


    foreach ($theme->get('aFindings') as $finding) {
        $mpdf->WriteHTML('
        <div class="inspection-finding">

        <p><b>Omschrijving</b><br>' . $finding->get('vDescription') . '</p>
        <p><b>Type</b><br>' . $finding->get('vType') . '</p>
        <p><b>Gesproken met</b><br>' . $finding->get('vCollegues') . ' - ' . $finding->get('vDepartment') . '</p>
        </div>
        ');

// Afbeeldingen, max 2 per rij
if(count($finding->get('aImages')) > 0) {
    $mpdf->WriteHTML('
    <div class="inspection-images">

    <p style="margin-left:1rem"><b>Afbeeldingen</b></p>
    
    <table>
    ');
    foreach (array_chunk($finding->get('aImages'), 2) as $row) {
        $mpdf->WriteHTML('<tr>');
        foreach ($row as $value) { 
            $mpdf->WriteHTML('
            <td><center>
                <img class="rapport-afbeelding" src="' . $value . '" alt="">
            </center></td>
            ');
        } 
        $mpdf->WriteHTML('</tr>');
    }
    $mpdf->WriteHTML('</table></div>');
}


        $mpdf->WriteHTML('
        <div class="inspection-finding">

        <p><b>Reeds genomen acties</b><br>' . $finding->get('vActionsTaken') . '</p>');




// Vervolgacties indien aanwezig
if(count($finding->get('aFollowUpActions')) > 0) {

    $mpdf->WriteHTML('
    <p style="margin-left:1rem"><b>Vervolgacties</b></p>
    ');

    for ($i=0; $i < count($finding->get('aFollowUpActions')) ; $i++) { 
        $mpdf->WriteHTML('
        <table class="vervolgacties">
            <tr>
                <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
            </tr>
            <tr class="vervolgactie-omschrijving">
                <td colspan="5">' . $finding->get('aFollowUpActions')[$i]->get('description') . '</td>
            </tr>
            <tr>
                <td><b>Intern/extern</b></td>
                <td><b>Voorgestelde actiehouder</b></td>
                <td><b>Daadwerkelijke actiehouder</b></td>
                <td><b>Plandatum</b></td>
            </tr>
            <tr>
                <td>' . $finding->get('aFollowUpActions')[$i]->get('actionType') . '</td>
                <td>' . $finding->get('aFollowUpActions')[$i]->get('reportedActionHolder') . '</td>
                <td>' . $finding->get('aFollowUpActions')[$i]->get('linkedActionHolder') . '</td>
                <td>' . $finding->get('aFollowUpActions')[$i]->get('plannedDate') . '</td>
            </tr>
        </table>
        ');
    }
}






        $mpdf->WriteHTML('

        </div>
        

        ');
    }

    $mpdf->WriteHTML('
    </div>
    ');
}


$mpdf->Output($report->get('idReport').'.pdf', 'I');

} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}