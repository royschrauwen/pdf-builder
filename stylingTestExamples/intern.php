<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/Equans.class.php';
require_once __DIR__ . '/Report.class.php';
require_once __DIR__ . '/FollowUpAction.class.php';







$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);
$mpdf->SetTitle($rapport->get('registratienummer'));

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHTMLHeader('
<table class="page-header">
    <tr>
        <td colspan="2"><img class="header-logo" src="logo.jpg" alt=""></td>
        <td><span class="werktitel">' . $rapport->get('werktitel') . '</span></td>
    </tr>
    <tr>
        <td><b>Registratienr</b><br>' . $rapport->get('registratienummer') . '</td>
        <td><b>Meldingstype</b><br>' . $rapport->get('meldingstype') . '</td>
        <td><b>EQUANS bedrijf</b><br>' . $rapport->get('equansBedrijf') . '</td>
        <td><b>Datum en tijd</b><br>' . $rapport->get('datumTijd') . '</td>
        <td><b>Afdrukdatum</b><br> {DATE j-m-Y}</td>
    </tr>
</table>
');
$mpdf->SetHTMLFooter('
<table class="page-footer">
    <tr>
        <td><b>ENKEL VOOR INTERN GEBRUIK</b></td>
        </tr><tr>
        <td><i>Neem contact op met de lokale QA afdeling van ' . $rapport->get('equansBedrijf') . ' voor meer informatie</i></td>
    </tr>
</table>
');


$mpdf->WriteHTML('
<div class="page-content">
    <table class="rapport-section">
        <tr>
            <td><b>Melder</b> ' . $rapport->get('melder') . '</td>
            <td><b>Tel</b> ' . $rapport->get('telefoonnummer') . '</td>
            <td><b>E-mailadres</b> ' . $rapport->get('emailadres') . '</td>
        </tr>

        <tr>
            <td><b>Aanleiding</b><br>' . $rapport->get('aanleiding') . '</td>
            <td><b>Referentie</b><br>' . $rapport->get('referentie') . '</td>
            <td><b>Klant of intern?</b><br>' . $rapport->get('klantintern') . '</td>
        </tr>
    </table>
    <table class="rapport-section">
        <tr>
            <td colspan="3">
                <b>Omschrijving van de constatering</b><br>' . nl2br($rapport->get('omschrijving')) . '
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $rapport->get('normSchemaVakgebied') . '</td>
            <td><b>Normparagraaf</b><br>' . $rapport->get('normparagraaf') . '</td>
        </tr>
        <tr>
            <td colspan="3">
                <b>Proces(sen) waar constatering heeft plaatsgevonden</b><br>' . $rapport->get('processen') . '
            </td>
        </tr>
        <tr>
            <td><b>Niveau impact</b> ' . $rapport->get('niveauImpact') . '</td>
            <td><b>Segment</b> ' . $rapport->get('segment') . '</td>
            <td><b>Klantnaam</b> ' . $rapport->get('klantnaam') . '</td>
        </tr>
        <tr>
            <td colspan="3"><b>Projectnaam en -nummer</b> ' . $rapport->get('projectnaamNummer') . '</td>
        </tr>
    </table>
');


// Afbeeldingen, max 2 per rij
if(count($rapport->get('afbeeldingen')) > 0) {
    $mpdf->WriteHTML('<table class="rapport-afbeeldingen rapport-section">');
    foreach (array_chunk($rapport->get('afbeeldingen'), 2) as $row) {
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
    $mpdf->WriteHTML('</table>');
}


$mpdf->WriteHTML('
    <table class="rapport-section">
        <tr>
            <td><b>Omschrijving directe Aanleiding</b><br>
            ' . nl2br($rapport->get('omschrijvingDirecteAanleiding')) . '</td>
        </tr>
        <tr>
            <td><b>Oorzaakanalyse</b><br>
            ' . nl2br($rapport->get('oorzaakanalyse')) . '</td>
        </tr>
        <tr>
            <td><b>Omvanganalyse van de constatering</b><br>
            ' . nl2br($rapport->get('omvanganalyse')) . '</td>
        </tr>
        <tr>
            <td><b>Verbetervoorstel</b><br>
            ' . nl2br($rapport->get('verbetervoorstel')) . '</td>
        </tr>
        <tr>
            <td><b>Reeds genomen acties</b><br>
            ' . nl2br($rapport->get('reedsGenomenActies')) . '</td>
        </tr>
        <tr>
            <td><b>Plandatum</b><br>
            ' . $rapport->get('plandatum') . '</td>
        </tr>
    </table>
');


// Vervolgacties indien aanwezig
if(count($rapport->get('vervolgacties')) > 0) {

    $mpdf->WriteHTML('
    <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>
    ');

    for ($i=0; $i < count($rapport->get('vervolgacties')) ; $i++) { 
        $mpdf->WriteHTML('
        <table class="vervolgacties">
            <tr>
                <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
            </tr>
            <tr class="vervolgactie-omschrijving">
                <td colspan="5">' . $rapport->get('vervolgacties')[$i]->get('description') . '</td>
            </tr>
            <tr>
                <td><b>Intern/extern</b></td>
                <td><b>Voorgestelde actiehouder</b></td>
                <td><b>Daadwerkelijke actiehouder</b></td>
                <td><b>Plandatum</b></td>
            </tr>
            <tr>
                <td>' . $rapport->get('vervolgacties')[$i]->get('actionType') . '</td>
                <td>' . $rapport->get('vervolgacties')[$i]->get('reportedActionHolder') . '</td>
                <td>' . $rapport->get('vervolgacties')[$i]->get('linkedActionHolder') . '</td>
                <td>' . $rapport->get('vervolgacties')[$i]->get('plannedDate') . '</td>
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
            <td>' . $rapport->get('doeltreffendheid') . '</td>
        </tr>
    </table>
</div>
');

$mpdf->Output($rapport->get('registratienummer').'.pdf', 'I');