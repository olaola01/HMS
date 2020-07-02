<?php
include "../vendor/autoload.php";
include "../src/initialize.php";

use Src\helper\Path;

// Log out the user
$admin_session->logout();

Path::redirect_to(Path::url_for('admin/index.php'));

?>