<?php if(!defined('HDPHP_PATH'))exit;
return array (
  '/^list-(\\d+).html$/' => 'm=Index&c=Category&a=index&cid=#1',
  '/^list-(\\d+)-(\\d+).html$/' => 'm=Index&c=Category&a=index&cid=#1&page=#2',
  '/^article-(\\d+)-(\\d+).html$/' => 'm=Index&c=Content&a=index&cid=#1&aid=#2',
);
?>