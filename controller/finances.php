<?php

require_once 'include/db_connection.inc';
require 'variables.php';

if($user == null)
{
    header('Location: index.php?action=register' . $error);
}