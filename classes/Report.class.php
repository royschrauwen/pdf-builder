<?php
/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */


abstract class Report {

    protected ?string $vWorkingTitle = '';
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
    protected ?array $aProcess;
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
    protected ?string $dtPlanningDate;
    protected ?array $aFollowUpActions;
    protected ?string $vEffectiveness;


    abstract public function getHeaderHTML(): string;
    abstract public function getFooterHTML(): string;
    abstract public function getContentHTML(): string;

    /**
     * @return string|null
     */
    public function getIdReport(): ?string
    {
        return $this->idReport;
    }

    /**
     * @return string|null
     */
    public function getWorkingTitle(): ?string
    {
        return $this->vWorkingTitle;
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->vDepartment;
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
                '<td>
                    <img class="rapport-afbeelding" src="' . $value . '" alt="">
                </td>';
            } 
            $vImageHTML .= '</tr>';
        }

        $vImageHTML .= '</table>';
        return $vImageHTML;
    }

    /**
     * Generates the HTML for Follow-Up Actions
     *
     * @return string $imageHTML The Follow-Up Actions, formatted in HTML
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
        }
        
        return $vFollowUpActionHTML;
    }

}