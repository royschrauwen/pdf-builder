<?php
/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Evaluation extends Report {
    
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
?>