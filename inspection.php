<?php

require_once __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/Inspection.class.php';

// Voorbeeldrapportage
$inspection = new Inspection(
    "Testrapportage EQUANS",
    "1234567890",
    "Verbetervoorstel",
    "23-08-2022 09:36",
    "EQUANS Services Noord B.V.",
    "Roy Schrauwen",
    "0612345678",
    "roy@aptic.nl",
    "Exporteren rapportages naar PDF",
    "Renko van den Hout",
    "Intern",
    [
        "http://placekitten.com/800/450", 
        "http://placekitten.com/640/480", 
        "http://placekitten.com/300/300"
    ]
);





$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);
$mpdf->SetTitle($inspection->get('registratienummer'));

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHTMLHeader('
<table class="page-header">
    <tr>
        <td colspan="2"><img class="header-logo" src="logo.jpg" alt=""></td>
        <td><span class="werktitel">' . $inspection->get('werktitel') . '</span></td>
    </tr>
    <tr>
        <td><b>Registratienr</b><br>' . $inspection->get('registratienummer') . '</td>
        <td><b>Meldingstype</b><br>' . $inspection->get('meldingstype') . '</td>
        <td><b>EQUANS bedrijf</b><br>' . $inspection->get('equansBedrijf') . '</td>
        <td><b>Datum en tijd</b><br>' . $inspection->get('datumTijd') . '</td>
        <td><b>Afdrukdatum</b><br> {DATE j-m-Y}</td>
    </tr>
</table>
');
$mpdf->SetHTMLFooter('
<table class="page-footer">
    <tr>
        <td><b>ENKEL VOOR INTERN GEBRUIK</b></td>
        </tr><tr>
        <td><i>Neem contact op met de lokale QA afdeling van ' . $inspection->get('equansBedrijf') . ' voor meer informatie</i></td>
    </tr>
</table>
');


$mpdf->WriteHTML('
<div class="page-content">
    <table class="rapport-section">
        <tr>
            <td><b>Melder</b> ' . $inspection->get('melder') . '</td>
            <td><b>Tel</b> ' . $inspection->get('telefoonnummer') . '</td>
            <td><b>E-mailadres</b> ' . $inspection->get('emailadres') . '</td>
        </tr>

        <tr>
            <td><b>Aanleiding</b><br>' . $inspection->get('aanleiding') . '</td>
            <td><b>Referentie</b><br>' . $inspection->get('referentie') . '</td>
            <td><b>Klant of intern?</b><br>' . $inspection->get('klantintern') . '</td>
        </tr>
    </table>
    <table class="rapport-section">
        <tr>
            <td colspan="3">
                <b>Omschrijving van de constatering</b><br>' . nl2br($inspection->get('omschrijving')) . '
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $inspection->get('normSchemaVakgebied') . '</td>
            <td><b>Normparagraaf</b><br>' . $inspection->get('normparagraaf') . '</td>
        </tr>
        <tr>
            <td colspan="3">
                <b>Proces(sen) waar constatering heeft plaatsgevonden</b><br>' . $inspection->get('processen') . '
            </td>
        </tr>
        <tr>
            <td><b>Niveau impact</b> ' . $inspection->get('niveauImpact') . '</td>
            <td><b>Segment</b> ' . $inspection->get('segment') . '</td>
            <td><b>Klantnaam</b> ' . $inspection->get('klantnaam') . '</td>
        </tr>
        <tr>
            <td colspan="3"><b>Projectnaam en -nummer</b> ' . $inspection->get('projectnaamNummer') . '</td>
        </tr>
    </table>
');


// Afbeeldingen, max 2 per rij
if(count($inspection->get('afbeeldingen')) > 0) {
    $mpdf->WriteHTML('<table class="rapport-afbeeldingen rapport-section">');
    foreach (array_chunk($inspection->get('afbeeldingen'), 2) as $row) {
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
            ' . nl2br($inspection->get('omschrijvingDirecteAanleiding')) . '</td>
        </tr>
        <tr>
            <td><b>Oorzaakanalyse</b><br>
            ' . nl2br($inspection->get('oorzaakanalyse')) . '</td>
        </tr>
        <tr>
            <td><b>Omvanganalyse van de constatering</b><br>
            ' . nl2br($inspection->get('omvanganalyse')) . '</td>
        </tr>
        <tr>
            <td><b>Verbetervoorstel</b><br>
            ' . nl2br($inspection->get('verbetervoorstel')) . '</td>
        </tr>
        <tr>
            <td><b>Reeds genomen acties</b><br>
            ' . nl2br($inspection->get('reedsGenomenActies')) . '</td>
        </tr>
        <tr>
            <td><b>Plandatum</b><br>
            ' . $inspection->get('plandatum') . '</td>
        </tr>
    </table>
');


// Vervolgacties indien aanwezig
if(count($inspection->get('vervolgacties')) > 0) {

    $mpdf->WriteHTML('
    <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>
    ');

    for ($i=0; $i < count($inspection->get('vervolgacties')) ; $i++) { 
        $mpdf->WriteHTML('
        <table class="vervolgacties">
            <tr>
                <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
            </tr>
            <tr class="vervolgactie-omschrijving">
                <td colspan="5">' . $inspection->get('vervolgacties')[$i]['actie'] . '</td>
            </tr>
            <tr>
                <td><b>Intern/extern</b></td>
                <td><b>Voorgestelde actiehouder</b></td>
                <td><b>Daadwerkelijke actiehouder</b></td>
                <td><b>Plandatum</b></td>
            </tr>
            <tr>
                <td>' . $inspection->get('vervolgacties')[$i]['internExtern'] . '</td>
                <td>' . $inspection->get('vervolgacties')[$i]['voorgesteldeActiehouder'] . '</td>
                <td>' . $inspection->get('vervolgacties')[$i]['daadwerkelijkeActiehouder'] . '</td>
                <td>' . $inspection->get('vervolgacties')[$i]['plandatum'] . '</td>
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
            <td>' . $inspection->get('doeltreffendheid') . '</td>
        </tr>
    </table>
</div>
');

$mpdf->Output($inspection->get('registratienummer').'.pdf', 'I');