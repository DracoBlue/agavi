<?php

/**
 * Data file for timezone "Africa/Malabo".
 * Compiled from olson file "africa", version 8.30.
 *
 * @package    agavi
 * @subpackage translation
 *
 * @copyright  Authors
 * @copyright  The Agavi Project
 *
 * @since      0.11.0
 *
 * @version    $Id$
 */

return array (
  'types' => 
  array (
    0 => 
    array (
      'rawOffset' => 0,
      'dstOffset' => 0,
      'name' => 'GMT',
    ),
    1 => 
    array (
      'rawOffset' => 3600,
      'dstOffset' => 0,
      'name' => 'WAT',
    ),
  ),
  'rules' => 
  array (
    0 => 
    array (
      'time' => -1830386108,
      'type' => 0,
    ),
    1 => 
    array (
      'time' => -190857600,
      'type' => 1,
    ),
  ),
  'finalRule' => 
  array (
    'type' => 'static',
    'name' => 'WAT',
    'offset' => 3600,
    'startYear' => 1964,
  ),
  'source' => 'africa',
  'version' => '8.30',
  'name' => 'Africa/Malabo',
);

?>