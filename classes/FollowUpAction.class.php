<?php

/**
 * EQUANS PDF Report Follow Up Actions
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class FollowUpAction {
    
    protected string $vDescription;
    protected string $vActionType;
    protected string $vReportedActionHolder;
    protected string $vLinkedActionHolder;
    protected string $vPlannedDate;

    function __construct(
        string $vDescription,
        string $vActionType,
        string $vReportedActionHolder,
        string $vLinkedActionHolder,
        string $vPlannedDate
    ) {
        $this->vDescription = $vDescription;
        $this->vActionType = $vActionType;
        $this->vReportedActionHolder = $vReportedActionHolder;
        $this->vLinkedActionHolder = $vLinkedActionHolder;
        $this->vPlannedDate = $vPlannedDate;
    } 


    /**
     * Generates the HTML for a single Follow-Up Action
     *
     * @param int $i The index of the Follow-Up Action
     * @return string $vSingleActionHTML The Follow-Up Action, formatted in HTML
     */
        public function getSingleActionHTML(int $i) : string {


            return '

            <table class="vervolgacties">
                <tr>
                    <td colspan="5"><b>Vervolgactie ' . ($i + 1) . '</b></td>
                </tr>
                <tr class="vervolgactie-omschrijving">
                    <td colspan="5">' . $this->vDescription . '</td>
                </tr>
                <tr>
                    <td><b>Intern/extern</b></td>
                    <td><b>Voorgestelde actiehouder</b></td>
                    <td><b>Daadwerkelijke actiehouder</b></td>
                    <td><b>Plandatum</b></td>
                </tr>
                <tr>
                    <td>' . $this->vActionType . '</td>
                    <td>' . $this->vReportedActionHolder . '</td>
                    <td>' . $this->vLinkedActionHolder . '</td>
                    <td>' . date('d-m-Y', $this->vPlannedDate) . '</td>
                </tr>
            </table>
            ';
        }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->vDescription;
    }

    /**
     * @return string
     */
    public function getActionType(): string
    {
        return $this->vActionType;
    }

    /**
     * @return string
     */
    public function getReportedActionHolder(): string
    {
        return $this->vReportedActionHolder;
    }

    /**
     * @return string
     */
    public function getLinkedActionHolder(): string
    {
        return $this->vLinkedActionHolder;
    }

    /**
     * @return string
     */
    public function getPlannedDate(): string
    {
        return $this->vPlannedDate;
    }



}