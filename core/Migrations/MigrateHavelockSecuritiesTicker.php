<?php

namespace Core\Migrations;

/**
 * Migrates ticker data for `securities_havelock` to `securities_ticker`
 * (we ignore `securities_ticker_recent` because this can be updated later by jobs)
 */
class MigrateHavelockSecuritiesTicker extends \Db\Migration {

  function getParents() {
    return array_merge(parent::getParents(),
      array(new SecurityTicker()));
  }

  /**
   * Apply only the current migration.
   * @return true on success or false on failure
   */
  function apply(\Db\Connection $db) {
    $q = $db->prepare("INSERT INTO security_ticker (exchange, security, created_at, last_trade, is_daily_data, created_at_day)
      (SELECT 'havelock' as exchange, j.name AS security, b.created_at, b.balance as last_trade, is_daily_data, created_at_day
        FROM balances AS b
        JOIN securities_havelock AS j ON b.exchange='securities_havelock' AND b.account_id=j.id
        WHERE b.exchange='securities_havelock')");
    if (!$q->execute()) {
      throw new \Exception("Could not migrate ticker data from balances to security_ticker");
    }

    // then delete the old data
    $q = $db->prepare("DELETE FROM balances WHERE exchange='securities_havelock'");
    if (!$q->execute()) {
      throw new \Exception("Could not delete balances data for 'securities_havelock'");
    }

    return true;
  }

}