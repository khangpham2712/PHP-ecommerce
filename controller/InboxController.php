<?php
class Inbox_Controller
{
    public function getInbox()
    {
        if (!checkAdmin()) {
            header('Location: ../login');
        }
        include_once('include/header.php');

        $inboxList = getInbox();

        include_once("../admin/inbox.php");
        include_once("../include/footer.php");
    }
}
