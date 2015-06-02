	/*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
	$(document).ready(
		/* This is the function that will get executed after the DOM is fully loaded */
		function () {
			$( ".datepicker" ).datepicker({
			changeMonth: true,//this option for allowing user to select month
			changeYear: true, //this option for allowing user to select from year range
			dateFormat: "yy-mm-dd",
			minDate: "today"
			});
		}
	);
	$(document).ready(
		function () {
			$("#STform").validate({

				
				rules: {
					customer_name: {
						required: true,
						minlength: 3
					},
					site_name: {
						required: true,
						minlength: 3
					},
					site_address_street: {
						required: true,
						minlength: 6
					},
					site_address_suburb: {
						minlength: 2
					},
					site_address_city: {
						required: true,
						minlength: 2
					},
					site_contact_name: {
						required: true,
						minlength: 3
					},
					site_contact_phone: {
						digits: true,
						rangelength: [7,14]
					},
					technician_name: {
						minlength: 2
					},
					job_manager: {
						minlength: 2
					},
					planned_start_date: {
						required: true,
						dateISO: true
					},
					planned_finish_date: {
						required: true,
						dateISO: true
					},
					completion_date: {
						dateISO: true
					},					
					department: {
						range: [1,4]
					},
					priority: {
						range: [1,4]
					},
					status: {
						range: [1,3]
					},
					compliance_certificate_required: {
						range: [1,2]
					},
					compliance_certificate_number: {
						digits: true
					},
					affiliate_job_number: {
						digits: true
					}					
				},
				messages: {
					customer_name: {
						required: "Please Specify Your Name",
						minlength: "Name must be more than 2 characters in length"
					},
					site_name: {
						required: "Please Specify Your Site Name"
					},
					site_address_street: {
						required: "Please Specify Your Address"
					},
					site_contact_name: {
						required: "Please Specify Your Name",
						minlength: "Name must be more than 2 characters in length"
					},
					site_contact_phone: {
						digits: "Only Numbers Please"
					},
					planned_start_date: {
						required: "Please Pick a Date",
						dateISO: "yyyy-mm-dd Format Please"
					},
					planned_finish_date: {
						required: "Please Pick a Date",
						dateISO: "yyyy-mm-dd Format Please"
					},
					completion_date: {
						dateISO: "yyyy-mm-dd Format Please"
					},
					department: {
						range: "please select an option"
					},
					priority: {
						range: "please select an option"
					},
					status: {
						range: "please select an option"
					},
					compliance_certificate_required: {
						range: "please select an option"
					},
					compliance_certificate_number: {
						digits: "Only Numbers Please"
					},
					affiliate_job_number: {
						digits: "Only Numbers Please"
					}		
				}
			});
		}
	);
	
	function showNotes() {
	var ele = document.getElementById("toggleNotes");
	var text = document.getElementById("notes_button");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "show";
		text.value = "Add Note";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide";
		text.value = "Cancel Note Entry";
	}

} 