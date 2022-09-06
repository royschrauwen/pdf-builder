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

    protected ?bool $bIsDone;

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
        bool $bIsDone,
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
        $this->bIsDone = $bIsDone;
        $this->vDirectActionsWho = $vDirectActionsWho;
        $this->vDirectActionsHow = $vDirectActionsHow;
        $this->dtDirectActionsWhen = $dtDirectActionsWhen;
        $this->aFollowUpActions = $aFollowUpActions;

    }

    
    /** Creates the HTML for the Header of the Internal Evaluation template */
    public function getHeaderHTML() : string {
        return '
        <table class="page-header">
            <tr>
                <td colspan="2"><img class="header-logo" src="images\logo.jpg" alt=""></td>
                <td colspan="2"><b>Meldingstype</b><br>' . $this->get('vType') . '</td>
                <td><b>Subtype</b><br>' . $this->get('vSubtype') . '</td>
                </tr>
                <tr>
                <td colspan="2"><b>Registratienr</b><br>' . $this->get('idReport') . '</td>
                <td colspan="2"><b>EQUANS bedrijf</b><br>' . $this->get('vDepartment') . '</td>
                <td><b>Datum en tijd</b><br>' . $this->get('dtDateTime') . '</td>
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
            <td><i>Neem contact op met de lokale HSE afdeling van ' . $this->get('vDepartment') . ' voor meer informatie</i></td>
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
                    <td><b>Projectnaam en -nummer</b><br>' . $this->get('vProjectNameNumber') . '</td>
                    <td><b>Klantnaam</b><br>' . $this->get('vClientName') . '</td>
                    <td><b>Locatiebeschrijving</b><br>' . $this->get('vLocationDescription') . '</td>
                </tr>
            </table>
            <table class="rapport-section">
                <tr>
                <td><b>Omschrijving</b><br>' . $this->get('vDescription') . '</td>
                </tr>
            </table>

        </div>
        ';

        // Images, if any
        if(count($this->get('aImages')) > 0) {
            $vContentHTML .= $this->getImageHTML();
        }

        $vContentHTML .= '
        <div class="page-content">
            <table class="rapport-section">
                <tr>
                    <td><b>Wie is/zijn er betrokken?</b> Type: ' . $this->get('vInjuredPersonType') . '</td>
                </tr>

                <tr>
                    <td>
                        <b>Ongevalstype: </b> ' . $this->get('vInjuredInjuryType') . '
                    </td>
                    <td>
                        <b>Gevolg: </b> ' . $this->get('vInjuredConsequences') . '
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Verzuim eerste dag: </b> ' . $this->get('dtInjuredAbsenceStart') . '
                    </td>
                    <td>
                        <b>Verzuim laatste dag: </b> ' . $this->get('dtInjuredAbsenceEnd') . '
                    </td>
                </tr>
            </table>
            <table class="rapport-section">

                <tr>
                    <td>
                        <b>Getuigen</b>
                    <br>
                        <b>Naam:</b> ' . $this->get('vWitnessName') . '

                        - ' . $this->get('vWitnessType') . '
                    </td>

            </table>

            <table class="rapport-section">
                <tr>
                <td><b>Wie zijn er al geïnformeerd? </b><br>' . $this->get('vPeopleInformed') . '</td>
                </tr>
            </table>

            <table class="rapport-section">
                <tr>
                <td><b>Overige gevolgen</b><br>' . $this->get('vConsequences') . '</td>
                </tr>
                <tr>
                <td><b>Omschrijving gevolgen</b><br>' . $this->get('vConsequencesDescription') . '</td>
                </tr>
            </table>

            <table class="rapport-section incident-sanction">
                <tr>
                    <td colspan="1">
                        <b>Sanctie van toepassing?</b>: ' 
                        . $this->get('bSanction') . '
                    </td>
                    <td colspan="1">
                        <b>REX?</b>: ' 
                        . $this->get('bRex') . '
                    </td>
                    <td colspan="1">
                        <b>HIPO?</b>: ' 
                        . $this->get('bHipo') . '
                    </td>
                </tr>

            </table>

            </div>
            <div class="page-content">

            <table class="rapport-section">
            <tr>
                <td>
                    <b>Directe aanleiding: </b>
                    ' . $this->get('vDirectCauses') . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Omschrijving directe aanleiding: </b><br> 
                    ' . $this->get('vDirectCauseDescription') . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Aanwijsbare oorzaken: </b>
                    ' . $this->get('vIndirectCauses') . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Basis Risico Factoren: </b> 
                    ' . $this->get('vRiskFactors') . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Omschrijving Basis Risico Factoren: </b><br> 
                    ' . $this->get('vRiskFactorsDescription') . '
                </td>
            </tr>
        </table>

        </div>


        <div class="page-content">

            <table class="rapport-section">
            <tr>
                <td>
                    <b>Is het reeds opgelost? </b>
                    ' . $this->get('bIsDone') . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Wie moest volgens de melder actie ondernemen? </b>
                    ' . $this->get('vDirectActionsWho') . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Wat zag de melder als mogelijke oplossing? </b><br>
                    ' . $this->get('vDirectActionsHow') . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Wanneer moest dit van de melder uiterlijk opgelost zijn? </b>
                    ' . $this->get('dtDirectActionsWhen') . '
                </td>
            </tr>


            </table>
        </div>



        ';

        // Follow Up Actions in case of a follow up
        if(count($this->get('aFollowUpActions')) > 0) {
            $vContentHTML .= $this->getFollowUpActionsHTML();
        }

        return $vContentHTML;
    }
}
?>