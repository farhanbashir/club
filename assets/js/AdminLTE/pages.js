/*!
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This file should be included in all pages
 !**/

/*
 * Global variables. If you change any of these vars, don't forget
 * to change the values in the less files!
 */

$(function ($) {
    "use strict";

// edit event
    $('#start_date').datetimepicker({format: 'Y-m-d H:i:s'});
    $('#end_date').datetimepicker({format: 'Y-m-d H:i:s'});
    $('#publish_date').datetimepicker({format: 'Y-m-d H:i:s'});





    $('#multiple_select').select2();

$('input#time_picker').timepicker({ timeFormat: 'h:mm:ss p' });
//    $("#time_picker").timepicker();


}(jQuery));


