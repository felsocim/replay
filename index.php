<?php

require_once 'shared/config.php';
require_once 'shared/functions.php';
require_once 'models/Kernel.php';

try {
    $oci = new PDO(OCI_DNS, OCI_USER, OCI_PASSWORD);
    $oci->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
} catch (PDOException $exception) {
    //Error log entry
}

Kernel::setConnection($oci);

session_start();
ob_start();

require_once 'controllers/Controller_Category.php';
$ccat = new Controller_Category();
$ccat->generateMenu();

if(!isset($_SERVER['PATH_INFO']))
{
    require_once 'controllers/Controller_Video.php';
    $cvideo = new Controller_Video();
    $cvideo->all();
}
else
{
    $argv = explode('/', $_SERVER['PATH_INFO']);
    $argc = count($argv);

    if($argc >= 3)
    {
        $controller = 'Controller_'.ucfirst($argv[1]);
        $method = $argv[2];
        $arguments = array();
        for($i = 3;$i < $argc;$i++)
        {
            array_push($arguments, $argv[$i]);
        }

        if(is_file('controllers/'.$controller.'.php'))
        {
            require_once 'controllers/'.$controller.'.php';

            if(class_exists($controller))
            {
                $ctrl = new $controller;

                if(method_exists($ctrl, $method))
                {
                    call_user_func_array(array($ctrl, $method), $arguments);
                }
            }
        }
    }
}

$content = ob_get_clean();

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>replay</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo HOME ?>/res/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="<?php echo HOME ?>/res/css/front-end.css" type="text/css">
    <link rel="stylesheet" href="<?php echo HOME ?>/res/js/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css">
    <script src="<?php echo HOME ?>/res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo HOME ?>/res/js/jquery-ui-1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo HOME ?>/res/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>

<?php
    echo $content;
?>

</body>
</html>