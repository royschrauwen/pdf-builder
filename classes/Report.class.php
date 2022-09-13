<?php
/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */


abstract class Report {

    protected ?string $vWorkingTitle;
    protected ?string $idReport;
    protected ?int $vType;
    protected ?string $dtDateTime;
    protected ?string $vDepartment;
    protected ?string $vReportedByName;
    protected ?string $vReportedByPhone;
    protected ?string $vReportedByEmail;
    protected ?string $vCause;
    protected ?string $vReference;
    protected ?string $vCustomerInternal;
    protected ?string $vDescription;
    protected ?string $vNorm;
    protected ?string $vNormParagraph;
    protected ?string $vProcess;
    protected ?string $vImpactLevel;
    protected ?string $vSegment;
    protected ?string $vProjectNameNumber;
    protected ?string $vClientName;
    protected ?array $aImages;
    protected ?string $vCauseDescription;
    protected ?string $vCauseAnalysis;
    protected ?string $vSizeAnalysis;
    protected ?string $vHowShouldBeSolved;
    protected ?string $vActionsTaken;
    protected ?string $vPlanningDate;
    protected ?array $aFollowUpActions;
    protected ?string $vEffectiveness;
    
    function __construct (
        string $vWorkingTitle,
        string $idReport,
        string $vType,
        string $dtDateTime,
        string $vDepartment,
        string $vReportedByName,
        string $vReportedByPhone,
        string $vReportedByEmail,
        string $vCause,
        string $vReference,
        string $vCustomerInternal,
        string $vDescription,
        string $vNorm,
        string $vNormParagraph,
        string $vProcess,
        string $vImpactLevel,
        string $vSegment,
        string $vProjectNameNumber,
        string $vClientName,
        array  $aImages,
        string $vCauseDescription,
        string $vCauseAnalysis,
        string $vSizeAnalysis,
        string $vHowShouldBeSolved,
        string $vActionsTaken,
        string $vPlanningDate,
        array  $aFollowUpActions,
        string $vEffectiveness
    ) {
        $this->vWorkingTitle = $vWorkingTitle;
        $this->idReport = $idReport;
        $this->vType = $vType;
        $this->dtDateTime = $dtDateTime;
        $this->vDepartment = $vDepartment;
        $this->vReportedByName = $vReportedByName;
        $this->vReportedByPhone = $vReportedByPhone;
        $this->vReportedByEmail = $vReportedByEmail;
        $this->vCause = $vCause;
        $this->vReference = $vReference;
        $this->vCustomerInternal = $vCustomerInternal;
        $this->vDescription = $vDescription;
        $this->vNorm = $vNorm;
        $this->vNormParagraph = $vNormParagraph;
        $this->vProcess = $vProcess;
        $this->vImpactLevel = $vImpactLevel;
        $this->vSegment = $vSegment;
        $this->vProjectNameNumber = $vProjectNameNumber;
        $this->vClientName = $vClientName;
        $this->aImages = $aImages;
        $this->vCauseDescription = $vCauseDescription;
        $this->vCauseAnalysis = $vCauseAnalysis;
        $this->vSizeAnalysis = $vSizeAnalysis;
        $this->vHowShouldBeSolved = $vHowShouldBeSolved;
        $this->vActionsTaken = $vActionsTaken;
        $this->vPlanningDate = $vPlanningDate;
        $this->aFollowUpActions = $aFollowUpActions;
        $this->vEffectivenes = $vEffectiveness;
    }

    abstract public function getHeaderHTML(): string;
    abstract public function getFooterHTML(): string;
    abstract public function getContentHTML(): string;

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


    public static function createListFromArray(array $array){
        if(count($array) == 1) {
            foreach ($array as $item) {
                $returnHTML = $item;
            }
        }

        if(count($array) > 1) {
            $returnHTML = '<ul>';

            foreach ($array as $item) {
                $returnHTML .= '<li>' . $item . '</li>';
            }
            $returnHTML .= '</ul>';
        }

        return $returnHTML;
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
            $followUpAction = new FollowUpAction(
                     $this->aFollowUpActions[$i]['description'],
                     $this->aFollowUpActions[$i]['actionType'],
                     $this->aFollowUpActions[$i]['colleague']['name'],
                     $this->aFollowUpActions[$i]['linkedColleague']['name'],
                     $this->aFollowUpActions[$i]['tsPlanned']
            );
            $vFollowUpActionHTML .= $followUpAction->getSingleActionHTML($i);
            //$vFollowUpActionHTML .= $this->aFollowUpActions[$i]->getSingleActionHTML($i);
        }
        
        return $vFollowUpActionHTML;
    }

}