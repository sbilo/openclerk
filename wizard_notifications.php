<?php

/**
 * This page is the fourth page in a series of wizards to configure e-mail notifications.
 * A user may revisit this page at any time to reconfigure their notifications.
 */

require(__DIR__ . "/inc/global.php");
require_login();

require(__DIR__ . "/layout/templates.php");
page_header("Notification Preferences", "page_wizard_notifications", array('jquery' => true, 'js' => array('common', 'wizard', 'notifications'), 'class' => 'page_accounts'));

$user = get_user(user_id());
require_user($user);

$messages = array();

// get all of our accounts
$accounts = user_limits_summary(user_id());

// get all of our notifications
$q = db()->prepare("SELECT * FROM notifications WHERE user_id=? ORDER BY id ASC");
$q->execute(array(user_id()));
$notifications = $q->fetchAll();

// are we editing one?
$instance = false;
$account = false;
if (require_get("edit", false)) {
	$q = db()->prepare("SELECT * FROM notifications WHERE id=? AND user_id=?");
	$q->execute(array(require_get("edit"), user_id()));
	$instance = $q->fetch();
	if (!$instance) {
		$errors[] = "Could not find your notification " . htmlspecialchars(require_get("edit")) . " to edit.";
	}

	switch ($instance['notification_type']) {
		case "ticker":
			$q = db()->prepare("SELECT * FROM notifications_ticker WHERE id=?");
			$q->execute(array($instance['type_id']));
			$account = $q->fetch();
			// if false, we can still display default editing options
			break;

		default:
			throw new Exception("Unknown notification type to edit '" . $notification['notification_type'] . "'");
	}
}

require_template("wizard_notifications");

?>

<div class="wizard">

<?php
/**
 * We use Javascript to update the list of notifications, so that it is easy to edit them and we don't
 * have to write the same interface twice.
 */
?>
<script type="text/javascript">
function get_supported_notifications() {
	return <?php
		// get a list of all possible notifications
		$supported_notifications = array(
			'exchanges' => array(),
		);
		$supported_exchange_currencies = array();

		// all the exchanges we may be interested in
		require(__DIR__ . "/graphs/util.php");
		$summaries = get_all_summary_currencies();
		foreach (get_exchange_pairs() as $exchange => $pairs) {
			foreach ($pairs as $pair) {
				if (isset($summaries[$pair[0]]) && isset($summaries[$pair[1]])) {
					if (!isset($supported_notifications['exchanges'][$exchange])) {
						$supported_notifications['exchanges'][$exchange] = array();
					}
					$supported_notifications['exchanges'][$exchange][] = $pair;
					$supported_exchange_currencies[$pair[0] . $pair[1]] = get_currency_abbr($pair[0]) . "/" . get_currency_abbr($pair[1]);
				}
			}
		}

		echo json_encode($supported_notifications);
		?>;
}
</script>

TODO check that emails are configured correctly.
TODO add clock/event/value icons for each row of notification icons

<?php if ($instance) { ?>
<h2>Edit Notification</h2>
<?php } else { ?>
<h2>Add New Notification</h2>
<?php } ?>

<form action="<?php echo htmlspecialchars(url_for('wizard_notifications_post')); ?>" method="post">
<table class="notification_template<?php echo $instance ? " selected" : ""; ?>">
<tr>
	<td>
	<span class="email_notification">Please send me an e-mail when</span>
	<select id="notification_type" name="type">
		<option value="ticker"<?php echo ($instance && $instance['notification_type'] == 'ticker') ? " selected" : ""; ?>>the exchange rate</option>
		<option value="summary_instance_total"<?php echo ($instance && $instance['notification_type'] == 'summary_instance') ? " selected" : ""; ?>>my total</option>
	</select>

	<ul>
		<li class="exchanges">
			on
			<select id="notification_exchanges" name="exchange">
				<?php foreach ($supported_notifications['exchanges'] as $exchange => $pairs) { ?>
					<option value="<?php echo htmlspecialchars($exchange); ?>"<?php echo $account && $account['exchange'] == $exchange ? " selected" : ""; ?>><?php echo htmlspecialchars(get_exchange_name($exchange)); ?></option>
				<?php } ?>
			</select>

			for
			<select id="notification_currencies" name="currencies">
				<?php foreach ($supported_exchange_currencies as $key => $value) {
					$selected = isset($account['currency1']) && isset($account['currency2']) && ($account['currency1'] . $account['currency2']) == $key; ?>
					<option value="<?php echo htmlspecialchars($key); ?>"<?php echo $selected ? " selected" : ""; ?>><?php echo htmlspecialchars($value); ?></option>
				<?php } ?>
			</select>
		</li>

		<li class="condition">
			<select id="notification_condition" name="condition">
				<?php
				$options = array(
					'increases_by' => "increases by",
					'increases' => "increases",
					'above' => "above",
				);
				foreach ($options as $key => $value) { ?>
				<option value="<?php echo htmlspecialchars($key); ?>"<?php echo $instance && $instance['trigger_condition'] == $key ? " selected" : ""; ?>><?php echo htmlspecialchars($value); ?></option>
				<?php } ?>
			</select>

			<span class="notification_value">
				<input type="text" name="value" value="1">

				<span class="notification_percent_on">
				<select id="notification_percent" name="percent">
					<option value="0" class="value_label"<?php echo $instance && $instance['is_percent'] ? "" : " selected"; ?>>USD/BTC</option>
					<option value="1"<?php echo $instance && $instance['is_percent'] ? " selected" : ""; ?>>%</option>
				</select>
				</span>
				<span class="notification_percent_off value_label">USD/BTC</span>
			</span>
		</li>

		<li class="period">
			within
			<select id="notification_period" name="period">
				<?php
				foreach (get_permitted_notification_periods() as $key => $value) { ?>
				<option value="<?php echo htmlspecialchars($key); ?>"<?php echo $instance && $instance['period'] == $key ? " selected" : ""; ?>><?php echo htmlspecialchars($value['label']); ?></option>
				<?php } ?>
			</select>
		</li>
	</ul>

	</td>
</tr>
<tr>
	<td class="buttons">
		<?php if ($instance) { ?>
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($instance['id']); ?>">
		<input type="submit" name="save" value="Save Notification" class="save">
		<input type="submit" name="cancel" value="Cancel Edit" class="cancel">
		<?php } else { ?>
		<input type="submit" name="add" value="Create Notification" class="create">
		<?php } ?>
	</td>
</tr>
</table>
</form>

<hr>

<h2>Configured Notifications</h2>

<table class="standard standard_account_list">
<thead>
	<tr>
		<th>Notification</th>
		<th>Period</th>
		<th>Last notification</th>
		<th></th>
	</tr>
</thead>
<tbody>
<?php
$count = 0;
foreach ($notifications as $notification) {
	switch ($notification['notification_type']) {
		case "ticker":
			$q = db()->prepare("SELECT * FROM notifications_ticker WHERE id=? LIMIT 1");
			$q->execute(array($notification['type_id']));
			$account = $q->fetch();
			if (!$account) {
				throw new Exception("Could not find account '" . $notification['notification_type'] . "' for notification " . $notification['id']);
			}

			$account_text = "Exchange rate on " . get_exchange_name($account['exchange']) . " for " .
				get_currency_abbr($account['currency1']) . "/" . get_currency_abbr($account['currency2']);
			$value_label = get_currency_abbr($account['currency1']) . "/" . get_currency_abbr($account['currency2']);

			break;

		default:
			throw new Exception("Unknown notification type '" . $notification['notification_type'] . "'");
	}

	switch ($notification['trigger_condition']) {
		case "increases":
			$trigger_text = "increases";
			break;

		case "increases_by":
			$trigger_text = "increases by " . number_format_autoprecision_html($notification['trigger_value'], $notification['is_percent'] ? '%' : (' ' . $value_label));
			break;

		case "above":
			$trigger_text = "is above " . number_format_autoprecision_html($notification['trigger_value'], " " . $value_label);
			break;

		default:
			throw new Exception("Unknown notification trigger '" . $notification['trigger_condition'] . "'");
	}

?>
	<tr class="<?php echo ++$count % 2 == 0 ? "odd" : "even"; ?><?php echo ($instance && $instance['id'] == $notification['id']) ? " selected" : ""; ?>">
		<td><span class="email_notification"><?php echo $account_text . " " . $trigger_text; ?></span></td>
		<td><?php $notification_periods = get_permitted_notification_periods();
			echo $notification_periods[$notification['period']]['title']; ?></td>
		<td><?php echo recent_format_html($notification['last_notification']); ?></td>
		<td class="buttons">
			<form action="<?php echo htmlspecialchars(url_for('wizard_notifications')); ?>" method="get">
				<input type="hidden" name="edit" value="<?php echo htmlspecialchars($notification['id']); ?>">
				<input type="submit" value="Edit" class="edit">
			</form>
			<form action="<?php echo htmlspecialchars(url_for('wizard_notifications_post')); ?>" method="post">
				<input type="hidden" name="id" value="<?php echo htmlspecialchars($notification['id']); ?>">
				<input type="submit" name="delete" value="Delete" class="delete" onclick="return confirm('Are you sure you want to remove this notification?');">
			</form>
		</td>
	</tr>
<?php } ?>
</tbody>
</table>

<div style="clear:both;"></div>

<div class="wizard-buttons">
<a class="button" href="<?php echo htmlspecialchars(url_for('wizard_accounts')); ?>">&lt; Previous</a>
<input type="submit" name="submit" value="Next &gt;">
</div>
</div>

<?php

require_template("wizard_notifications_footer");

page_footer();
