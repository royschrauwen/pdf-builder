<?php
/**
 * EQUANS PDF IncidentReport
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class IncidentReport extends Report {
    
    protected ?string $vSubtype;

    protected ?string $vInjuredPersonType;
    protected ?string $vInjuredInjuryType;
    protected ?string $vInjuredConsequences;
    protected ?string $dtInjuredAbsenceStart;
    protected ?string $dtInjuredAbsenceEnd;

    protected ?string $vWitnessName;
    protected ?string $vWitnessType;

    protected ?string $vPeopleInformed;

    protected ?string $vConsequences;
    protected ?string $vConsequencesDescription;

    protected ?bool $bSanction;
    protected ?bool $bRex;
    protected ?bool $bHipo;

    protected ?string $vDirectCauses;
    protected ?string $vDirectCauseDescription;
    protected ?string $vIndirectCauses;

    protected ?string $vRiskFactors;
    protected ?string $vRiskFactorsDescription;

    protected ?bool $bIsSolved;

    protected ?string $vDirectActionsWho;
    protected ?string $vDirectActionsHow;
    protected ?string $dtDirectActionsWhen;


    function __construct(
        string $vType,
        string $dtDateTime,
        string $vSubtype,
        string $idReport,
        string $vDepartment,
        string $vReportedByName,
        string $vReportedByPhone,
        string $vReportedByEmail,
        string $vProjectNameNumber,
        string $vClientName,
        string $vLocationDescription,
        string $vDescription,
        array  $aImages,
        string $vInjuredPersonType,
        string $vInjuredInjuryType,
        string $vInjuredConsequences,
        string $dtInjuredAbsenceStart,
        string $dtInjuredAbsenceEnd,
        string $vWitnessName,
        string $vWitnessType,
        string $vPeopleInformed,
        string $vConsequences,
        string $vConsequencesDescription,
        bool $bSanction,
        bool $bRex,
        bool $bHipo,
        string $vDirectCauses,
        string $vDirectCauseDescription,
        string $vIndirectCauses,
        string $vRiskFactors,
        string $vRiskFactorsDescription,
        bool $bIsSolved,
        string $vDirectActionsWho,
        string $vDirectActionsHow,
        string $dtDirectActionsWhen,
        array  $aFollowUpActions,
    ) {

        $this->vType = $vType;
        $this->dtDateTime = $dtDateTime;
        $this->vSubtype = $vSubtype;
        $this->idReport = $idReport;
        $this->vDepartment = $vDepartment;
        $this->vReportedByName = $vReportedByName;
        $this->vReportedByPhone = $vReportedByPhone;
        $this->vReportedByEmail = $vReportedByEmail;
        $this->vProjectNameNumber = $vProjectNameNumber;
        $this->vClientName = $vClientName;
        $this->vLocationDescription = $vLocationDescription;
        $this->vDescription = $vDescription;
        $this->aImages = $aImages;
        $this->vInjuredPersonType = $vInjuredPersonType;
        $this->vInjuredInjuryType = $vInjuredInjuryType;
        $this->vInjuredConsequences = $vInjuredConsequences;
        $this->dtInjuredAbsenceStart = $dtInjuredAbsenceStart;
        $this->dtInjuredAbsenceEnd = $dtInjuredAbsenceEnd;
        $this->vWitnessName = $vWitnessName;
        $this->vWitnessType = $vWitnessType;
        $this->vPeopleInformed = $vPeopleInformed;
        $this->vConsequences = $vConsequences;
        $this->vConsequencesDescription = $vConsequencesDescription;
        $this->bSanction = $bSanction;
        $this->bRex = $bRex;
        $this->bHipo = $bHipo;
        $this->vDirectCauses = $vDirectCauses;
        $this->vDirectCauseDescription = $vDirectCauseDescription;
        $this->vIndirectCauses = $vIndirectCauses;
        $this->vRiskFactors = $vRiskFactors;
        $this->vRiskFactorsDescription = $vRiskFactorsDescription;
        $this->bIsSolved = $bIsSolved;
        $this->vDirectActionsWho = $vDirectActionsWho;
        $this->vDirectActionsHow = $vDirectActionsHow;
        $this->dtDirectActionsWhen = $dtDirectActionsWhen;
        $this->aFollowUpActions = $aFollowUpActions;

    }

    /** Converts a boolean value to Ja or Nee */
    protected function booleanToYesNo(bool $bValue): string {
        return $bValue ? 'Ja' : 'Nee';
    }
    
    /** Creates the HTML for the Header of the Internal Evaluation template */
    public function getHeaderHTML() : string {
        return '
        <table class="page-header">
            <tr>
                <td colspan="2"><img class="header-logo" src="images\logo.jpg" alt=""></td>
                <td colspan="2"><b>Meldingstype</b><br>' . $this->vType . '</td>
                <td><b>Subtype</b><br>' . $this->vSubtype . '</td>
                </tr>
                <tr>
                <td colspan="2"><b>Registratienr</b><br>' . $this->idReport . '</td>
                <td colspan="2"><b>EQUANS bedrijf</b><br>' . $this->vDepartment . '</td>
                <td><b>Datum en tijd</b><br>' . $this->dtDateTime . '</td>
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
            <td><i>Neem contact op met de lokale HSE afdeling van ' . $this->vDepartment . ' voor meer informatie</i></td>
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
                    <td><b>Projectnaam en -nummer</b><br>' . $this->vProjectNameNumber . '</td>
                    <td><b>Klantnaam</b><br>' . $this->vClientName . '</td>
                    <td><b>Locatiebeschrijving</b><br>' . $this->vLocationDescription . '</td>
                </tr>
            </table>
            <table class="rapport-section">
                <tr>
                <td><b>Omschrijving</b><br>' . $this->vDescription . '</td>
                </tr>
            </table>

        </div>
        ';

        // Images, if any
        if(count($this->aImages) > 0) {
            $vContentHTML .= $this->getImageHTML();
        }

        $vContentHTML .= '
        <div class="page-content">
            <table class="rapport-section">
                <tr>
                    <td><b>Wie is/zijn er betrokken?</b> Type: ' . $this->vInjuredPersonType . '</td>
                </tr>

                <tr>
                    <td>
                        <b>Ongevalstype: </b> ' . $this->vInjuredInjuryType . '
                    </td>
                    <td>
                        <b>Gevolg: </b> ' . $this->vInjuredConsequences . '
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Verzuim eerste dag: </b> ' . $this->dtInjuredAbsenceStart . '
                    </td>
                    <td>
                        <b>Verzuim laatste dag: </b> ' . $this->dtInjuredAbsenceEnd . '
                    </td>
                </tr>
            </table>
            <table class="rapport-section">

                <tr>
                    <td>
                        <b>Getuigen</b>
                    <br>
                        <b>Naam:</b> ' . $this->vWitnessName . '

                        - ' . $this->vWitnessType . '
                    </td>

            </table>

            <table class="rapport-section">
                <tr>
                <td><b>Wie zijn er al geïnformeerd? </b><br>' . $this->vPeopleInformed . '</td>
                </tr>
            </table>

            <table class="rapport-section">
                <tr>
                <td><b>Overige gevolgen</b><br>' . $this->vConsequences . '</td>
                </tr>
                <tr>
                <td><b>Omschrijving gevolgen</b><br>' . $this->vConsequencesDescription . '</td>
                </tr>
            </table>

            <table class="rapport-section incident-sanction">
                <tr>
                    <td colspan="1">
                        <b>Sanctie van toepassing?</b>: ' 
                        . $this->booleanToYesNo($this->bSanction) . '
                    </td>
                    <td colspan="1">
                        <b>REX?</b>: ' 
                        . $this->booleanToYesNo($this->bRex) . '
                    </td>
                    <td colspan="1">
                        <b>HIPO?</b>: ' 
                        . $this->booleanToYesNo($this->bHipo) . '
                    </td>
                </tr>

            </table>

            </div>
            <div class="page-content">

            <table class="rapport-section">
            <tr>
                <td>
                    <b>Directe aanleiding: </b>
                    ' . $this->vDirectCauses . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Omschrijving directe aanleiding: </b><br> 
                    ' . $this->vDirectCauseDescription . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Aanwijsbare oorzaken: </b>
                    ' . $this->vIndirectCauses . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Basis Risico Factoren: </b> 
                    ' . $this->vRiskFactors . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Omschrijving Basis Risico Factoren: </b><br> 
                    ' . $this->vRiskFactorsDescription . '
                </td>
            </tr>
        </table>

        </div>


        <div class="page-content">

            <table class="rapport-section">
            <tr>
                <td>
                    <b>Is het reeds opgelost? </b>
                    ' . $this->booleanToYesNo($this->get('bIsSolved')) . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Wie moest volgens de melder actie ondernemen? </b>
                    ' . $this->vDirectActionsWho . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Wat zag de melder als mogelijke oplossing? </b><br>
                    ' . $this->vDirectActionsHow . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Wanneer moest dit van de melder uiterlijk opgelost zijn? </b>
                    ' . $this->dtDirectActionsWhen . '
                </td>
            </tr>


            </table>
        </div>



        ';

        // Follow Up Actions in case of a follow up
        if(count($this->aFollowUpActions) > 0) {
            $vContentHTML .= $this->getFollowUpActionsHTML();
        }

        return $vContentHTML;
    }
}
?>