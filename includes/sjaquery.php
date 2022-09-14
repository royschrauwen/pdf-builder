<?php /** @noinspection ALL */
/** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
//namespace Aptic;

/**
 * Class SJAQuery
 * @package Aptic
 *
 * Contrary to client-side implementation, this implementation is recursive in order to pass references along and
 * modify parameter properly without intensive unnecessary re-looping; as in-method sub-variables cannot be by
 * reference/pointer.
 */
class SJAQuery {
  /**
   * @param array $aData Data object is modified.
   * @param string $vQuery
   * @param mixed $vValue
   * @param bool $bForce
   * @param int $nDepth Internal recursive usage only, do not pass.
   * @param array|null $aSubQueryData Optional. If query contains subqueries that need to be resolved, they will be resolved from this object. If null, will use same data source ($aData).
   */
  public static function set(&$aData, $vQuery, $vValue, $bForce = false, $nDepth = 0, &$aSubQueryData = null) {
    if ($nDepth === 0) {
      $vOriginalQuery = $vQuery;
      $vQuery = self::resolve($aSubQueryData ? $aSubQueryData : $aData, $vQuery);
      if ($vQuery === null) {
        // TODO: Debugpoint.
        echo('<pre>'.json_encode($aData));
        trigger_error('Unresolvable query: one if its sub-queries could not be resolved.', E_USER_WARNING); return;
      }
    }
    if (!is_array($aData)) { trigger_error('Invalid object passed: expecting (associative) array.', E_USER_WARNING); return; }
    $aLocation = explode('.', $vQuery);
    if (count($aLocation) > 1) {
      $vFirstToken = $aLocation[0];
      $vQuery = implode('.', array_slice($aLocation, 1)); // Subquery after extracting first token.
      if (substr($vFirstToken, 0, 1) === '[' && substr($vFirstToken, -1, 1) === ']') { // Navigation within array
        $vFirstToken = intval(substr($vFirstToken, 1, -1));
        while(count($aData) <= ($vFirstToken-1)) $aData[] = null;
        if (!($vFirstToken < count($aData))) {
          $aData[$vFirstToken] = [];
        }
        if (!is_array($aData[$vFirstToken])) {
          if (!$bForce) { trigger_error('Trying to access index of array, while it is not an array. Force is disabled, so set is cancelled.', E_USER_WARNING); return; }
          trigger_error('Applied forceful overwriting of property with array, while it was not. Data was lost in the process.', E_USER_NOTICE);
          $aData[$vFirstToken] = [];
        }
        self::set($aData[$vFirstToken], $vQuery, $vValue, $bForce, $nDepth+1);
      } else { // Navigation within object
        if (!array_key_exists($vFirstToken, $aData))  $aData[$vFirstToken] = [];
        elseif (!is_array($aData[$vFirstToken])) {
          if (!$bForce) { trigger_error('Trying to access property as associative array, while it is not. Force is disabled, so set is cancelled.', E_USER_WARNING); return; }
          trigger_error('Applied forceful overwriting of property with associative array, while it was not. Data was lost in the process.', E_USER_NOTICE);
          $aData[$vFirstToken] = [];
        }
        self::set($aData[$vFirstToken], $vQuery, $vValue, $bForce, $nDepth+1);
      }
    } else { // Final token. Set on current data object reference.
      if (substr($vQuery, -2, 2) === '[]') { // Append operation.
        $vQuery = substr($vQuery, 0, -2);
        if (!array_key_exists($vQuery, $aData)) $aData[$vQuery] = [ $vValue ];
        else                                    $aData[$vQuery][] = $vValue;    // Assuming array here. Might want to verify that first..
      } else {
        if (substr($vQuery, 0, 1) === '[' && substr($vQuery, -1, 1) === ']') $vQuery = intval(substr($vQuery, 1, -1));
        $aData[$vQuery] = $vValue;
      }
    }
  }

  /**
   * @param array   $aData
   * @param string  $vQuery
   * @param int     $nDepth   Internal recursive usage only, do not pass.
   * @param array|null $aSubQueryData Optional. If query contains subqueries that need to be resolved, they will be resolved from this object. If null, will use same data source ($aData).
   * @return mixed
   */
  public static function get($aData, $vQuery, $nDepth = 0, &$aSubQueryData = null) {
    if ($nDepth === 0) {
      $vOriginalQuery = $vQuery;
      $vQuery = self::resolve($aSubQueryData ? $aSubQueryData : $aData, $vQuery);
      if ($vQuery === null) {
        // TODO: Debugpoint.
        echo('<pre>'.json_encode($aData));
        trigger_error('Unresolvable query: one if its sub-queries could not be resolved.', E_USER_WARNING); return(null);
      }
    }

    if (!is_array($aData)) return(null);

    $aLocation = explode('.', $vQuery);
    if (count($aLocation) > 1) {
      $vFirstToken = $aLocation[0];
      $vQuery = implode('.', array_slice($aLocation, 1)); // Subquery after extracting first token.

      if ($vFirstToken === '*' || $vFirstToken === '[]') {

        $aRet = [];
        foreach($aData as $vKey => $vValue)
          $aRet[] = self::get($aData[$vKey], $vQuery, $nDepth+1);
        return($aRet);

      } else {

        if (substr($vFirstToken, 0, 1) === '[' && substr($vFirstToken, -1, 1) === ']') { // Navigation within array
          $vFirstToken = intval(substr($vFirstToken, 1, -1));
          if ($vFirstToken >= count($aData)) return(null);
        } else { // Navigation within object
          if (!array_key_exists($vFirstToken, $aData)) return(null);
        }
        return(self::get($aData[$vFirstToken], $vQuery, $nDepth+1));

      }
    } else { // Final token. Set on current data object reference.
      if (substr($vQuery, 0, 1) === '[' && substr($vQuery, -1, 1) === ']') $vQuery = intval(substr($vQuery, 1, -1));
      return(array_key_exists($vQuery, $aData) ? $aData[$vQuery] : null);
    }
  }

  /**
   * @param array   $aData
   * @param string  $vQuery
   * @param int     $nDepth   Internal recursive usage only, do not pass.
   * @return bool   True on success, false on error and/or non-existence.
   */
  public static function delete(&$aData, $vQuery, $nDepth = 0) {
    if ($nDepth === 0) {
      $vQuery = self::resolve($aData, $vQuery);
      if ($vQuery === null) { trigger_error('Unresolvable query: one if its sub-queries could not be resolved.', E_USER_WARNING); return(false); }
    }
    if (!is_array($aData)) { trigger_error('Invalid object passed: expecting (associative) array.', E_USER_WARNING); return(false); }
    $aLocation = explode('.', $vQuery);
    if (count($aLocation) > 1) {
      $vFirstToken = $aLocation[0];
      $vQuery = implode('.', array_slice($aLocation, 1)); // Subquery after extracting first token.
      if (substr($vFirstToken, 0, 1) === '[' && substr($vFirstToken, -1, 1) === ']') { // Navigation within array
        $vFirstToken = intval(substr($vFirstToken, 1, -1));
        if (count($aData) < $vFirstToken) $aData[$vFirstToken] = [];
        if (!is_array($aData[$vFirstToken])) return(false);
        return(self::delete($aData[$vFirstToken], $vQuery, $nDepth+1));
      } else { // Navigation within object
        if (!array_key_exists($vFirstToken, $aData)) return(false);
        elseif (!is_array($aData[$vFirstToken])) return(false);
        return(self::delete($aData[$vFirstToken], $vQuery, $nDepth+1));
      }
    } else { // Final token. Set on current data object reference.
      if (substr($vQuery, 0, 1) === '[' && substr($vQuery, -1, 1) === ']') { // Array index
        $vQuery = intval(substr($vQuery, 1, -1));
        unset($aData[$vQuery]);
        $aData = array_values($aData);
        return(true);
      } else { // Associative array property
        unset($aData[$vQuery]);
        return(true);
      }
    }
  }

  /**
   * @param array $aData
   * @param string $vQuery
   * @return string|null
   */
  public static function resolve($aData, $vQuery) {
    if (strpos($vQuery, '{') === false) return($vQuery);
    if (preg_match("/{([^{}]+)}/", $vQuery, $aMatch)) {
      $vSubQueryResult = self::get($aData, $aMatch[1], 1);
      if ($vSubQueryResult === null) return(null);
      $vQuery = str_replace($aMatch[0], $vSubQueryResult, $vQuery);
      return(self::resolve($aData, $vQuery)); // Replace all instances of this sub-query with its values, then recursively repeat (for other sub-queries).
    }
    trigger_error("Invalid query: contains a curly opening bracket that does not identify a proper sub-query.", E_USER_WARNING);
    return($vQuery);
  }
}
