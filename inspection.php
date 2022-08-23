<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/Inspection.class.php';
require_once __DIR__ . '/Finding.class.php';
require_once __DIR__ . '/FollowUpAction.class.php';
require_once __DIR__ . '/Theme.class.php';

// Voorbeeldrapportage
$inspection = new Inspection(
    "1234567890",
    "Verbetervoorstel",
    "23-08-2022 09:36",
    "EQUANS Services Noord B.V.",
    "Roy Schrauwen",
    "0612345678",
    "Jasper en Juraj",
    "Exporteren rapportages naar PDF - 01293213",
    "Renko van den Hout",
    "Kantoor Aptic",

    [ 
        new Theme(
        "Orde en netheid",
            [new Finding(
                "omschrijving bevinging 1 1",
                "type 1",
                "collega's 1",
                "afdeling 1",
                [
                    "http://placekitten.com/400/300", 
                    "http://placekitten.com/1200/900"
                ],
                "acties genomen 1",
                [
                    new FollowUpAction(
                        "omschrijving 1",
                        "type 1",
                        "actiehouder a 1",
                        "actiehouder b 1",
                        "24-08-2022"
                    ),
                    new FollowUpAction(
                        "omschrijving 2",
                        "type 2",
                        "actiehouder a 2",
                        "actiehouder b 2",
                        "25-08-2022"
                    ),
                    new FollowUpAction(
                        "omschrijving 3",
                        "type 3",
                        "actiehouder a 3",
                        "actiehouder b 3",
                        "26-08-2022"
                    )
                ]
                    )
    ]),
                    new Theme(
        "Veiligheid",
        [
            new Finding(
                "omschrijving van thema 2",
                "type 2",
                "collega's 2",
                "afdeling 2",
                [
                    "http://placekitten.com/800/600",  
                    "http://placekitten.com/1600/1200"
                ],
                "acties genomen 2",
                [
                    new FollowUpAction(
                        "omschrijving 3",
                        "type 13",
                        "actiehouder a 3",
                        "actiehouder b 3",
                        "24-08-2022"
                    ),
                    new FollowUpAction(
                        "omschrijving 4",
                        "type 4",
                        "actiehouder a 4",
                        "actiehouder b 4",
                        "25-08-2022"
                    )
                ]
                    )
    ])
    ]
);





$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);
$mpdf->SetTitle($inspection->get('id'));

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHTMLHeader('
<table class="page-header">
    <tr>
        <td><img class="header-logo" src="logo.jpg" alt=""></td>
        <td><b>Meldingstype</b><br>' . $inspection->get('type') . '</td>
        <td><b>Datum</b><br>' . $inspection->get('date') . '</td>
    </tr>
    <tr>
        <td><b>Registratienr</b><br>' . $inspection->get('id') . '</td>
        <td colspan="2"><b>EQUANS bedrijf</b><br>' . $inspection->get('department') . '</td>
    </tr>
</table>
');

$mpdf->SetHTMLFooter('
<table class="page-footer">
    <tr>
        <td><i>Neem contact op met de lokale HSE afdeling van ' . $inspection->get('department') . ' voor meer informatie</i></td>
    </tr>
</table>
');

$mpdf->WriteHTML('
<div class="page-content">
    <table class="rapport-section">
        <tr>
            <td><b>Melder</b><br>' . $inspection->get('reportedByName') . '</td>
            <td><b>Tel</b><br>' . $inspection->get('reportedByPhone') . '</td>
            <td><b>Meegelopen</b><br>' . $inspection->get('presentColleagues') . '</td>
        </tr>

        <tr>
            <td><b>Projectnaam en -nummer</b><br>' . $inspection->get('projectNameNumber') . '</td>
            <td><b>Klantnaam</b><br>' . $inspection->get('clientName') . '</td>
            <td><b>Locatiebeschrijving</b><br>' . $inspection->get('locationDescription') . '</td>
        </tr>
    </table>
');




foreach ($inspection->get('themes') as $theme) {

    $mpdf->WriteHTML('
    <div class="inspection-theme">
    <p class="inspection-theme-header"><b>Thema: ' . $theme->get('themeName') . '</b></p>
    ');


    foreach ($theme->get('findings') as $finding) {
        $mpdf->WriteHTML('
        <div class="inspection-finding">

        <p><b>Omschrijving</b><br>' . $finding->get('description') . '</p>
        <p><b>Type</b><br>' . $finding->get('type') . '</p>
        <p><b>Gesproken met</b><br>' . $finding->get('collegues') . ' - ' . $finding->get('department') . '</p>
        </div>
        ');

// Afbeeldingen, max 2 per rij
if(count($finding->get('images')) > 0) {
    $mpdf->WriteHTML('
    <div class="inspection-images">

    <p style="margin-left:1rem"><b>Afbeeldingen</b></p>
    
    <table>
    ');
    foreach (array_chunk($finding->get('images'), 2) as $row) {
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

        <p><b>Reeds genomen acties</b><br>' . $finding->get('actionsTaken') . '</p>');




// Vervolgacties indien aanwezig
if(count($finding->get('followUpActions')) > 0) {

    $mpdf->WriteHTML('
    <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>
    ');

    for ($i=0; $i < count($finding->get('followUpActions')) ; $i++) { 
        $mpdf->WriteHTML('
        <table class="vervolgacties">
            <tr>
                <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
            </tr>
            <tr class="vervolgactie-omschrijving">
                <td colspan="5">' . $finding->get('followUpActions')[$i]->get('description') . '</td>
            </tr>
            <tr>
                <td><b>Intern/extern</b></td>
                <td><b>Voorgestelde actiehouder</b></td>
                <td><b>Daadwerkelijke actiehouder</b></td>
                <td><b>Plandatum</b></td>
            </tr>
            <tr>
                <td>' . $finding->get('followUpActions')[$i]->get('actionType') . '</td>
                <td>' . $finding->get('followUpActions')[$i]->get('reportedActionHolder') . '</td>
                <td>' . $finding->get('followUpActions')[$i]->get('linkedActionHolder') . '</td>
                <td>' . $finding->get('followUpActions')[$i]->get('plannedDate') . '</td>
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


$mpdf->Output($inspection->get('id').'.pdf', 'I');