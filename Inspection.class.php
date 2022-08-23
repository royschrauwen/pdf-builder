<?php
/**
 * EQUANS PDF Inspection PDF
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Inspection {
    
    function __construct(
    private string $id,
    private string $type,
    private string $date,
    private string $department,
    
    private string $reportedByName,
    private string $reportedByPhone,
    private string $presentColleagues,

    private string $projectNameNumber,
    private string $clientName,
    private string $locationDescription,

    private string $theme,

    private array $findings,
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