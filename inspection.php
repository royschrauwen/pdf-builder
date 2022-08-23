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
                    "http://placekitten.com/800/450", 
                    "http://placekitten.com/640/480"
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
                    "http://placekitten.com/300/450",  
                    "http://placekitten.com/300/300"
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
$mpdf->SetTitle($inspection->get('registratienummer'));

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

        ');

// Afbeeldingen, max 2 per rij
if(count($finding->get('images')) > 0) {
    $mpdf->WriteHTML('<table class="rapport-afbeeldingen rapport-section">');
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
    $mpdf->WriteHTML('</table>');
}


        $mpdf->WriteHTML('

        <p><b>Reeds genomen acties</b><br>' . $finding->get('actionsTaken') . '</p>

        <p>Vervolgacties</p>

        </div>
        

        ');
    }

    $mpdf->WriteHTML('
    </div>
    ');
}



// // Afbeeldingen, max 2 per rij
// if(count($inspection->get('afbeeldingen')) > 0) {
//     $mpdf->WriteHTML('<table class="rapport-afbeeldingen rapport-section">');
//     foreach (array_chunk($inspection->get('afbeeldingen'), 2) as $row) {
//         $mpdf->WriteHTML('<tr>');
//         foreach ($row as $value) { 
//             $mpdf->WriteHTML('
//             <td><center>
//                 <img class="rapport-afbeelding" src="' . $value . '" alt="">
//             </center></td>
//             ');
//         } 
//         $mpdf->WriteHTML('</tr>');
//     }
//     $mpdf->WriteHTML('</table>');
// }


// $mpdf->WriteHTML('
//     <table class="rapport-section">
//         <tr>
//             <td><b>Omschrijving directe Aanleiding</b><br>
//             ' . nl2br($inspection->get('omschrijvingDirecteAanleiding')) . '</td>
//         </tr>
//         <tr>
//             <td><b>Oorzaakanalyse</b><br>
//             ' . nl2br($inspection->get('oorzaakanalyse')) . '</td>
//         </tr>
//         <tr>
//             <td><b>Omvanganalyse van de constatering</b><br>
//             ' . nl2br($inspection->get('omvanganalyse')) . '</td>
//         </tr>
//         <tr>
//             <td><b>Verbetervoorstel</b><br>
//             ' . nl2br($inspection->get('verbetervoorstel')) . '</td>
//         </tr>
//         <tr>
//             <td><b>Reeds genomen acties</b><br>
//             ' . nl2br($inspection->get('reedsGenomenActies')) . '</td>
//         </tr>
//         <tr>
//             <td><b>Plandatum</b><br>
//             ' . $inspection->get('plandatum') . '</td>
//         </tr>
//     </table>
// ');


// // Vervolgacties indien aanwezig
// if(count($inspection->get('vervolgacties')) > 0) {

//     $mpdf->WriteHTML('
//     <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>
//     ');

//     for ($i=0; $i < count($inspection->get('vervolgacties')) ; $i++) { 
//         $mpdf->WriteHTML('
//         <table class="vervolgacties">
//             <tr>
//                 <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
//             </tr>
//             <tr class="vervolgactie-omschrijving">
//                 <td colspan="5">' . $inspection->get('vervolgacties')[$i]['actie'] . '</td>
//             </tr>
//             <tr>
//                 <td><b>Intern/extern</b></td>
//                 <td><b>Voorgestelde actiehouder</b></td>
//                 <td><b>Daadwerkelijke actiehouder</b></td>
//                 <td><b>Plandatum</b></td>
//             </tr>
//             <tr>
//                 <td>' . $inspection->get('vervolgacties')[$i]['internExtern'] . '</td>
//                 <td>' . $inspection->get('vervolgacties')[$i]['voorgesteldeActiehouder'] . '</td>
//                 <td>' . $inspection->get('vervolgacties')[$i]['daadwerkelijkeActiehouder'] . '</td>
//                 <td>' . $inspection->get('vervolgacties')[$i]['plandatum'] . '</td>
//             </tr>
//         </table>
//         ');
//     }
// }

// $mpdf->WriteHTML('
//     <table class="rapport-section">
//         <tr>
//             <td><b>Doeltreffendheid van de actie</b></td>
//         </tr>
//         <tr>
//             <td>' . $inspection->get('doeltreffendheid') . '</td>
//         </tr>
//     </table>
// </div>
// ');

$mpdf->Output($inspection->get('registratienummer').'.pdf', 'I');