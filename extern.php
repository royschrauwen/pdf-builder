<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic - Roy Schrauwen
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Report {
    
    function __construct(
    private string $werktitel,
    private string $registratienummer,
    private string $meldingstype,
    private string $datumTijd,
    private string $equansBedrijf,
    private string $melder,
    private string $telefoonnummer,
    private string $emailadres,
    private string $aanleiding,
    private string $referentie,
    private string $klantintern,
    private string $omschrijving,
    private string $normSchemaVakgebied,
    private string $normparagraaf,
    private string $processen,
    private string $niveauImpact,
    private string $segment,
    private string $projectnaamNummer,
    private string $klantnaam,
    private array $afbeeldingen,
    private string $omschrijvingDirecteAanleiding,
    private string $oorzaakanalyse,
    private string $omvanganalyse,
    private string $verbetervoorstel,
    private string $reedsGenomenActies,
    private string $plandatum,
    private array $vervolgacties,
    private string $doeltreffendheid
    ) {}

    /**
     * Get's the value of an object's property.
     *
     * @param string $property The property to be retreived
     * @return mixed|false The value of the requested property | The property does not exist on this object
     */
    public function get(string $property) : mixed
    {
        return array_key_exists($property, get_object_vars($this)) ? $this->{$property} : false;
    }


    /**
     * Set's the value for an property from the calling object.
     *
     * @param string $property The property to be set
     * @param mixed The value to be set
     */
    public function set(string $property, mixed $value)
    {
        $this->{$property} = $value;
    }

    
}


// Voorbeeldrapportage
$rapport = new Report(
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
    "Praesent blandit laoreet nibh. Nunc sed turpis. Phasellus ullamcorper ipsum rutrum nunc. Morbi ac felis. Maecenas vestibulum mollis diam. Nunc sed turpis. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. 
    
    Nam adipiscing. Integer tincidunt. Praesent egestas tristique nibh.
    
    Aenean ut eros et nisl sagittis vestibulum. Cras varius. Praesent blandit laoreet nibh. Sed hendrerit. Proin magna.
    
    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent ac massa at ligula laoreet iaculis. Praesent ut ligula non mi varius sagittis. Vivamus consectetuer hendrerit lacus. Fusce vel dui.",
    "2014/108/EG Electro Magnetisch compatabiliteit (CE)",
    "Pellentesque habitant morbi tristique",
    "Advies, Engineering, Design, PDF",
    "Project / Contract",
    "Nader te bepalen",
    "PDF-Rapportage 0.0.1",
    "Aptic",
    [
        "http://placekitten.com/800/450", 
        "http://placekitten.com/640/480", 
        "http://placekitten.com/300/300"
    ],
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa nisi, finibus eget tellus ut, vestibulum faucibus odio. Aenean et velit justo. Praesent sit amet dapibus erat, cursus placerat est.",
    "Dit is de oorzaakanalyse van dit rapport",
    "Omvang is gemiddeld",
    "Roy maakt een PHP document dat gebruikt maakt van een library om een pagina naar PDF te kunnen omzetten",
    "Library is gedownload. Het begin van de template is gemaakt",
    "23-08-2022",
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





$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);

$stylesheet = file_get_contents('style.css');


$mpdf->SetTitle($rapport->get('registratienummer'));

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);


$mpdf->SetHTMLHeader('
<table class="page-header">

<tr>
    <td><img class="header-logo" src="logo.jpg" alt=""></td>
    <td><span class="werktitel">' . $rapport->get('werktitel') . '</span></td>
    <td><b>Datum en tijd</b><br>' . $rapport->get('datumTijd') . '</td>
</tr>
<tr>
    <td colspan="1"><b>Registratienr</b> ' . $rapport->get('registratienummer') . '</td>
    <td colspan="2"><b>Meldingstype</b> ' . $rapport->get('meldingstype') . '</td>
</tr>
<tr>
    <td colspan="1"><b>EQUANS bedrijf</b> ' . $rapport->get('equansBedrijf') . '</td>
    <td colspan="2"><b>Afdrukdatum</b> {DATE j-m-Y}</td>

</tr>

</table>
');



$mpdf->WriteHTML('

<div class="page-content">
<table class="rapport-section">
    <tr>
        <td colspan="3"><b>Melder</b> ' . $rapport->get('melder') . '</td>
    </tr>

    <tr>
        <td colspan="3"><b>Referentie</b> ' . $rapport->get('referentie') . '</td>
    </tr>



    <tr>
        <td colspan="3">
            <b>Omschrijving van de constatering</b><br>' . nl2br($rapport->get('omschrijving')) . '
        </td>
    </tr>

    <tr>
        <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $rapport->get('normSchemaVakgebied') . '</td>
        <td colspan="1"><b>Normparagraaf</b><br>' . $rapport->get('normparagraaf') . '</td>
    </tr>



    <tr>

        <td colspan="3"><b>Klantnaam</b> ' . $rapport->get('klantnaam') . '</td>

    </tr>


    <tr>
        <td colspan="3"><b>Oorzaakanalyse</b><br>
        ' . nl2br($rapport->get('oorzaakanalyse')) . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Omvanganalyse van de constatering</b><br>
        ' . nl2br($rapport->get('omvanganalyse')) . '</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verbetervoorstel</b><br>
        ' . nl2br($rapport->get('verbetervoorstel')) . '</td>
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
                <td colspan="5">' . $rapport->get('vervolgacties')[$i]['actie'] . '</td>
            </tr>
            <tr>
                <td><b>Intern/extern</b></td>
                <td><b>Voorgestelde actiehouder</b></td>
                <td><b>Daadwerkelijke actiehouder</b></td>
                <td><b>Plandatum</b></td>
            </tr>
            <tr>
                <td>' . $rapport->get('vervolgacties')[$i]['internExtern'] . '</td>
                <td>' . $rapport->get('vervolgacties')[$i]['voorgesteldeActiehouder'] . '</td>
                <td>' . $rapport->get('vervolgacties')[$i]['daadwerkelijkeActiehouder'] . '</td>
                <td>' . $rapport->get('vervolgacties')[$i]['plandatum'] . '</td>
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