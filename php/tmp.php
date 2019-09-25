#!/usr/bin/env php
<?php
namespace _24k;
require_once "io.php";
require_once "kstring.php";

$ks = new kstring("kstring");
$ks->dump();

$ks->append(" hello");
$ks->dump();

$ks->push_back(",");
$ks->dump();

$ks->append(" hello");
$ks->dump();

$ks->push_back(",");
$ks->dump();

?>
