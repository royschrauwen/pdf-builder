<?php
/**
 * EQUANS PDF Reports - Internal Evaluation Template
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
            <td><span class="workingTitle">' . $this->vWorkingTitle . '</span></td>
        </tr>
        <tr>
            <td><b>Registratienr</b><br>' . $this->idReport . '</td>
            <td><b>Meldingstype</b><br>' . $this->vType . '</td>
            <td><b>EQUANS bedrijf</b><br>' . $this->vDepartment . '</td>
            <td><b>Datum en tijd</b><br>' . $this->dtDateTime . '</td>
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
        <td><i>Neem contact op met de lokale QA afdeling van ' . $this->vDepartment . ' voor meer informatie</i></td>
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
                    <td><b>Melder</b> ' . $this->vReportedByName . '</td>
                    <td><b>Tel</b> ' . $this->vReportedByPhone . '</td>
                    <td><b>E-mailadres</b> ' . $this->vReportedByEmail . '</td>
                </tr>

                <tr>
                    <td><b>Aanleiding</b><br>' . $this->vCause . '</td>
                    <td><b>Referentie</b><br>' . $this->vReference . '</td>
                    <td><b>Klant of intern?</b><br>' . $this->vCustomerInternal . '</td>
                </tr>
            </table>
            <table class="rapport-section">
                <tr>
                    <td colspan="3">
                        <b>Omschrijving van de constatering</b><br>' . nl2br($this->vDescription) . '
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Norm / schema / vakgebied</b><br>' . $this->vNorm . '</td>
                    <td><b>Normparagraaf</b><br>' . $this->vNormParagraph . '</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Proces(sen) waar constatering heeft plaatsgevonden</b><br>' . $this->vProcess . '
                    </td>
                </tr>
                <tr>
                    <td><b>Niveau impact</b> ' . $this->vImpactLevel . '</td>
                    <td><b>Segment</b> ' . $this->vSegment . '</td>
                    <td><b>Klantnaam</b> ' . $this->vClientName . '</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Projectnaam en -nummer</b> ' . $this->vProjectNameNumber . '</td>
                </tr>
            </table>
    ';

    // Images, max 2 per row
    if(count($this->aImages) > 0) {
        $vContentHTML .= $this->getImageHTML();
    }

    $vContentHTML .= '
    <table class="rapport-section">
                <tr>
                    <td><b>Omschrijving directe Aanleiding</b><br>
                    ' . nl2br($this->vCauseDescription) . '</td>
                </tr>
                <tr>
                    <td><b>Oorzaakanalyse</b><br>
                    ' . nl2br($this->vCauseAnalysis) . '</td>
                </tr>
                <tr>
                    <td><b>Omvanganalyse van de constatering</b><br>
                    ' . nl2br($this->vSizeAnalysis) . '</td>
                </tr>
                <tr>
                    <td><b>Verbetervoorstel</b><br>
                    ' . nl2br($this->vHowShouldBeSolved) . '</td>
                </tr>
                <tr>
                    <td><b>Reeds genomen acties</b><br>
                    ' . nl2br($this->vActionsTaken) . '</td>
                </tr>
                <tr>
                    <td><b>Plandatum</b><br>
                    ' . $this->vPlanningDate . '</td>
                </tr>
            </table>
    ';

    // Follow Up Actions in case of a follow up
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
    ';

    return $vContentHTML;
}

    
}