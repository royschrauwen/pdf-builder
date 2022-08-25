<?php
/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class InternalEvaluation extends Report {
    
    function __construct (
        private string $vWorkingTitle,
        private string $idReport,
        private string $vType,
        private string $dtDateTime,
        private string $vDepartment,
        private string $vReportedByName,
        private string $vReportedByPhone,
        private string $vReportedByEmail,
        private string $vCause,
        private string $vReference,
        private string $vCustomerInternal,
        private string $vDescription,
        private string $vNorm,
        private string $vNormParagraph,
        private string $vProcess,
        private string $vImpactLevel,
        private string $vSegment,
        private string $vProjectNameNumber,
        private string $vClientName,
        private array $aImages,
        private string $vCauseDescription,
        private string $vCauseAnalysis,
        private string $vSizeAnalysis,
        private string $vHowShouldBeSolved,
        private string $vActionsTaken,
        private string $vPlanningDate,
        private array $aFollowUpActions,
        private string $vEffectiveness
    ) {}

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
    
}