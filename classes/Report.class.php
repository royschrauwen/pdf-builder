<?php
/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Report {
    
    function __construct (
        protected ?string $vWorkingTitle,
        protected ?string $idReport,
        protected ?string $vType,
        protected ?string $dtDateTime,
        protected ?string $vDepartment,
        protected ?string $vReportedByName,
        protected ?string $vReportedByPhone,
        protected ?string $vReportedByEmail,
        protected ?string $vCause,
        protected ?string $vReference,
        protected ?string $vCustomerInternal,
        protected ?string $vDescription,
        protected ?string $vNorm,
        protected ?string $vNormParagraph,
        protected ?string $vProcess,
        protected ?string $vImpactLevel,
        protected ?string $vSegment,
        protected ?string $vProjectNameNumber,
        protected ?string $vClientName,
        protected ?array $aImages,
        protected ?string $vCauseDescription,
        protected ?string $vCauseAnalysis,
        protected ?string $vSizeAnalysis,
        protected ?string $vHowShouldBeSolved,
        protected ?string $vActionsTaken,
        protected ?string $vPlanningDate,
        protected ?array $aFollowUpActions,
        protected ?string $vEffectiveness
    ) {}

    /**
     * Get's the value of an object's property.
     *
     * @param string $property The property to be retreived
     * @return mixed|null The value of the requested property | The property does not exist on this object
     */
    public function get(string $property) : mixed
    {
        return array_key_exists($property, get_object_vars($this)) ? $this->{$property} : null;
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


    

    /**
     * Puts the images in the PDF, max 2 per row
     *
     * @return string $imageHTML The images to put in the PDF, formatted in HTML
     */
    public function getImageHTML() : string {

        $vImageHTML = '<table class="report-images">';

        foreach (array_chunk($this->aImages, 2) as $row) {
            $vImageHTML .= '<tr>';
            foreach ($row as $value) { 
                $vImageHTML .= 
                '<td><center>
                    <img class="rapport-afbeelding" src="' . $value . '" alt="">
                </center></td>';
            } 
            $vImageHTML .= '</tr>';
        }

        $vImageHTML .= '</table>';
        return $vImageHTML;
    }

    /**
     * Generates the HTML for Follow Up Actions
     *
     * @return string $imageHTML The Follow Up Actions, formatted in HTML
     */
    public function getFollowUpActionsHTML() : string {

        $vFollowUpActionHTML = '
        <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>';

        for ($i=0; $i < count($this->aFollowUpActions) ; $i++) { 
            $vFollowUpActionHTML .= $this->aFollowUpActions[$i]->getSingleActionHTML($i);
        }
        
        return $vFollowUpActionHTML;
    }

}