<?php
session_start();
$path = pathinfo($_SERVER['PHP_SELF']);
$HOMEDIR = $path['dirname'];

if($pageType == "reserved" && empty($_SESSION["user"])){
	header("Location: ".$HOMEDIR."/areaRiservata/");
}
if($pageType == "access" && !empty($_SESSION["user"])){
	header("Location: ".$HOMEDIR."/amministrazione/home/");
}
if(!isset($pageType) && empty($pageType)){
	header("Location: ".$HOMEDIR."/home/");
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle." - Mapple"; ?></title>
<meta name="title" content="<?php echo $pageTitle." - Mapple"; ?>" />
<meta name="description" content="<?php echo $pageDescription; ?>" />
<meta name="keywords" content="<?php echo $pageKeywords; ?>" />
<meta name="language" content="italian it" />
<meta name="author" content="Mapple" />

<link rel="stylesheet" type="text/css" href="<?php echo $HOMEDIR; ?>/css/style.css" media="screen"/>

<link rel="stylesheet" type="text/css" href="<?php echo $HOMEDIR; ?>/css/print.css" media="print"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


<link rel="icon" type="image/png" href="<?php echo $HOMEDIR; ?>/logo/Mapple_gear_logo.png" >
<link rel="apple-touch-icon" href="<?php echo $HOMEDIR; ?>/logo/Mapple_gear_logo.png">
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta name="msapplication-TileImage" content="<?php echo $HOMEDIR; ?>/logo/Mapple gear logo.png">	

</head>
