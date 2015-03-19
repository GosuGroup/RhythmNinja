<?php

include("base/MySQLParser.php");

$metaData['levelDefinitions'] = MySQLParser::ParseDictionary("LevelDefinition", "levelNumber");
$metaData['enemyDefinitions'] = MySQLParser::ParseDictionary("EnemyDefinition", "name");
$metaData['mapBackgroundDefinitions'] = MySQLParser::ParseDictionary("MapBackgroundDefinition", "regionNumber");
$metaData['mapNodeDefinitions'] = MySQLParser::ParseDictionary("MapNodeDefinition", "regionNumber");
$metaData['weaponDefinitions'] = MySQLParser::ParseDictionary("WeaponDefinition", "name");
$metaData['abilityDefinitions'] = MySQLParser::ParseDictionary("AbilityDefinition", "name");

$result['metaData'] = $metaData;
$encoded = json_encode($result);
exit($encoded);
?>