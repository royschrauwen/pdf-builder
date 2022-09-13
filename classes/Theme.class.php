<?php
/**
 * EQUANS PDF Inspection PDF Theme
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Theme {



    function __construct(
        string $vThemeName,
        array $aFindings,
    )
    {

        $this->vThemeName = $vThemeName;
        $this->aFindings = $aFindings;

    }


    private string $vThemeName;

    /**
     * @return string
     */
    public function getThemeName(): string
    {
        return $this->vThemeName;
    }

    /**
     * @return array
     */
    public function getFindings(): array
    {
        return $this->aFindings;
    }
    private array  $aFindings;



}