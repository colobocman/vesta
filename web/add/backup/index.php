<?php
// Init
error_reporting(NULL);
ob_start();
session_start();
include($_SERVER['DOCUMENT_ROOT']."/inc/main.php");

$v_username = escapeshellarg($user);
exec (VESTA_CMD."v-add-user-backup ".$v_username, $output, $return_var);
if ($return_var == 0) {
    $_SESSION['backup_msg'] = _('BACKUP_SCHEDULED');
} else {
    $_SESSION['backup_msg'] = implode('<br>', $output);
    if (empty($_SESSION['backup_msg'])) {
        $_SESSION['backup_msg'] = _('Error: vesta did not return any output.');
    }

    if ($return_var == 4) {
        $_SESSION['backup_msg'] = _('BACKUP_EXISTS');
    }

}
unset($output);
header("Location: /list/backup/");
exit;
