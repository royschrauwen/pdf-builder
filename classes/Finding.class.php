<?php

// require_once __DIR__ . '/Equans.class.php';


/**
 * EQUANS PDF Inspection PDF Findings
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Finding {

    function __construct(
    private string $vDescription,
    private string $vType,
    private string $vCollegues,
    private string $vDepartment,
    private array $aImages,
    private string $vActionsTaken,
    private array $aFollowUpActions,
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