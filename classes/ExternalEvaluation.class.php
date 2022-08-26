<?php


/**
 * EQUANS PDF Reports - External Evaluation Template
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class ExternalEvaluation extends Evaluation {
    
    protected ?string $vWorkingTitle;
    protected ?string $idReport;
    protected ?string $vType;
    protected ?string $dtDateTime;
    protected ?string $vDepartment;
    protected ?string $vReportedByName;
    protected ?string $vCause;
    protected ?string $vReference;
    protected ?string $vDescription;
    protected ?string $vNorm;
    protected ?string $vNormParagraph;
    protected ?string $vClientName;
    protected ?string $vCauseAnalysis;
    protected ?string $vSizeAnalysis;
    protected ?string $vHowShouldBeSolved;
    protected ?array  $aFollowUpActions;
    protected ?string $vEffectiveness;

    function __construct (
        string $vWorkingTitle,
        string $idReport,
        string $vType,
        string $dtDateTime,
        string $vDepartment,
        string $vReportedByName,
        string $vCause,
        string $vReference,
        string $vDescription,
        string $vNorm,
        string $vNormParagraph,
        string $vClientName,
        string $vCauseAnalysis,
        string $vSizeAnalysis,
        string $vHowShouldBeSolved,
        array  $aFollowUpActions,
        string $vEffectiveness,
    ) {
        $this->vWorkingTitle = $vWorkingTitle;
        $this->idReport = $idReport;
        $this->vType = $vType;
        $this->dtDateTime = $dtDateTime;
        $this->vDepartment = $vDepartment;
        $this->vReportedByName = $vReportedByName;
        $this->vCause = $vCause;
        $this->vReference = $vReference;
        $this->vDescription = $vDescription;
        $this->vNorm = $vNorm;
        $this->vNormParagraph = $vNormParagraph;
        $this->vClientName = $vClientName;
        $this->vCauseAnalysis = $vCauseAnalysis;
        $this->vSizeAnalysis = $vSizeAnalysis;
        $this->vHowShouldBeSolved = $vHowShouldBeSolved;
        $this->aFollowUpActions = $aFollowUpActions;
        $this->vEffectiveness = $vEffectiveness;
    }

    /** Creates the HTML for the Header of the External Evaluation template */
    public function getHeaderHTML() : string {
        return '
        <table class="page-header">
        <tr>
            <td><img class="header-logo" src="images/logo.jpg" alt=""></td>
            <td><span class="werktitel">' . $this->get('vWorkingTitle') . '</span></td>
            <td><b>Datum en tijd</b><br>' . $this->get('dtDateTime') . '</td>
        </tr>
        <tr>
            <td colspan="1"><b>Registratienr</b> ' . $this->get('idReport') . '</td>
            <td colspan="2"><b>Meldingstype</b> ' . $this->get('vType') . '</td>
        </tr>
        <tr>
            <td colspan="1"><b>EQUANS bedrijf</b> ' . $this->get('vDepartment') . '</td>
            <td colspan="2"><b>Afdrukdatum</b> {DATE j-m-Y}</td>

        </tr>
    </table>
        ';
    }

    /** Creates the HTML for the Footer of the External Evaluation template */
    public function getFooterHTML() : string {
        return '';
    }

    /** Creates the HTML for the Concent of the External Evaluation template */
    public function getContentHTML() : string {
        $vContentHTML = '
        <div class="page-content">
            <table class="rapport-section">
                <tr>
                    <td colspan="3"><b>Melder</b> ' . $this->get('vReportedByName') . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Referentie</b> ' . $this->get('vReference') . '</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Omschrijving van de constatering</b><br>' . nl2br($this->get('vDescription')) . '
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $this->get('vNorm') . '</td>
                    <td colspan="1"><b>Normparagraaf</b><br>' . $this->get('vNormParagraph') . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Klantnaam</b> ' . $this->get('vClientName') . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Oorzaakanalyse</b><br>
                    ' . nl2br($this->get('vCauseAnalysis')) . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Omvanganalyse van de constatering</b><br>
                    ' . nl2br($this->get('vSizeAnalysis')) . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Verbetervoorstel</b><br>
                    ' . nl2br($this->get('vHowShouldBeSolved')) . '</td>
                </tr>
            </table>
        ';

        // Follow Up Actions in case of a follow up
        if(count($this->get('aFollowUpActions')) > 0) {
            $vContentHTML .= $this->getFollowUpActionsHTML();
        }

        $vContentHTML .= '
        <table class="rapport-section">
        <tr>
            <td><b>Doeltreffendheid van de actie</b></td>
        </tr>
        <tr>
            <td>' . $this->get('vEffectiveness') . '</td>
        </tr>
    </table>
</div>
        ';

        return $vContentHTML;

    }
    
}