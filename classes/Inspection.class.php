<?php
/**
 * EQUANS PDF Inspection PDF
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Inspection extends Report {
    
    function __construct(
    private string $idReport,
    private string $vType,
    private string $vDate,
    private string $vDepartment,

    private string $vReportedByName,
    private string $vReportedByPhone,
    private string $vPresentColleagues,

    private string $vProjectNameNumber,
    private string $vClientName,
    private string $vLocationDescription,

    private array $aThemes,

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



    
}
?>