<?php

include("base/MySQLParser.php");

$metaData['levelDefinitions'] = MySQLParser::ParseDictionary("LevelDefinition", "levelNumber");
$metaData['enemyDefinitions'] = MySQLParser::ParseDictionary("EnemyDefinition", "name");
$metaData['weaponDefinitions'] = MySQLParser::ParseDictionary("WeaponDefinition", "name");
$metaData['abilityDefinitions'] = MySQLParser::ParseDictionary("AbilityDefinition", "name");

$metaData['userLevels'] = MySQLParser::ParseArray("UserLevel");
$metaData['mapBackgroundDefinitions'] = MySQLParser::ParseArray("MapBackgroundDefinition");
$metaData['mapNodeDefinitions'] = MySQLParser::ParseArray("MapNodeDefinition");

$metaData['constants'] = MySQLParser::ParseConstants();

$result['metaData'] = $metaData;
$encoded = json_encode($result);
exit($encoded);
?>