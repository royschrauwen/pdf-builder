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

    protected ?array $aInjured;
    protected ?array $aWitness;

    protected ?string $vPeopleInformed;

    protected ?array $aConsequences;
    protected ?string $vConsequencesDescription;

    protected ?bool $bSanction;
    protected ?bool $bRex;
    protected ?bool $bHipo;

    protected ?array $aDirectCauses;
    protected ?string $vDirectCauseDescription;
    protected ?array $aIndirectCauses;

    protected ?array $aRiskFactors;
    protected ?string $vRiskFactorsDescription;

    protected ?bool $bIsSolved;

    protected ?array $aDirectActionsWho;
    protected ?string $vDirectActionsHow;
    protected ?string $dtDirectActionsWhen;
    /**
     * @var array|mixed|null
     */
    private $vWitnessType;
    /**
     * @var array|mixed|null
     */
    private $vWitnessName;
    /**
     * @var false|string
     */
    private $dtInjuredAbsenceEnd;
    /**
     * @var false|string
     */
    private $dtInjuredAbsenceStart;
    /**
     * @var array|mixed|null
     */
    private $vInjuredConsequences;
    /**
     * @var array|mixed|null
     */
    private $vInjuredInjuryType;
    /**
     * @var array|mixed|null
     */
    private $vInjuredPersonType;
    /**
     * @var array|mixed|string
     */
    private $vLocationDescription;


    function __construct(string $jsonData) {

        $reportData = json_decode(json_decode($jsonData), true);

        $this->vType = SJAQuery::get($reportData, 'reportType') ?? 0;
        $this->dtDateTime = SJAQuery::get($reportData, 'tsDate') ? date('d-m-Y H:i', SJAQuery::get($reportData, 'tsDate')) : "-";
        $this->vSubtype = SJAQuery::get($reportData, 'reportSpec') ?? 0;
        $this->idReport = SJAQuery::get($reportData, '_id') ?? 0;
        $this->vDepartment = SJAQuery::get($reportData, 'department') ?? 0;
        $this->vReportedByName = SJAQuery::get($reportData, 'creator.name') ?? "";
        $this->vReportedByPhone = SJAQuery::get($reportData, 'creator.phoneNumber') ?? "";
        $this->vReportedByEmail = SJAQuery::get($reportData, 'creator.email') ?? "";
        $this->vProjectNameNumber = SJAQuery::get($reportData, 'projectNameNumber') ?? "";
        $this->vClientName = SJAQuery::get($reportData, 'location.clientName') ?? "";
        $this->vLocationDescription = SJAQuery::get($reportData, 'location.spot') ?? "";
        $this->vDescription = SJAQuery::get($reportData, 'description') ?? "";
        $this->aImages = SJAQuery::get($reportData, 'evidence.photo') ?? "";

        $this->aInjured = SJAQuery::get($reportData, 'pplAffected.injured') ?? "";

        $this->vInjuredPersonType = SJAQuery::get($reportData, 'pplAffected.injured.personType');
        $this->vInjuredInjuryType = SJAQuery::get($reportData, 'pplAffected.injured.injuryType');
        $this->vInjuredConsequences = SJAQuery::get($reportData, 'pplAffected.injured.consequences');
        $this->dtInjuredAbsenceStart = date('d-m-Y', SJAQuery::get($reportData, 'pplAffected.injured.absence.tsStart'));
        $this->dtInjuredAbsenceEnd = date('d-m-Y', SJAQuery::get($reportData, 'pplAffected.injured.absence.tsEnd'));

        $this->aWitness = SJAQuery::get($reportData, 'pplAffected.witness') ?? "";


        $this->vWitnessName = SJAQuery::get($reportData, 'pplAffected.witness.person.name');
        $this->vWitnessType = SJAQuery::get($reportData, 'pplAffected.witness.personType');


        $this->vPeopleInformed = SJAQuery::get($reportData, 'pplInformed') ?? "";

        $this->aConsequences = SJAQuery::get($reportData, 'consequences.list') ?? "";
        $this->vConsequencesDescription = SJAQuery::get($reportData, 'consequences.description') ?? "";

        $this->bSanction = SJAQuery::get($reportData, 'sanction.linked') ?? false;
        $this->bRex = SJAQuery::get($reportData, 'rex.linked') ?? false;
        $this->bHipo = SJAQuery::get($reportData, 'hipo.linked') ?? false;

        $this->aDirectCauses = SJAQuery::get($reportData, 'causes.direct') ?? "";
        $this->vDirectCauseDescription = SJAQuery::get($reportData, 'causes.description') ?? "";
        $this->aIndirectCauses = SJAQuery::get($reportData, 'causes.indirect') ?? "";

        $this->aRiskFactors = SJAQuery::get($reportData, 'riskFactors.list') ?? "";
        $this->vRiskFactorsDescription = SJAQuery::get($reportData, 'riskFactors.description') ?? "";
        $this->bIsSolved = SJAQuery::get($reportData, 'directActions.isDone') ?? false;

        $this->aDirectActionsWho = SJAQuery::get($reportData, 'directActions.who') ?? "";
        $this->vDirectActionsHow = SJAQuery::get($reportData, 'directActions.how') ?? "";
        $this->dtDirectActionsWhen = SJAQuery::get($reportData, 'directActions.tsDone') ? date('d-m-Y', SJAQuery::get($reportData, 'directActions.tsDone')) : "-";

        $this->aFollowUpActions = SJAQuery::get($reportData, 'actions') ?? "";
    }

    /** Converts a boolean value to Yes or No */
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
                    <td><b>Melder</b><br>' . $this->vReportedByName . '</td>
                    <td><b>Tel</b><br>' . $this->vReportedByPhone . '</td>
                    <td><b>E-mailadres</b><br>' . $this->vReportedByEmail . '</td>
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
                    <td><b>Wie is/zijn er betrokken?</b></td>
                </tr>
                <tr><td>
                
                ';

            for ($i=0; $i<count($this->aInjured); $i++) {

                $vContentHTML .= '<table>
                <tr >
                    <td colspan="2"> <b>Type:</b> ' .  $this->aInjured[$i]['personType'] . ' </td >
                </tr >
                <tr >
                    <td >
                        <b > Ongevalstype: </b > ' .  $this->aInjured[$i]['injuryType'] . '
                    </td >
                    <td >
                        <b > Gevolg: </b > ';


                $vContentHTML .= $this->aInjured[$i]['consequences'] ? Report::createListFromArray($this->aInjured[$i]['consequences']) : '';


                $vContentHTML .= '</td >
                </tr >
                <tr >
                    <td >
                        <b > Verzuim eerste dag: </b > ';

                $vContentHTML .= $this->aInjured[$i]['absence']['tsStart'] ? date('d-m-Y', $this->aInjured[$i]['absence']['tsStart']) : '-';

                    $vContentHTML .= '</td >
                    <td >
                        <b > Verzuim laatste dag: </b > ';

                $vContentHTML .= $this->aInjured[$i]['absence']['tsEnd'] ? date('d-m-Y', $this->aInjured[$i]['absence']['tsEnd']) : '-';

                $vContentHTML .= '</td >
                </tr >
                
                </table >';


            }

        $vContentHTML .= '</td></tr>
                
            </table>
            <table class="rapport-section">

                <tr>
                    <td>
                        <b>Getuigen</b>
                    <br>
                        <b>Naam:</b> ';


            for($w=0; $w < count($this->aWitness); $w++) {
                $vContentHTML .= $this->aWitness[$w]['person']['id'] . ' (' . $this->aWitness[$w]['personType'] . ')';
                $vContentHTML .= $w < count($this->aWitness)-1 ? ', ' : '';
            }


                    
                    
                    
                    $vContentHTML .= '</td>

            </table>

            <table class="rapport-section">
                <tr>
                <td><b>Wie zijn er al geïnformeerd? </b><br>' . $this->vPeopleInformed . '</td>
                </tr>
            </table>

            <table class="rapport-section">
                <tr>
                <td><b>Overige gevolgen</b><br>';

                if(count($this->aConsequences) > 0) {
                    $vContentHTML .= '<ul>';

                    foreach ($this->aConsequences as $consequence) {
                        $vContentHTML .= '<li>' . $consequence . '</li>';
                    }
                    $vContentHTML .= '</ul>';
                }



        $vContentHTML .= '</td>
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
                    <b>Directe aanleiding: </b>';

        $vContentHTML .= Report::createListFromArray($this->aDirectCauses);

        $vContentHTML .= '</td>
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
                    ';

        $vContentHTML .= Report::createListFromArray($this->aIndirectCauses);

        $vContentHTML .= '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Basis Risico Factoren: </b> 
                    ';

        $vContentHTML .= Report::createListFromArray($this->aRiskFactors);

        $vContentHTML .= '
                
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
                    ' . $this->booleanToYesNo($this->bIsSolved) . '
                </td>
            </tr>
            <tr>
                <td>
                    <b>Wie moest volgens de melder actie ondernemen? </b>
                     
                    ';

        $vContentHTML .= Report::createListFromArray($this->aDirectActionsWho);

        $vContentHTML .= '
                
                
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

        // Follow-Up Actions in case of a follow-up
        if(count($this->aFollowUpActions) > 0) {
            $vContentHTML .= $this->getFollowUpActionsHTML();
        }

        return $vContentHTML;
    }
}
