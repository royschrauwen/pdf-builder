<?php

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/ExternalEvaluation.class.php';



// Voorbeeldrapportage
$externalEvaluation = new ExternalEvaluation(
    "Testrapportage EQUANS",
    "1234567890",
    "Verbetervoorstel",
    "23-08-2022 09:36",
    "EQUANS Services Noord B.V.",
    "Roy Schrauwen",
    "Exporteren rapportages naar PDF",
    "Renko van den Hout",
    "Praesent blandit laoreet nibh. Nunc sed turpis. Phasellus ullamcorper ipsum rutrum nunc. Morbi ac felis. Maecenas vestibulum mollis diam. Nunc sed turpis. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. 
    
    Nam adipiscing. Integer tincidunt. Praesent egestas tristique nibh.
    
    Aenean ut eros et nisl sagittis vestibulum. Cras varius. Praesent blandit laoreet nibh. Sed hendrerit. Proin magna.
    
    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent ac massa at ligula laoreet iaculis. Praesent ut ligula non mi varius sagittis. Vivamus consectetuer hendrerit lacus. Fusce vel dui.",
    "2014/108/EG Electro Magnetisch compatabiliteit (CE)",
    "Pellentesque habitant morbi tristique",
    "Aptic",
    "Oorzaakanalyse",
    "Medium",
    "Roy maakt een PHP document dat gebruikt maakt van een library om een pagina naar PDF te kunnen omzetten",

    [
        [
        "actie" => "Styling voorleggen aan Renko / Lorentz",
        "internExtern" => "intern",
        "voorgesteldeActiehouder" => "Renko",
        "daadwerkelijkeActiehouder" => "Roy",
        "plandatum" => "23 aug 2022"
        ],
        [
        "actie" => "Andere pagina's maken",
        "internExtern" => "intern",
        "voorgesteldeActiehouder" => "Roy",
        "daadwerkelijkeActiehouder" => "ook Roy",
        "plandatum" => "23 aug 2022"
        ]
    ],
    "Doeltreffendheid is hoog"
);


// Creating the PDF
$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);
$mpdf->SetTitle($externalEvaluation->get('idReport'));

$stylesheet = file_get_contents('style\report.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHTMLHeader('
<table class="page-header">
    <tr>
        <td><img class="header-logo" src="images/logo.jpg" alt=""></td>
        <td><span class="werktitel">' . $externalEvaluation->get('vWorkingTitle') . '</span></td>
        <td><b>Datum en tijd</b><br>' . $externalEvaluation->get('dtDateTime') . '</td>
    </tr>
    <tr>
        <td colspan="1"><b>Registratienr</b> ' . $externalEvaluation->get('idReport') . '</td>
        <td colspan="2"><b>Meldingstype</b> ' . $externalEvaluation->get('vType') . '</td>
    </tr>
    <tr>
        <td colspan="1"><b>EQUANS bedrijf</b> ' . $externalEvaluation->get('vDepartment') . '</td>
        <td colspan="2"><b>Afdrukdatum</b> {DATE j-m-Y}</td>

    </tr>
</table>
');

$mpdf->WriteHTML('
<div class="page-content">
<table class="rapport-section">
    <tr>
        <td colspan="3"><b>Melder</b> ' . $externalEvaluation->get('vReportedByName') . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Referentie</b> ' . $externalEvaluation->get('vReference') . '</td>
    </tr>
    <tr>
        <td colspan="3">
            <b>Omschrijving van de constatering</b><br>' . nl2br($externalEvaluation->get('vDescription')) . '
        </td>
    </tr>
    <tr>
        <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $externalEvaluation->get('vNorm') . '</td>
        <td colspan="1"><b>Normparagraaf</b><br>' . $externalEvaluation->get('vNormParagraph') . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Klantnaam</b> ' . $externalEvaluation->get('vClientName') . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Oorzaakanalyse</b><br>
        ' . nl2br($externalEvaluation->get('vCauseAnalysis')) . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Omvanganalyse van de constatering</b><br>
        ' . nl2br($externalEvaluation->get('vSizeAnalysis')) . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verbetervoorstel</b><br>
        ' . nl2br($externalEvaluation->get('vHowShouldBeSolved')) . '</td>
    </tr>
</table>
');


// // Vervolgacties indien aanwezig
// if(count($externalEvaluation->get('aFollowUpActions')) > 0) {

//     $mpdf->WriteHTML('
//     <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>
//     ');

//     for ($i=0; $i < count($externalEvaluation->get('aFollowUpActions')) ; $i++) { 
//         $mpdf->WriteHTML('
//         <table class="vervolgacties">
//             <tr>
//                 <td colspan="5"><b>Vervolgactie ' . $i+1 . '</b></td>
//             </tr>
//             <tr class="vervolgactie-omschrijving">
//                 <td colspan="5">' . $externalEvaluation->get('aFollowUpActions')[$i]['actie'] . '</td>
//             </tr>
//             <tr>
//                 <td><b>Intern/extern</b></td>
//                 <td><b>Voorgestelde actiehouder</b></td>
//                 <td><b>Daadwerkelijke actiehouder</b></td>
//                 <td><b>Plandatum</b></td>
//             </tr>
//             <tr>
//                 <td>' . $externalEvaluation->get('aFollowUpActions')[$i]['internExtern'] . '</td>
//                 <td>' . $externalEvaluation->get('aFollowUpActions')[$i]['voorgesteldeActiehouder'] . '</td>
//                 <td>' . $externalEvaluation->get('aFollowUpActions')[$i]['daadwerkelijkeActiehouder'] . '</td>
//                 <td>' . $externalEvaluation->get('aFollowUpActions')[$i]['plandatum'] . '</td>
//             </tr>
//         </table>
//         ');
//     }

// }

$mpdf->WriteHTML('
    <table class="rapport-section">
        <tr>
            <td><b>Doeltreffendheid van de actie</b></td>
        </tr>
        <tr>
            <td>' . $externalEvaluation->get('vEffectiveness') . '</td>
        </tr>
    </table>
</div>
');

$mpdf->Output($externalEvaluation->get('idReport').'.pdf', 'I');