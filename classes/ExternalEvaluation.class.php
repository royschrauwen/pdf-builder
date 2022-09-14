<?php


/**
 * EQUANS PDF Reports - External Evaluation Template
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class ExternalEvaluation extends Evaluation {

    /** Creates the HTML for the Header of the External Evaluation template */
    public function getHeaderHTML() : string {
        return '
        <table class="page-header">
        <tr>
            <td><img class="header-logo" src="images/logo.jpg" alt=""></td>
            <td><span class="werktitel">' . $this->vWorkingTitle . '</span></td>
            <td><b>Datum en tijd</b><br>' . $this->dtDateTime . '</td>
        </tr>
        <tr>
            <td colspan="1"><b>Registratienr</b> ' . $this->idReport . '</td>
            <td colspan="2"><b>Meldingstype</b> ' . $this->vType . '</td>
        </tr>
        <tr>
            <td colspan="1"><b>EQUANS bedrijf</b> ' . $this->vDepartment . '</td>
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
                    <td colspan="3"><b>Melder</b><br>' . $this->vReportedByName . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Referentie</b><br>' . $this->vReference . '</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Omschrijving van de constatering</b><br>' . nl2br($this->vDescription) . '
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $this->vNorm . '</td>
                    <td colspan="1"><b>Normparagraaf</b><br>' . $this->vNormParagraph . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Klantnaam</b> ' . $this->vClientName . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Oorzaakanalyse</b><br>
                    ' . nl2br($this->vCauseAnalysis) . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Omvanganalyse van de constatering</b><br>
                    ' . nl2br($this->vSizeAnalysis) . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Verbetervoorstel</b><br>
                    ' . nl2br($this->vHowShouldBeSolved) . '</td>
                </tr>
            </table>
        ';

        // Follow-Up Actions in case of a follow-up
        if(count($this->aFollowUpActions) > 0) {
            $vContentHTML .= $this->getFollowUpActionsHTML();
        }

        $vContentHTML .= '
        <table class="rapport-section">
        <tr>
            <td><b>Doeltreffendheid van de actie</b></td>
        </tr>
        <tr>
            <td>' . $this->vEffectiveness . '</td>
        </tr>
    </table>
</div>
        ';

        return $vContentHTML;

    }
    
}