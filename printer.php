
<?php
 const SNMP_PRINTER_HOSTNAME                       = '.1.3.6.1.2.1.1.5.0';  // working
 const SNMP_PRINTER_MODEL                          = '.1.3.6.1.2.1.25.3.2.1.3.1';
 
 const SNMP_PRINTER_RUNNING_TIME                   = '.1.3.6.1.2.1.1.3.0';  // working 
 const SNMP_PRINTER_SERIAL_NUMBER                  = '.1.3.6.1.2.1.43.5.1.1.17.1';  // working
 const SNMP_PRINTER_VENDOR_NAME                    = '.1.3.6.1.2.1.43.9.2.1.8';  // not working
 const SNMP_NUMBER_OF_PRINTED_PAPERS               = '.1.3.6.1.2.1.43.10.2.1.4.1.1'; // working

 const SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOTS     = '.1.3.6.1.2.1.43.11.1.1.8.1'; // not working
 const SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOT_1    = '.1.3.6.1.2.1.43.11.1.1.8.1.1';
 const SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOT_2    = '.1.3.6.1.2.1.43.11.1.1.8.1.2';
 const SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOT_3    = '.1.3.6.1.2.1.43.11.1.1.8.1.3';
 const SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOT_4    = '.1.3.6.1.2.1.43.11.1.1.8.1.4';
 const SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOT_5    = '.1.3.6.1.2.1.43.11.1.1.8.1.5';

 const SNMP_MARKER_SUPPLIES_ACTUAL_CAPACITY_SLOTS  = '.1.3.6.1.2.1.43.11.1.1.9.1';
 const SNMP_MARKER_SUPPLIES_ACTUAL_CAPACITY_SLOT_1 = '.1.3.6.1.2.1.43.11.1.1.9.1.1'; // working
 const SNMP_MARKER_SUPPLIES_ACTUAL_CAPACITY_SLOT_2 = '.1.3.6.1.2.1.43.11.1.1.9.1.2';
 const SNMP_MARKER_SUPPLIES_ACTUAL_CAPACITY_SLOT_3 = '.1.3.6.1.2.1.43.11.1.1.9.1.3';
 const SNMP_MARKER_SUPPLIES_ACTUAL_CAPACITY_SLOT_4 = '.1.3.6.1.2.1.43.11.1.1.9.1.4';
 const SNMP_MARKER_SUPPLIES_ACTUAL_CAPACITY_SLOT_5 = '.1.3.6.1.2.1.43.11.1.1.9.1.5';

 const SNMP_SUB_UNIT_TYPE_SLOTS                    = '.1.3.6.1.2.1.43.11.1.1.6.1';
 const SNMP_SUB_UNIT_TYPE_SLOT_1                   = '.1.3.6.1.2.1.43.11.1.1.6.1.1'; // working
 const SNMP_SUB_UNIT_TYPE_SLOT_2                   = '.1.3.6.1.2.1.43.11.1.1.6.1.2'; // working
 const SNMP_SUB_UNIT_TYPE_SLOT_3                   = '.1.3.6.1.2.1.43.11.1.1.6.1.3'; // working
 const SNMP_SUB_UNIT_TYPE_SLOT_4                   = '.1.3.6.1.2.1.43.11.1.1.6.1.4'; // working

 const SNMP_CARTRIDGE_COLOR_SLOT_1                 = '.1.3.6.1.2.1.43.12.1.1.4.1.1'; // working
 const SNMP_CARTRIDGE_COLOR_SLOT_2                 = '.1.3.6.1.2.1.43.12.1.1.4.1.2'; // working
 const SNMP_CARTRIDGE_COLOR_SLOT_3                 = '.1.3.6.1.2.1.43.12.1.1.4.1.3'; // working
 const SNMP_CARTRIDGE_COLOR_SLOT_4                 = '.1.3.6.1.2.1.43.12.1.1.4.1.4'; // working

// $objectID = SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOT_1;
$ip = "10.132.244.36";

 function gethost($ip){
 
 $result = snmpget($ip, "public", SNMP_PRINTER_HOSTNAME, 150);
 
 return $result;
 }
 
 function getModel($ip){
 
 $model = snmpget($ip, "public", SNMP_PRINTER_MODEL, 50);
 
 return $model;
 }
 
 
 function getBlackStatus($ip)
 {
 $actual_value = snmpget($ip, "public", SNMP_MARKER_SUPPLIES_ACTUAL_CAPACITY_SLOT_1, 50);
 $max_value = snmpget($ip, "public", SNMP_MARKER_SUPPLIES_MAX_CAPACITY_SLOT_1, 50);
 
 if ((int) $actual_value <= 0)
 {
 return false;
 }
 else
 {
 return ($actual_value / ($max_value / 100));
 }
 }
 
 function output($result){
 
 return str_replace('"', "", substr($result, 8));
 }
 
//echo snmpget("10.132.244.36", "public", $objectID, 50);
echo output(getHost($ip)) . "<br/>"; // STRING: "BRT-P0011"
echo output(getModel($ip)) . "<br/>"; // STRING: "HP LaserJet 400 color M451dn"
echo output(getBlackStatus($ip));

?>
