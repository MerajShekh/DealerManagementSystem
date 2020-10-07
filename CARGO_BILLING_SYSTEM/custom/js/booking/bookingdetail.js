$(document).ready(function(){

$("input, select").click(function(){
   $(this).addClass("bgchange");
    })

 $("input, select").on('blur',function(){
 $(this).removeClass("bgchange");
 })


 var bookingno = $("#booking_no").val();
fetchFinancier()
 searchableCombobox();
 // fetch customer detail by customerID
 fetchPayment(); // Price function

 fetchBooking(bookingno);
fetchData(); // Booking Data
    function fetchBooking(bookingno){
        $.ajax({
            url: "../php_action/booking.php",
            method: "POST",
            data: {fetchbookings:bookingno},
            datatype:"JSON",
            success:function(data,status){
                var fetcheddata = $.parseJSON(data);// decode JSON data----->
                $("#model_category").val(fetcheddata.Model_Category);
                $("#model_name").html('<option value="'+fetcheddata.Model_Name+'">'+fetcheddata.Model_Name+'</option>');
                $("#model_variant").html('<option value="'+fetcheddata.Model_Variant+'">'+fetcheddata.Model_Variant+'</option>');
                $("#booking_date").val(fetcheddata.Enquiry_Date);
                $("#status").val(fetcheddata.Booking_Status);
                $("#first_name").val(fetcheddata.First_Name);
                $("#purchase_type").val(fetcheddata.Purchase_Type);
                $("#financier").val(fetcheddata.F_Id);
                $("#finance_amount").val(fetcheddata.Finance_Amount);
                $("#middle_name").val(fetcheddata.Middle_Name);
                $("#stage").html('<option value="'+fetcheddata.Stage+'">'+fetcheddata.Stage+'</option>');
                $("#last_name").val(fetcheddata.Last_Name);
                $("#remark").val(fetcheddata.Remark);

                $("#expected_date").val(fetcheddata.Expected_Date);
                $("#expected_reason").val(fetcheddata.Expected_Reason);
                $("#booking_total").val(fetcheddata.Booking_Ex_Price);
                $("#balance_payment").val(Math.round($("#total_payment").val()-fetcheddata.Booking_Ex_Price));
                if (fetcheddata.Purchase_Type=='Cash') {
                  $("#financier,#finance_amount, #FinanceApprove").prop('disabled',true);
                }
                if(fetcheddata.Finance_Approve==1){
                  $("#FinanceApprove").prop('checked',true);
                }
            }

        }) // End ajax method------------->
    } // End of fetchBooking Function----->

$("#lineItemTab").click(function(){
    // fetchData();
    $("#getPrice").click();
})

// <--------------- Booking Home Page  ------------------>
$("#searchBookingDate").datepicker();
$.ajax({
            url: "../php_action/fetchdata.php",
            method: "POST",
            datatype:"JSON",
            data: {fetchRecentBooking:""},
            success:function(data,status){
                $("#recentBooking").html(data);
            }
        });



function fetchFinancier(){
  var html = '<option value=""></option>';
  $.ajax({
            url: "../php_action/fetchdata.php",
            method: "POST",
            datatype:"JSON",
            data: {fetchAllFinancier:""},
            success:function(data,status){
                // alert(data);
                var financiers = $.parseJSON(data);
              $.each(financiers, function(key, value){
                  html += '<option value="'+value.F_Id+'">'+value.F_Name+'</option>';
                })
                $("#financier").html(html);
            }
        })
 }

function fetchData(){
    $.ajax({
        url: "../php_action/booking.php",
        method: "POST",
        data: {fetchcustomerdetail:bookingno},
        datatype:"JSON",
        success:function(data,status){
        var fetcheddata = $.parseJSON(data);// decode JSON data----->
            $.each(fetcheddata, function(key,value){
                    var product = value.Model_Code+value.Model_Type+value.Color_Code;
                    $("#lineItemProduct").val(product);
                    $("#lineItemModelCategory").val(value.Model_Category);
                    $("#lineItemModelName").val(value.Model_Name);
                    $("#lineItemModelVariant").val(value.Model_Variant);
                    $("#lineItemExShowroom").val(value.Booking_Ex_Price);
                    $("#lineItemHypothecation").val(value.Hypothecation_Charge);
                    $("#lineItemInsurance").val(value.Insurance_Charge);
                    $("#lineItemTax").val(value.Road_Tax);
                    $("#lineItemDiscount").val(value.Booking_Discount_Value);
                    $("#lineItemBillingPrice").val(value.Booking_Basic_Price);
                    $("#lineItemTaxable").val(value.Booking_Taxable_Price);
                    $("#lineItemCGSTRate").val(value.Booking_CGST_Rate);
                    $("#lineItemCGSTValue").val(value.Booking_CGST_Value);
                    $("#lineItemSGSTRate").val(value.Booking_SGST_Rate);
                    $("#lineItemSGSTValue").val(value.Booking_SGST_Value);
                    $("#frameallotProduct").val(value.Model_Code+value.Model_Type+value.Color_Code);
                    $("#frameallotModelCategory").val(value.Model_Category);
                    $("#frameallotModelName").val(value.Model_Name);
                    $("#frameallotModelVariant").val(value.Model_Variant);
                    $("#frameallotProductDesc").val(value.Model_Variant+" "+value.Color_Name);
                    $("#frameallotFrame").val(value.Frame_No);
                    $("#frameallotEngine").val(value.Engine_No);
                    if (value.Frame) {
                      $("#deAllocateFrame").show();
                      $("#frameallotFrame").prop('disabled',true);
                    }else{
                      $("#deAllocateFrame").hide();
                      $("#frameallotFrame").prop('disabled',false);
                    }
                }) // End of Each Function
        genCustomerDetailGrid(fetcheddata);
        // genInvoiceGrid(fetcheddata);
        
      }
    })
}
// fetch Invoice data
fetchInvoiceData();
function fetchInvoiceData(){
  $.ajax({
        url: "../php_action/fetchdata.php",
        method: "POST",
        data: {fetchinvoicedata:bookingno},
        datatype:"JSON",
        success:function(data,status){
          // alert(data);
        var fetcheddata = $.parseJSON(data);// decode JSON data----->
            $.each(fetcheddata, function(key,value){
                    var product = value.Model_Code+value.Model_Type+value.Color_Code;
                    
                }) // End of Each Function
        genInvoiceGrid(fetcheddata);
      }
    })
}

$("#getPrice").click(function(){
    var product = $("#lineItemProduct").val();
    
    // alert(discount);
    $.ajax({
        url: "../php_action/booking.php",
        method: "POST",
        data: {getPrice:product},
        datatype:"JSON",
        success:function(data,status){
        var fetcheddata = $.parseJSON(data);// decode JSON data----->
        // alert(data);
        $.each(fetcheddata,function(key,value){
            $("#lineItemBillingPrice").val(value.Basic_Price);
            $("#lineItemCGSTRate").val(value.CGST_Rate);
            $("#lineItemCGSTValue").val(value.CGST_Value);
            $("#lineItemSGSTRate").val(value.SGST_Rate);
            $("#lineItemSGSTValue").val(value.SGST_Value);
            var discount = $("#lineItemDiscount").val();
            var billingprice = $("#lineItemBillingPrice").val();
            
            if (discount > billingprice) {
                alert("Discount is more than Billing Price");
            }else{
                $("#lineItemTaxable").val(billingprice-discount);
                var taxable = parseInt($("#lineItemTaxable").val());
                $("#lineItemCGSTValue").val(taxable*14/100);
                $("#lineItemSGSTValue").val(taxable*14/100);
                $("#lineItemExShowroom").val((taxable*128/100));
            }
        });
       
      }
    })
        
});
// input only numeric value
$("#lineItemTax,#finance_amount,#inputPaymentAmount, #lineItemHypothecation, #lineItemInsurance, #lineItemDiscount").on('input', function(){
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});

// input only a-z value
$("#inputBranchName, #inputBankName").on('input', function(){
    $(this).val($(this).val().replace(/[^a-z A-Z]/g, ''));
});

// When New Enquiry Model shown 
$("#addPaymentModal").on('shown.bs.modal', function(){
  $("#inputChequeNo, #inputBankName, #inputBranchName").prop("disabled",true);
//Event on Paymetn Type change
$("#inputPaymentType").change(function(){
    var value = this.value;
    if (value =="Cash") {
        $("#inputChequeNo, #inputBankName, #inputBranchName").prop("disabled",true);
    }else{
      $("#inputChequeNo, #inputBankName, #inputBranchName").prop("disabled",false);
    }
  });
});

function addPayment(){
    var formData = $("#addPaymentForm").serialize();
    $.ajax({
        url: "../php_action/booking.php",
        method:'POST',
        datatype:'JSON',
        data:formData,
        success: function(data,status){
            // alert(data);
            fetchPayment();
        }

    })
}

function fetchPayment(){
    $.ajax({
        url: "../php_action/booking.php",
        method:'POST',
        datatype:'JSON',
        data:{fetchPayments:bookingno},
        success: function(data,status){
          var fetcheddata = $.parseJSON(data);
          var totapaid=0;
            genPaymentGrid(fetcheddata);
            // alert(data);
            $.each(fetcheddata,function(key,value){
              totapaid += parseInt(value.Payment_Amount);
              $("#total_payment").val(totapaid);
              fetchBooking(bookingno);
            });
        }

    })
}
// Check invoice against booking
checkInvoiceisCreated();
function checkInvoiceisCreated(){
    $.ajax({
        url: "../php_action/fetchdata.php",
        method:'POST',
        datatype:'JSON',
        data:{checkinvoiceiscreated:bookingno},
        success: function(data,status){
          var d = $.parseJSON(data);
          if (d==1) {
            $("#createNewInvoice, #getPrice, #addNewPayment, #saveLineItem").prop('disabled',true).css('background','none').css('border','none');
            $("#expected_date,#expected_reason").prop('disabled',true);
            $("#deAllocateFrame").css('color','grey');
            $("#saveLineItem").off('click');
            // $("#getPrice").prop('disabled',true);
          }
        }

    })
}

// When AddPayment btn click
$("#savePaymentbtn").click(function(){
    if (($("#inputPaymentAmount").val()==="")) {
        alert("Please Enter Amount");
    }else{
        if ($("#inputPaymentType").val()=="Cash") {
            // alert("Cash Selected");
            addPayment();
        }else{
                if (($("#inputChequeNo").val() ==="") || ($("#inputBankName").val()==="") || ($("#inputBranchName").val() ==="")) {
                alert("empty");
            }else{
                addPayment();
            }   
        }
    }
    $("#addPaymentForm").trigger('reset'); // Reset the Form Element
    $("#addPaymentModal").modal('hide'); // Hide Model
});

// Reset addPaymentForm on cancel btn click
$("#cancelPaymentbtn").click(function(){
    $("#addPaymentForm").trigger('reset'); // Reset the Form Element
});

$("#addNewPayment").click(function(){
  if ($("#booking_total").val()==="") {
      alert("Check Booking Price!");
  }else{
    $("#addPaymentModal").modal('show');
  }
});

$("#createNewInvoice").click(function(){
    if ($("#frameallotEngine").val()=="") {
      alert("Frame not alloted");
    }else{
      $("#createInvoiceModal").modal('show');
    }
});

$("#createInvoicebtn").click(function(){
  var keyno = $("#inputKeyNo").val();
  var batteyno = $("#inputBatteryNo").val();
  if (keyno=="" || batteyno=="") {
    alert("Enter Key & Battery No");
  }else{
      $.ajax({
          url: "../php_action/booking.php",
          method:'POST',
          datatype:'JSON',
          data:{createNewInvoice:"",
                bookingno:bookingno,
                keyno:keyno,
                batteyno:batteyno
              },
          success: function(data,status){
              // alert(data);
              fetchInvoiceData();
              checkInvoiceisCreated();
          }
      })
    $("#createInvoiceForm").trigger('reset');
    $("#createInvoiceModal").modal('hide');
  }

});

// Cancel Payment Button Event
$(".cancelpayment").each(function(){
  alert("ok");

})

// Save price detail
$("#saveLineItem").click(function(){
    var formdata = $("#lineItemForm").serialize();
    $.ajax({
        url: "../php_action/booking.php",
        method: "POST",
        data: formdata,
        datatype:"JSON",
        success:function(data,status){
        // var fetcheddata = $.parseJSON(data);// decode JSON data----->
        alert(data);
        fetchBooking(bookingno);
      }
    })
    // alert(formdata);
});       
  

$("#vehicleAllotmentTab").click(function(){
  // alert("ok");
  fetchData();
})

$("#invoiceTab").click(function(){
  fetchData();
});
// Event on financier change
$("#purchase_type").on('change',function(){
  if (this.value=='Cash'){
        $("#financier,#finance_amount, #FinanceApprove").prop('disabled',true);
      }else{
        $("#financier,#finance_amount, #FinanceApprove").prop('disabled',false);
      }
});
// Event on Booking Detil Save btn
$("#saveBookingDetail").click(function(){
  var purchasetype = $("#purchase_type").val();
  var financier = $("#financier").val();
  var financeamount = $("#finance_amount").val();
  var financeapprove = $("#FinanceApprove").val();
  var expecteddate = $("#expected_date").val();
  var expectedreason = $("#expected_reason").val();
  if (($("#expected_date").val()=="")|| ($("#expected_reason").val()=="")) {
    alert("Select Expected Date or Reason!");
  }else{
    if ($("#purchase_type").val()=='Cash') {
         $.ajax({
          url : "../php_action/booking.php",
          method:'post',
          datatype:'json',
          data :{ updatebookingdetail:"",
                  bookingno:bookingno,
                  purchasetype:purchasetype,
                  financier:financier,
                  financeamount:financeamount,
                  financeapprove:financeapprove,
                  expectedreason:expectedreason,
                  expecteddate:expecteddate,
              },
          success: function(data,status){
            alert(data);
          }
        }) // End of Ajax
    }else{
      if (($("#financier").val()=="") || ($("#finance_amount").val()=="") || ($("#FinanceApprove").is(":not(:checked)"))) {
        alert("Select Financier or Amount or Finance Approve");
      }else{
        $.ajax({
          url : "../php_action/booking.php",
          method:'post',
          datatype:'json',
          data :{ updatebookingdetail:"",
                  bookingno:bookingno,
                  purchasetype:purchasetype,
                  financier:financier,
                  financeamount:financeamount,
                  financeapprove:financeapprove,
                  expectedreason:expectedreason,
                  expecteddate:expecteddate,
              },
          success: function(data,status){
            // alert(data);
          }
        }) // End of Ajax
      }
    }
  }
  
});

function genCustomerDetailGrid(data){
				var tablegrid = $("#customer_detail_grid");
                // alert(data);
                var ldata = new Array();
                    ldata = data;
                var customer_list_source =
                {
                    localdata : ldata,
                    datatype: "json",
                    datafields: [
                        {name:'Customer_Id',type: 'string'},
                        {name:'Title',type: 'string'},
                        {name:'First_Name',type: 'string'},
                        {name:'Middle_Name',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                        {name:'Gender',type: 'string'},
                        {name:'Email',type: 'string'},
                        {name:'Mobile',type: 'string'},
                        {name:'Address1',type: 'string'},
                        {name:'Address2',type: 'string'},
                        {name:'City_Name',type: 'string'},
                        {name:'District',type: 'string'},
                        {name:'State',type: 'string'},
                        {name:'Pin_Code',type: 'string'},
                        {name:'Relation',type: 'string'},
                        {name:'Relative_Name',type: 'string'},
                        {name:'Creation_Date',type: 'string'},
                      ],
                };

            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                if (value.indexOf('#') != -1) {
                    value = value.substring(0, value.indexOf('#'));
                }
            var html = '<div style="margin-top: 8px;"><a href="../customer/customerdetail.php?'+column+'='+value+'">'+value+'</a></div>';
                return html;
            };
            
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = tablegrid.jqxGrid('getdatainformation');
                 var paginginfo = datainfo.paginginformation;
                 var leftButton = $("<div class='' style='margin:5px 0px 0px 0px'><div class=''><i class='fa fa-backward' aria-hidden='true'></i></div></div>");
                 leftButton.width(25);
                 leftButton.jqxButton({
                     theme: 'energyblue'
                 });
                 var rightButton = $("<div class='' style='margin:5px 0px 0px 10px'><div class=''><i class='fa fa-forward' aria-hidden='true'></i></div></div>");
                 rightButton.width(25);
                 rightButton.jqxButton({
                     theme: 'energyblue'
                 });
                 leftButton.appendTo(element);
                 rightButton.appendTo(element);
                 if (datainfo.rowscount==0) {
                    label.text("No Record");
                 }else{
                    label.text("1 - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                    }
                 $("#customer_detail_pager_info").html(label);
                 self.label = label;

                 // update buttons states.
                 var handleStates = function (event, button, className, add) {
                     button.on(event, function () {
                         if (add == true) {
                             button.find('div').addClass(className);
                         } else button.find('div').removeClass(className);
                     });
                 }
                 rightButton.click(function () {
                     tablegrid.jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     tablegrid.jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             tablegrid.on('pagechanged', function () {
             var datainfo = tablegrid.jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            tablegrid.jqxGrid({
                width: '100%',
                source: dataAdapter,
                columnsresize: true,
                pageable: true,
                autoheight: true,
                horizontalscrollbarstep: 200,
                pagesize: 5,
                pagermode:'simple',
                theme: 'energyblue',
                pagerrenderer: pagerrenderer,
                columns: [
                  { text: 'Customer Id', datafield:'Customer_Id', cellsrenderer: linkrenderer, width:'12%' },
                  { text: 'Created Date', datafield: 'Creation_Date',width:'8%', cellsformat:'d'},
                  { text: 'Title', datafield: 'Title', width:'5%'},
                  { text: 'First Name', datafield: 'First_Name', cellsalign: 'left', width:'12%' },
                  { text: 'Middle Name', datafield: 'Middle_Name', cellsalign: 'left', width:'12%'},
                  { text: 'Last Name', datafield: 'Last_Name', cellsalign: 'left', width:'12%' },
                  { text: 'Gender', datafield: 'Gender', cellsalign: 'left', width:'5%' },
                  { text: 'Mobile#', datafield: 'Mobile', cellsalign: 'left', width:'10%' },
                  { text: 'Email', datafield: 'Email', cellsalign: 'left', width:'12%' },
                  { text: 'Address1', datafield: 'Address1', cellsalign: 'left', width:'12%' },
                  { text: 'Address2', datafield: 'Address2', cellsalign: 'left', width:'12%' },
                  { text: 'City', datafield: 'City_Name', cellsalign: 'left', width:'12%' },
                  { text: 'District', datafield: 'District', cellsalign: 'left', width:'12%' },
                  { text: 'State', datafield: 'State', cellsalign: 'left', width:'12%' },
                  { text: 'Pin Code', datafield: 'Pin_Code', cellsalign: 'left', width:'5%' },
                  { text: 'Relation', datafield: 'Relation', cellsalign: 'left', width:'7%' },
                  { text: 'Relative Name', datafield: 'Relative_Name', cellsalign: 'left', width:'12%'},
                ]
            });

                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
            
        } // <---End of genCustomerDetailGrid

function genLineItemsGrid(data){
				var tablegrid = $("#lineitems_table_grid");
                var ldata = new Array();
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Booking_No',type: 'string'},
                        {name:'Booking_Date',type: 'string'},
                        {name:'Booking_Status',type: 'string'},
                        {name:'Model_Variant',type: 'string'},
                        {name:'Model_Name',type: 'string'},
                        {name:'Model_Category',type: 'string'},
                        {name:'Basic_Price',type: 'string'},
                        {name:'SGST_Rate',type: 'string'},
                        {name:'SGST_Value',type: 'string'},
                        {name:'CGST_Rate',type: 'string'},
                        {name:'CGST_Value',type: 'string'},
                        {name:'Exshow_Room_Price',type: 'string'},
                      ],
                };

            // frame with anchor tag--------------->
            var productrenderer = function(row, columnfield, value, defaulthtml, columnproperties, rowdata){
                var html = '<div class="input-group"><input type="text" class="form-control" id="'+columnfield+'"><div class="input-group-prepend" id="listdialog-parent"><div class="input-group-text" id="mtoclistdialog"><i class="fas fa-search"></i></div></div></div>';
                return html;
                };
            var cellsrenderer = function(row, columnfield, value, defaulthtml, columnproperties, rowdata){
                var html = '<div class="input-group"><input type="text" class="form-control" id="'+columnfield+'"></div>';
                return html;
                };
            var disablecellsrenderer = function (row, column, value) {
                var html = '<div style="margin-top: 0px;"><input id="'+column+'" type="text" class="form-control" readonly></div>';
                return html;
              };
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#lineitems_table_grid").jqxGrid('getdatainformation');
                 var paginginfo = datainfo.paginginformation;
                 var leftButton = $("<div class='' style='margin:5px 0px 0px 0px'><div class=''><i class='fa fa-backward' aria-hidden='true'></i></div></div>");
                 leftButton.width(25);
                 leftButton.jqxButton({
                     theme: 'energyblue'
                 });
                 var rightButton = $("<div class='' style='margin:5px 0px 0px 10px'><div class=''><i class='fa fa-forward' aria-hidden='true'></i></div></div>");
                 rightButton.width(25);
                 rightButton.jqxButton({
                     theme: 'energyblue'
                 });
                 leftButton.appendTo(element);
                 rightButton.appendTo(element);
                 if (datainfo.rowscount==0) {
                    label.text("No Record");
                 }else{
                    label.text("1 - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                    }
                 $("#lineitems_pager_info").html(label);
                 self.label = label;

                 // update buttons states.
                 var handleStates = function (event, button, className, add) {
                     button.on(event, function () {
                         if (add == true) {
                             button.find('div').addClass(className);
                         } else button.find('div').removeClass(className);
                     });
                 }
                 rightButton.click(function () {
                     $("#lineitems_table_grid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#lineitems_table_grid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#lineitems_table_grid").on('pagechanged', function () {
             var datainfo = $("#lineitems_table_grid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#lineitems_table_grid").jqxGrid({
                width: '100%',
                source: dataAdapter,
                columnsresize: true,
                pageable: true,
                autoheight: true,
                horizontalscrollbarstep: 200,
                pagesize: 5,
                pagermode:'simple',
                // selectionmode: 'multiplecellsadvanced',
                theme: 'energyblue',
                pagerrenderer: pagerrenderer,
                columns: [
                  { text: 'Product',datafield:'Product', cellsrenderer:productrenderer, width:'15%'},
                  { text: 'Model Category',datafield:'ModelCategory',cellsrenderer:disablecellsrenderer, width:'10%'},
                  { text: 'Model Name',datafield:'ModelName',cellsrenderer:disablecellsrenderer, width:'10%'},
                  { text: 'Model Variant',datafield:'ModelVariant',cellsrenderer:disablecellsrenderer, width:'15%' },
                  { text: 'Ex ShowRoom Price',datafield:'Exshowroom',cellsrenderer:disablecellsrenderer, width:'10%' },
                  { text: 'Hypothecation Charge',datafield:'Hypothecation',cellsrenderer:cellsrenderer, width:'10%' },
                  { text: 'Insurance Amount',datafield:'Insurance', cellsrenderer:cellsrenderer, width:'10%' },
                  { text: 'CR Temp Tax',datafield:'Tax', cellsrenderer:cellsrenderer, width:'10%' },
                  { text: 'Discount',datafield:'Discount', cellsrenderer:cellsrenderer, width:'10%' },
                  { text: 'Dealer Billing Price', datafield:'BasicPrice', cellsrenderer:disablecellsrenderer, width:'10%' },
                  { text: 'Taxable Amount',datafield:'TaxableAmount',cellsrenderer:disablecellsrenderer, width:'10%' },
                  { text: 'CGST%',datafield:'CGSTRate',cellsrenderer:disablecellsrenderer, width:'10%' },
                  { text: 'CGST Amount',datafield:'CGSTValue',cellsrenderer:disablecellsrenderer, width:'10%' },
                  { text: 'SGST%',datafield:'SGSTRate',cellsrenderer:disablecellsrenderer, width:'10%' },
                  { text: 'SGST Amount',datafield:'SGSTValue',cellsrenderer:disablecellsrenderer, width:'10%' },
                ]
            });

                $.each(data, function(key,value){
                    var product = value.Model_Code+value.Model_Type+value.Color_Code;
                    $("#Product").val(product);
                    $("#ModelCategory").val(value.Model_Category);
                    $("#ModelName").val(value.Model_Name);
                    $("#ModelVariant").val(value.Model_Variant);
                    $("#Exshowroom").val(value.Booking_Ex_Price);
                    $("#Hypothecation").val(value.Hypothecation_Charge);
                    $("#Insurance").val(value.Insurance);
                    $("#Tax").val(value.Tax);
                    $("#Discount").val(value.Booking_Discount_Value);
                    $("#BasicPrice").val(value.Booking_Basic_Price);
                    $("#TaxableAmount").val(value.Booking_Taxable_Price);
                    $("#CGSTRate").val(value.Booking_CGST_Rate);
                    $("#CGSTValue").val(value.Booking_CGST_Value);
                    $("#SGSTRate").val(value.Booking_SGST_Rate);
                    $("#SGSTValue").val(value.Booking_SGST_Value);
                }) // End of Each Function


        } // <---End of genLineItemsGrid

  function genPaymentGrid(data){
				var tablegrid = $("#payment_table_grid");
                // alert("data");
                var ldata = new Array();
                    if (data!=0) {
                      ldata = data;
                    }
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Receipt_No',type: 'string'},
                        {name:'Payment_Date',type: 'string'},
                        {name:'Payment_Status',type: 'string'},
                        {name:'Payment_Type',type: 'string'},
                        {name:'Payment_Amount',type: 'string'},
                        {name:'Cheque_No',type: 'string'},
                        {name:'Bank_Name',type: 'string'},
                        {name:'Branch_Name',type: 'string'},
                        {name:'Cancellation_Reason',type: 'string'},
                        {name:'Cancellation_Remark',type: 'string'},
                        {name:'Cancellation_Date',type: 'string'},

                      ],
                };

            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                row+=1;
            var html = '<div style="margin: 8px 0px 0px 10px;">'+row+'</div>';
                return html;
            };
            var actionbtn= function(row, columnfield, value, defaulthtml, columnproperties, rowdata){
              return '<button class="btn btn-danger cancelpayment" style="margin-left:20px;" id="'+rowdata.Receipt_No+'">Cancel</button>';
            };
            
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = tablegrid.jqxGrid('getdatainformation');
                 var paginginfo = datainfo.paginginformation;
                 var leftButton = $("<div class='' style='margin:5px 0px 0px 0px'><div class=''><i class='fa fa-backward' aria-hidden='true'></i></div></div>");
                 leftButton.width(25);
                 leftButton.jqxButton({
                     theme: 'energyblue'
                 });
                 var rightButton = $("<div class='' style='margin:5px 0px 0px 10px'><div class=''><i class='fa fa-forward' aria-hidden='true'></i></div></div>");
                 rightButton.width(25);
                 rightButton.jqxButton({
                     theme: 'energyblue'
                 });
                 leftButton.appendTo(element);
                 rightButton.appendTo(element);
                 if (datainfo.rowscount==0) {
                    label.text("No Record");
                 }else{
                    label.text("1 - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                    }
                 $("#payment_pager_info").html(label);
                 self.label = label;

                 // update buttons states.
                 var handleStates = function (event, button, className, add) {
                     button.on(event, function () {
                         if (add == true) {
                             button.find('div').addClass(className);
                         } else button.find('div').removeClass(className);
                     });
                 }
                 rightButton.click(function () {
                     tablegrid.jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     tablegrid.jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             tablegrid.on('pagechanged', function () {
             var datainfo = tablegrid.jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            tablegrid.jqxGrid({
                width: '100%',
                source: dataAdapter,
                columnsresize: true,
                pageable: true,
                autoheight: true,
                horizontalscrollbarstep: 200,
                pagesize: 5,
                selectionmode:'singlecell',
                pagermode:'simple',
                theme: 'energyblue',
                pagerrenderer: pagerrenderer,
                columns: [
                  { text: 'Sequence #', datafield: '',width:'8%', cellsrenderer:linkrenderer},
                  { text: 'Receipt #', datafield: 'Receipt_No',  width:'20%'},
                  { text: 'Payment Type', datafield: 'Payment_Type', width:'10%'},
                  { text: 'Amount', datafield: 'Payment_Amount', width:'10%'},
                  { text: 'Receipt Date', datafield:'Payment_Date', width:'10%' },
                  { text: 'Cheque/DD No.', datafield:'Cheque_No', width:'10%' },
                  { text: 'Bank Name', datafield:'Bank_Name', width:'10%' },
                  { text: 'Branch', datafield:'Branch_Name', width:'10%' },
                  { text: 'Cancellation Reason', datafield:'Cancellation_Reason', width:'15%' },
                  { text: 'Cancellation Remarks', datafield:'Cancellation_Remark', width:'15%' },
                  { text: 'Cancellation Date', datafield:'Cancellation_Date', width:'10%' },
                  { text: 'Status', datafield:'Payment_Status', width:'10%' },
                  { text: 'Action', datafield:'CancellPayment',cellsrenderer:actionbtn, width:'10%' },
                ]
            });

                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
               // alert(data.Customer_Id);
                  // fetchCustomer(data.Customer_Id);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
        } // <---End of genPaymentGrid

// Vehicle Allotment Tab
$("#frameCombobox").on('comboboxselect', function(event, ui){
  $("#frameallotFrame").val($(this).val());
  var frameno = $("#frameallotFrame").val();
  // alert(frame);
      $.ajax({
        url: "../php_action/booking.php",
        method: "POST",
        data: {updateFrame:frameno,bookingno:bookingno},
        datatype:"JSON",
        success:function(data,status){
          var fetcheddata = $.parseJSON(data);// decode JSON data----->
          // alert(fetcheddata.Engine_No);
          fetchData();
          loadFrameList();
          $("#frameallotEngine").val(fetcheddata.Engine_No);
          }
        }) // End ajax method------------->
});

$("#frameCombobox").hide();
$("#frameallotFrame").focus(function(){
  $("#frameCombobox").combobox();
  loadFrameList();
  $(this).hide();
});

$("#deAllocateFrame").click(function(){
  var frameno = $("#frameallotFrame").val();
      $.ajax({
        url: "../php_action/booking.php",
        method: "POST",
        data: {deteleFrame:frameno,bookingno:bookingno},
        datatype:"JSON",
        success:function(data,status){
          // alert(fetcheddata.Engine_No);
          if (data=='Invoiced') {
          alert("Invoice Created Couldn't Delete Frame");
          }else{
            fetchData();
            loadFrameList();
            }
          }
        }) // End ajax method-------->

})

function loadFrameList(){
    var Product = $("#frameallotProduct").val();
    // alert(Product);
    var html;
    $.ajax({
    url: "../php_action/fetchdata.php",
    method: "POST",
    data: {fetchFrames:Product},
    datatype:"JSON",
    success:function(data,status){
      var fetcheddata = $.parseJSON(data);// decode JSON data----->
      // alert(fetcheddata);
      $.each(fetcheddata, function(key, value){
      // alert(value.Model_Name);
      html += '<option value="'+value.Frame_No+'">'+value.Frame_No+'</option>';
      })
      $("#frameCombobox").html(html);
      }
    }) // End ajax method------------->
}

  function genInvoiceGrid(data){
  				var tablegrid = $("#invoice_table_grid");
                // alert(data);
                var ldata = new Array();
                
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Invoice_No',type: 'string'},
                        {name:'Invoice_Date',type: 'string'},
                        {name:'Invoice_Status',type: 'string'},
                        {name:'Invoice_Type',type: 'string'},
                        {name:'Key_No',type: 'string'},
                        {name:'Battery_No',type: 'string'},
                        {name:'First_Name',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                      ],
                };

            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                if (value.indexOf('#') != -1) {
                    value = value.substring(0, value.indexOf('#'));
                }
            var html = '<div style="margin-top: 8px;"><a href="../invoice/invoicedetail.php?'+column+'='+value+'">'+value+'</a></div>';
                return html;
            };
            
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#invoice_table_grid").jqxGrid('getdatainformation');
                 var paginginfo = datainfo.paginginformation;
                 var leftButton = $("<div class='' style='margin:5px 0px 0px 0px'><div class=''><i class='fa fa-backward' aria-hidden='true'></i></div></div>");
                 leftButton.width(25);
                 leftButton.jqxButton({
                     theme: 'energyblue'
                 });
                 var rightButton = $("<div class='' style='margin:5px 0px 0px 10px'><div class=''><i class='fa fa-forward' aria-hidden='true'></i></div></div>");
                 rightButton.width(25);
                 rightButton.jqxButton({
                     theme: 'energyblue'
                 });
                 leftButton.appendTo(element);
                 rightButton.appendTo(element);
                 if (datainfo.rowscount==0) {
                    label.text("No Record");
                 }else{
                    label.text("1 - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                    }
                 $("#invoice_pager_info").html(label);
                 self.label = label;

                 // update buttons states.
                 var handleStates = function (event, button, className, add) {
                     button.on(event, function () {
                         if (add == true) {
                             button.find('div').addClass(className);
                         } else button.find('div').removeClass(className);
                     });
                 }
                 rightButton.click(function () {
                     $("#invoice_table_grid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#invoice_table_grid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#invoice_table_grid").on('pagechanged', function () {
             var datainfo = $("#invoice_table_grid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#invoice_table_grid").jqxGrid({
                width: '100%',
                source: dataAdapter,
                columnsresize: true,
                pageable: true,
                autoheight: true,
                horizontalscrollbarstep: 200,
                pagesize: 5,
                pagermode:'simple',
                theme: 'energyblue',
                pagerrenderer: pagerrenderer,
                columns: [
                  { text: 'Invoice #', datafield: 'Invoice_No',width:'20%', cellsrenderer:linkrenderer},
                  { text: 'Invoice Date', datafield: 'Invoice_Date', cellsalign: 'left', width:'20%'},
                  { text: 'Invoice Type', datafield: 'Invoice_Type', cellsalign: 'left', width:'20%'},
                  { text: 'Invoice Status', datafield: 'Invoice_Status', cellsalign: 'left', width:'15%'},
                  { text: 'First Name', datafield:'First_Name', width:'20%' },
                  { text: 'Last Name', datafield:'Last_Name', width:'10%' },
                  { text: 'Key No', datafield:'Key_No', width:'10%' },
                  { text: 'Battery #', datafield:'Battery_No', width:'10%' },
                ]
            });

                $("#invoice_table_grid").on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = $("#invoice_table_grid").jqxGrid('getrowdata', row);
               // alert(data.Customer_Id);
                  // fetchCustomer(data.Customer_Id);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
        } // <---End of genInvoiceGrid
genBookingListGrid(0);
  function genBookingListGrid(data){
          var tablegrid = $("#enquiryListTableGrid");
                // alert(data);
                var ldata = new Array();
                
                var customer_list_source =
                {
                    localdata : ldata,
                    datatype: "json",
                    datafields: [
                        {name:'Invoice_No',type: 'string'},
                        {name:'Invoice_Date',type: 'string'},
                        {name:'Invoice_Status',type: 'string'},
                        {name:'Invoice_Type',type: 'string'},
                        {name:'Key_No',type: 'string'},
                        {name:'Battery_No',type: 'string'},
                        {name:'First_Name',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                      ],
                };
            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                if (value.indexOf('#') != -1) {
                    value = value.substring(0, value.indexOf('#'));
                }
            var html = '<div style="margin-top: 8px;"><a href="../invoice/invoicedetail.php?'+column+'='+value+'">'+value+'</a></div>';
                return html;
            };
            
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = tablegrid.jqxGrid('getdatainformation');
                 var paginginfo = datainfo.paginginformation;
                 var leftButton = $("<div class='' style='margin:5px 0px 0px 0px'><div class=''><i class='fa fa-backward' aria-hidden='true'></i></div></div>");
                 leftButton.width(25);
                 leftButton.jqxButton({
                     theme: 'energyblue'
                 });
                 var rightButton = $("<div class='' style='margin:5px 0px 0px 10px'><div class=''><i class='fa fa-forward' aria-hidden='true'></i></div></div>");
                 rightButton.width(25);
                 rightButton.jqxButton({
                     theme: 'energyblue'
                 });
                 leftButton.appendTo(element);
                 rightButton.appendTo(element);
                 if (datainfo.rowscount==0) {
                    label.text("No Record");
                 }else{
                    label.text("1 - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                    }
                 $("#enquiryListTablePager").html(label);
                 self.label = label;

                 // update buttons states.
                 var handleStates = function (event, button, className, add) {
                     button.on(event, function () {
                         if (add == true) {
                             button.find('div').addClass(className);
                         } else button.find('div').removeClass(className);
                     });
                 }
                 rightButton.click(function () {
                     tablegrid.jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     tablegrid.jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             tablegrid.on('pagechanged', function () {
             var datainfo = tablegrid.jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            tablegrid.jqxGrid({
                width: '100%',
                source: dataAdapter,
                columnsresize: true,
                pageable: true,
                autoheight: true,
                horizontalscrollbarstep: 200,
                pagesize: 5,
                pagermode:'simple',
                theme: 'energyblue',
                pagerrenderer: pagerrenderer,
                columns: [
                  { text: 'Booking #', datafield: 'Booking_No',width:'20%', cellsrenderer:linkrenderer},
                  { text: 'Booking Date', datafield: 'Booking_Date',width:'20%'},
                  { text: 'Mode Category', datafield: 'Invoice_Date', cellsalign: 'left', width:'20%'},
                  { text: 'Model Name', datafield: 'Invoice_Type', cellsalign: 'left', width:'20%'},
                  { text: 'Model Variant', datafield: 'Invoice_Status', cellsalign: 'left', width:'15%'},
                  { text: 'First Name', datafield:'First_Name', width:'20%' },
                  { text: 'Last Name', datafield:'Last_Name', width:'10%' },
                  { text: 'Mobile #', datafield:'Key_No', width:'10%' },
                  { text: 'Frame #', datafield:'Frame_No', width:'10%' },
                  { text: 'Engine #', datafield:'Engine_No', width:'10%' },
                  { text: 'Delivery Date', datafield:'Delivery_Date', width:'10%' },
                  { text: 'Status', datafield:'Status', width:'10%' },
                  { text: '(DSE) Name', datafield:'DSE_Name', width:'10%' },
                  { text: 'Model', datafield:'Model_Code', width:'10%' },
                  { text: 'Color', datafield:'Color_Name', width:'10%' },
                  { text: 'Purchase Type', datafield:'Purchase_Type', width:'10%' },
                  { text: 'Booking Total', datafield:'Booking', width:'10%' },
                  { text: 'Total Payment', datafield:'Total_Payment', width:'10%' },
                  { text: 'Balance Amount', datafield:'Battery_No', width:'10%' },
                ]
            });

                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
               // alert(data.Customer_Id);
                  // fetchCustomer(data.Customer_Id);
              });
        } // <---End of genInvoiceGrid

// Combobox function
function searchableCombobox(){  
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            // alert();
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
          
        }) );
        
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 } // End of Combobox Function




}) // End of document function------>