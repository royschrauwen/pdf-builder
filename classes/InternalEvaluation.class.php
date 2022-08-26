<?php
/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class InternalEvaluation extends Evaluation {
    
/** Creates the HTML for the Header of the Internal Evaluation template */
public function getHeaderHTML() : string {
    return '
    <table class="page-header">
        <tr>
            <td colspan="2"><img class="header-logo" src="images\logo.jpg" alt=""></td>
            <td><span class="workingTitle">' . $this->get('vWorkingTitle') . '</span></td>
        </tr>
        <tr>
            <td><b>Registratienr</b><br>' . $this->get('idReport') . '</td>
            <td><b>Meldingstype</b><br>' . $this->get('vType') . '</td>
            <td><b>EQUANS bedrijf</b><br>' . $this->get('vDepartment') . '</td>
            <td><b>Datum en tijd</b><br>' . $this->get('dtDateTime') . '</td>
            <td><b>Afdrukdatum</b><br> {DATE j-m-Y}</td>
        </tr>
    </table>
    ';
}

/** Creates the HTML for the Footer of the Internal Evaluation template */
public function getFooterHTML() : string {
    return '
    <table class="page-footer">
    <tr>
        <td><b>ENKEL VOOR INTERN GEBRUIK</b></td>
        </tr><tr>
        <td><i>Neem contact op met de lokale QA afdeling van ' . $this->get('vDepartment') . ' voor meer informatie</i></td>
    </tr>
</table>
    ';
}

/** Creates the HTML for the Concent of the Internal Evaluation template */
public function getContentHTML() : string {
    $vContentHTML = '
    <div class="page-content">
            <table class="rapport-section">
                <tr>
                    <td><b>Melder</b> ' . $this->get('vReportedByName') . '</td>
                    <td><b>Tel</b> ' . $this->get('vReportedByPhone') . '</td>
                    <td><b>E-mailadres</b> ' . $this->get('vReportedByEmail') . '</td>
                </tr>

                <tr>
                    <td><b>Aanleiding</b><br>' . $this->get('vCause') . '</td>
                    <td><b>Referentie</b><br>' . $this->get('vReference') . '</td>
                    <td><b>Klant of intern?</b><br>' . $this->get('vCustomerInternal') . '</td>
                </tr>
            </table>
            <table class="rapport-section">
                <tr>
                    <td colspan="3">
                        <b>Omschrijving van de constatering</b><br>' . nl2br($this->get('vDescription')) . '
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $this->get('vNorm') . '</td>
                    <td><b>Normparagraaf</b><br>' . $this->get('vNormParagraph') . '</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Proces(sen) waar constatering heeft plaatsgevonden</b><br>' . $this->get('vProcess') . '
                    </td>
                </tr>
                <tr>
                    <td><b>Niveau impact</b> ' . $this->get('vImpactLevel') . '</td>
                    <td><b>Segment</b> ' . $this->get('vSegment') . '</td>
                    <td><b>Klantnaam</b> ' . $this->get('vClientName') . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Projectnaam en -nummer</b> ' . $this->get('vProjectNameNumber') . '</td>
                </tr>
            </table>
    ';

    // Images, max 2 per row
    if(count($this->get('aImages')) > 0) {
        $vContentHTML .= $this->getImageHTML();
    }

    $vContentHTML .= '
    <table class="rapport-section">
                <tr>
                    <td><b>Omschrijving directe Aanleiding</b><br>
                    ' . nl2br($this->get('vCauseDescription')) . '</td>
                </tr>
                <tr>
                    <td><b>Oorzaakanalyse</b><br>
                    ' . nl2br($this->get('vCauseAnalysis')) . '</td>
                </tr>
                <tr>
                    <td><b>Omvanganalyse van de constatering</b><br>
                    ' . nl2br($this->get('vSizeAnalysis')) . '</td>
                </tr>
                <tr>
                    <td><b>Verbetervoorstel</b><br>
                    ' . nl2br($this->get('vHowShouldBeSolved')) . '</td>
                </tr>
                <tr>
                    <td><b>Reeds genomen acties</b><br>
                    ' . nl2br($this->get('vActionsTaken')) . '</td>
                </tr>
                <tr>
                    <td><b>Plandatum</b><br>
                    ' . $this->get('vPlanningDate') . '</td>
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
    ';

    return $vContentHTML;
}

    
}