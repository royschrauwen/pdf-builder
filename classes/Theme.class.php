<?php
/**
 * EQUANS PDF Inspection PDF Theme
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Theme {

    private string $vThemeName;
    private array $aFindings;

    function __construct(
        string $vThemeName,
        array $aFindings
    )
    {

        $this->vThemeName = $vThemeName;
        foreach($aFindings as $finding){
            if(isset($finding)) {
                $newFinding = new Finding(
                    $finding['description'],
                    $finding['type'],
                    $finding['colleagues'],
                    $finding['evidence']['photo'],
                    $finding['directActions'],
                    $finding['actions']
                );
                $this->aFindings[] = $newFinding;
            }
        }

    }




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

    public function printTeamName() : string {
        return '<p class="inspection-theme-header"><b>Thema: ' . $this->getThemeName() . '</b></p>';
    }

}