<?php

include("base/MySQLParser.php");

$metaData['levelDefinitions'] = MySQLParser::ParseDictionary("LevelDefinition", "levelNumber");
$metaData['enemyDefinitions'] = MySQLParser::ParseDictionary("EnemyDefinition", "name");
$metaData['mapBackgroundDefinitions'] = MySQLParser::ParseArray("MapBackgroundDefinition");
$metaData['mapNodeDefinitions'] = MySQLParser::ParseDictionary("MapNodeDefinition", "regionNumber");
$metaData['weaponDefinitions'] = MySQLParser::ParseDictionary("WeaponDefinition", "name");
$metaData['abilityDefinitions'] = MySQLParser::ParseDictionary("AbilityDefinition", "name");
$metaData['constants'] = MySQLParser::ParseConstants();

$result['metaData'] = $metaData;
$encoded = json_encode($result);
exit($encoded);
?>