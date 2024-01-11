
$(document).ready(function() {
    var id = 1;
    /*Assigning id and class for tr and td tags for separation.*/
    $("#butsend").click(function() {
  
        var newid = id++;
        $("#table1").append('<tr valign="top" id="' + newid + '">\n\
    <td width="100px" class="emp_qual' + newid + '">' + $("#emp_qual_type").val() + '</td>\n\
    <td width="100px" class="emp_cert' + newid + '">' + $("#emp_certificate").val() + '</td>\n\
    <td width="100px" class="emp_inst' + newid + '">' + $("#emp_institution").val() + '</td>\n\
    <td width="100px" class="emp_cert_date' + newid + '">' + $("#emp_cert_year").val() + '</td>\n\
    <td width="100px" class="emp_highest_qual' + newid + '">' + $("emp_highest_qual").val() + '</td>\n\
    <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');
    });
    $("#table1").on('click', '.remCF', function() {
        $(this).parent().parent().remove();
    });
    /*crating new click event for save button*/
    $("#saveEmpDetails").click(function() {
      $("#saveEmpDetails").attr("disabled", "disabled");
        var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
        var qualType = new Array();
        var certificate = new Array();
        var institution = new Array();
        var certYear = new Array();
        var highestQual = new Array();

        for (var i = 1; i <= lastRowId; i++) {
            qualType.push($("#" + i + " .emp_qual" + i).html()); /*pushing all the names listed in the table*/
            certificate.push($("#" + i + " .emp_cert" + i).html());
            institution.push($("#" + i + " .emp_inst" + i).html());
            certYear.push($("#" + i + " .emp_cert_date" + i).html());
            highestQual.push($("#" + i + " .emp_highest_qual" + i).html());

        }
        var sendQual = JSON.stringify(qualType);
        var sendCert = JSON.stringify(certificate);
        var sendInst = JSON.stringify(institution);
        var sendCertDate = JSON.stringify(certYear);
        var sendhighestQual = JSON.stringify(highestQual);
        var firstname = $('#emp_firstname').val();
        var lastname = $('#emp_lastname').val();
        var othernames = $('#emp_othernames').val();
        var phone = $('#emp_phone').val();
        var address = $('#emp_adr').val();
        var empdob = $('#emp_dob').val();
        var gender = $('#emp_gender').val();
        var maritalStatus = $('#emp_marital_status').val();
        var state = $('#state').val();
        var lga = $('#lga').val();
        var empDate = $('#emp_appt_date').val();
        var lastPromo = $('#emp_last_promo_date').val();
        var ministry = $('#emp_ministry').val();
        var dept = $('#emp_dept').val();
        var grade = $('#emp_grade').val();
        var rank = $('#emp_rank').val();
       

        $.ajax({
            url: "/assets/inc/save_emp_info.php",
            type: "post",
            data: { 
              firstname: firstname,
              lastname: lastname,
              othernames: othernames,
              phone: phone,
              address: address,
              empdob: empdob,
              gender: gender,
              maritalStatus: maritalStatus,
              state: state,
              lga: lga,
              empDate: empDate,
              lastPromo: lastPromo,
              ministry: ministry,
              dept: dept,
              grade: grade,
              rank: rank,
              qualType: sendQual , 
              certificate: sendCert,
              institution: sendInst,
              certYear: sendCertDate,
              emp_highestQual: sendhighestQual,
            },
            success: function(dataResult) {
              console.log(dataResult);
              if(dataResult == 1){
                // $("#saveEmpDetails").removeAttr("disabled");
                $("#myModal").modal();
                // $('#msg-success').html('Data saved successfully !');
                window.location.reload(true); 						
              }
              else if(dataResult == 0){
                $("#saveEmpDetails").removeAttr("disabled");
                $("#msg-error").show();
                $('#msg-error').html('Error communicating with database !');
              }
            }
        });
    });
});

$(".collapsed").on('click',
    function() {
      $(this).find("#collapseTwo").slideToggle();
    });

  $(".datepicker").click(function () {
    $(this).datepicker({
        format: "dd-mm-yyyy"
    });

});

function getLga(val) {
  $.ajax({
  type: "POST",
  url: "/assets/inc/getlga.php",
  data:'state='+val,
  success: function(data){
    $("#lga").append(data) ;
    //getCity();
  }
  });
}

 var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("saveEmpDetails").style.display = "inline";
    document.getElementById("nextBtn").style.display = "none";

  } else {
    // document.getElementById("nextBtn").innerHTML = "Next";
    document.getElementById("nextBtn").style.display = "inline";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "" && y[i].name != "emp_othernames") {
      // add an "invalid" class to the field:
      y[i].style.borderColor = 'red';
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

function check_unchecked(isChecked) {
	if(isChecked) {
		$('input[id="employee"]').each(function() { 
			this.checked = true; 
		});
	} else {
		$('input[id="employee"]').each(function() {
			this.checked = false;
		});
	}
} 
function confirmApproveAll()
{
   return confirm("Are you sure you want to Approve All?");
}
function confirmApproveSelected()
{
   return confirm("Are you sure you want to Approve Selected Items?");
}
