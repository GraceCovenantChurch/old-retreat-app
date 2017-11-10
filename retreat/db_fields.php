<?php
$fields = array(
  'fname' => array("name" => 'fname',
	"desc" => 'Name',
	"type" => 'text',
	"extra" => array("size" => 16, "maxlength" => 31)
    ),
  array("name" => 'lname',
	"desc" => 'Last Name',
	"type" => 'text',
	"join" => ' &nbsp;',
	"extra" => array("size" => 16, "maxlength" => 31)
    ),
  array("name" => 'pass1',
	"desc" => 'Password',
	"type" => 'password',
	"extra" => array("size" => 16, "maxlength" => 31)
    ),	
  array("name" => 'pass2',
	"desc" => 'Password (again)',
	"type" => 'password',
	"join" => ' Again: &nbsp;',
	"extra" => array("size" => 16, "maxlength" => 31)
    ),	
  array("name" => 'gender',
	"desc" => 'Gender',
	"type" => 'select_num',
	"extra" => array(" " => '', "Male" => 1, "Female" => 2)
    ),
  array("name" => 'email',
	"desc" => 'Email Address',
	"type" => 'text',
	"extra" => array("size" => 24, "maxlength" => 50)
    ),
  array("name" => 'cphone',
	"desc" => 'Cell Phone',
	"type" => 'text',
	"extra" => array("size" => 12, "maxlength" => 14)
    ),
  array("name" => 'class',
	"desc" => 'Class',
	"type" => 'select',
	"extra" => array(" " => '', "2017" => 2017, "2018" => 2018, "2019" => 2019, "2020" => 2020, "Other" => 'other')
    ),
  array("name" => 'school',
	"desc" => 'School',
	"type" => 'select',
	"extra" => array(" " => '', "Bryn Mawr" => 'BRY', "Drexel" => 'DRE', "EasternU" => 'EAS', "Haverford" => 'HAV', "Moore" => 'MOR', "PAFA" => 'PAF', "Swarthmore" => 'SWT',  "Temple" => 'TEM', "UPenn" => 'PEN', "USciences" => 'USP', "Villanova" => 'NOV', "Other" => 'OTH')
    ),
  );

$admin_only_fields =  array(
    array("name"=> 'Comments',
        "desc" => 'Comments',
         "type" => 'text',
         "extra" => array("size" => 50, "maxlength" => 255)
    ),
    array("name" => 'roomnumber',
        "desc" => 'Room Number',
        "type" => 'text',
        "extra" => array("size" => 16, "maxlength" => 31)
    ),
    array("name" => 'sg',
        "desc" => 'Small Group',
        "type" => 'text',
        "extra" => array("size" => 10, "maxlength" => 10)
    ),
    array("name" => 'sgleader',
        "desc" => 'Small Group Leader',
        "type" => 'select',
        "extra" => array("N" => 0, "Y" => 1)
    ),
    array("name"=> 'transpo_to',
        "desc" => 'Transpo To',
         "type" => 'text',
         "extra" => array("size" => 16, "maxlength" => 31)
    ),
    array("name"=> 'transpo_back',
        "desc" => 'Transpo Back',
         "type" => 'text',
         "extra" => array("size" => 16, "maxlength" => 31)
    )
);

$edit_fields = array_merge($fields, $admin_only_fields);

?>
