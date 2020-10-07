$(document).ready(function(){

$("input, select").click(function(){
   $(this).addClass("bgchange");
    })

 $("input, select").on('blur',function(){
 $(this).removeClass("bgchange");
 })
var invoiceno = $("#invoice_no").val();

searchInvoiceDataGrid();
// fetch Invoice data
fetchInvoiceData(invoiceno);// Call function

// fetch Invoice Data for Detail
function fetchInvoiceData(data){
  $.ajax({
        url: "../php_action/invoice.php",
        method: "POST",
        data: {fetchinvoicedata:data},
        datatype:"JSON",
        success:function(data,status){
        var fetcheddata = $.parseJSON(data);// decode JSON data----->
          // alert(fetcheddata.Invoice_Status);
          var payment=0;
            $.each(fetcheddata, function(key,value){
                   	payment += parseInt(value.Payment_Amount);
                    $("#model_category").val(value.Model_Category);
                    $("#model_name").val(value.Model_Name);
                    $("#model_variant").val(value.Model_Variant);
                    $("#invoice_no").val(value.Invoice_No);
                    $("#invoice_date").val(value.Invoice_Date);
                    $("#status").val(value.Invoice_Status);
                    $("#BookingNo").val(value.Booking_No);
                    $("#TotalAmount").val(value.Booking_Ex_Price);
                    $("#first_name").val(value.First_Name);
                    $("#purchase_type").val(value.Purchase_Type);
                    $("#financier").val(value.F_Name);
                    $("#finance_amount").val(value.Finance_Amount);
                    $("#CancellationDate").val(value.Cancellation_Date);
                    $("#CancellationReason").val(value.Cancellation_Reason);
                    $("#middle_name").val(value.Middle_Name);
                    $("#BatteryNo").val(value.Battery_No);
                    $("#KeyNo").val(value.Key_No);
                    $("#RegistrationNo").val(value.Registration_No);
                    $("#PaymentDate").val(value.Payment_Date);
                    $("#PaymentAmount").val(payment);
                    $("#last_name").val(value.Last_Name);
                    $("#Address1").val(value.Address1);
                    $("#Address2").val(value.Address2);
                    $("#State").val(value.State);
                    $("#City").val(value.City_Name);
                    $("#Zip").val(value.Pin_Code);
                      if (value.Invoice_Status=="Cancelled") {
                        $("#cancelInvoicebtn, #saveInvoicedetailbtn").prop('disabled',true);
                      }  
                    
                }) // End of Each Function
        }
    })
}
// fetchInvoiceDataGrid();
function fetchInvoiceDataGrid(){
    $.ajax({
        url: '../php_action/invoice.php',
        method:'post',
        datatype:'json',
        data:{fetchinvoicedatagrid:""},
        success: function(data,status){
            var fetcheddata = $.parseJSON(data);
            genInvoiceListGrid(data);
        }
    });
}


function searchInvoiceDataGrid(){
    var searchinvoicedata = $("#searchinvoicedate").val();
    var searchedinvoiceno = $("#searchinvoiceno").val();
    $.ajax({
        url: '../php_action/invoice.php',
        method:'post',
        datatype:'json',
        data:{searchinvoicedata:"",
                invoiceno:searchedinvoiceno,
                date:searchinvoicedata,
            },
        success: function(data,status){
            var fetcheddata = $.parseJSON(data);
            genInvoiceListGrid(fetcheddata);
        }
    });
    // alert(invoiceno);
}

fetchrecentlyinvoices();
// recent 5 invoice created list
function fetchrecentlyinvoices(){
  $.ajax({
    url: '../php_action/invoice.php',
    method:'post',
    datatype:'json',
    data: {fetchrecentlyinvoices:""},
    success: function(data,status){
      // alert(data);
      $("#recentInvoice").html(data);
    }
  })
}

function genInvoiceListGrid(data){
                var tablegrid = $("#invoiceListTableGrid");
                var ldata = new Array();
                if (data==0) {
                  data = ldata;
                }
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Invoice_No',type: 'string'},
                        {name:'Invoice_Date',type: 'string'},
                        {name:'First_Name',type: 'string'},
                        {name:'Middle_Name',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                        {name:'Gender',type: 'string'},
                        {name:'Email',type: 'string'},
                        {name:'Mobile',type: 'string'},
                        {name:'Address1',type: 'string'},
                        {name:'Address2',type: 'string'},
                        {name:'City_Name',type: 'string'},
                        {name:'State',type: 'string'},
                        {name:'Pin_Code',type: 'string'},
                        {name:'Relation',type: 'string'},
                        {name:'Relative_Name',type: 'string'},
                        {name:'Creation_Date',type: 'string'},
                        {name:'Key_No',type: 'string'},
                        {name:'Battery_No',type: 'string'},
                        {name:'Invoice_Status',type: 'string'},
                        {name:'Booking_No',type: 'string'},
                        {name:'Booking_Date',type: 'string'},
                        {name:'Finance_Amount',type: 'string'},
                        {name:'Purchase_Type',type: 'string'},
                        {name:'Booking_Ex_Price',type: 'string'},
                        {name:'Road_Tax',type: 'string'},
                        {name:'Insurance_Charge',type: 'string'},
                        {name:'Booking_Discount_Value',type: 'string'},
                        {name:'Booking_Taxable_Price',type: 'string'},
                        {name:'Hypothecation_Charge',type: 'string'},
                        {name:'Frame',type: 'string'},
                        {name:'Booking_SGST_Rate',type: 'string'},
                        {name:'Booking_SGST_Value',type: 'string'},
                        {name:'Booking_CGST_Rate',type: 'string'},
                        {name:'Booking_CGST_Value',type: 'string'},
                        {name:'Model_Category',type: 'string'},
                        {name:'Model_Name',type: 'string'},
                        {name:'Model_Variant',type: 'string'},
                        {name:'Model_Code',type: 'string'},
                        {name:'Model_Type',type: 'string'},
                        {name:'Color_Code',type: 'string'},
                        {name:'Engine_No',type: 'string'},
                        {name:'F_Name',type: 'string'},
                        {name:'Emission_Norms',type: 'string'},
                        {name:'Color_Name',type: 'string'},
                        {name:'DSE_F_Name',type: 'string'},
                        {name:'DSE_L_Name',type: 'string'},
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
            var dsenamerendered = function(row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                return '<div style="margin: 8px 0px 0px 5px;">'+rowdata.DSE_F_Name+" "+rowdata.DSE_L_Name+'</div>';
            };
            var motcrendered = function(row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                return '<div style="margin: 8px 0px 0px 5px;">'+rowdata.Model_Code+rowdata.Model_Type+rowdata.Color_Code+'</div>';
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
                 $("#invoiceListTablePager").html(label);
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
                  { text: 'Invoice #', datafield:'Invoice_No', cellsrenderer: linkrenderer ,width:'17%' },
                  { text: 'Invoice Date', datafield: 'Invoice_Date',width:'8%'},
                  { text: 'First Name', datafield: 'First_Name',width:'8%' },
                  { text: 'Middle Name', datafield: 'Middle_Name',width:'8%' },
                  { text: 'Last Name', datafield: 'Last_Name' ,width:'8%' },
                  { text: 'Gender', datafield: 'Gender', width:'5%',width:'8%' },
                  { text: 'Mobile#', datafield: 'Mobile', width:'10%',width:'8%' },
                  { text: 'Address1', datafield: 'Address1' ,width:'8%' },
                  { text: 'Address2', datafield: 'Address2' ,width:'8%' },
                  { text: 'City', datafield: 'City_Name' ,width:'8%' },
                  { text: 'State', datafield: 'State' ,width:'8%' },
                  { text: 'Pin Code', datafield: 'Pin_Code', width:'5%' },
                  { text: 'Model Category', datafield: 'Model_Category', width:'7%' },
                  { text: 'Model Name', datafield: 'Model_Name',width:'8%' },
                  { text: 'Model Variant', datafield: 'Model_Variant',width:'10%' },
                  { text: 'Model Code', datafield: 'Model_Code',width:'8%' },
                  { text: 'MTOC', datafield: 'Product',cellsrenderer:motcrendered, width:'10%' },
                  { text: 'Financier', datafield: 'F_Name',width:'8%' },
                  { text: 'Purchase Type', datafield: 'Purchase_Type',width:'8%' },
                  { text: 'Hypothecation', datafield: 'Hypothecation_Charge',width:'8%' },
                  { text: 'Finance Amount', datafield: 'Finance_Amount',width:'8%' },
                  { text: 'Engine #', datafield: 'Engine_No' ,width:'10%'},
                  { text: 'Frame #', datafield: 'Frame',width:'12%' },
                  { text: 'Color', datafield: 'Color_Name',width:'8%' },
                  { text: 'ExShowroom Price', datafield: 'Booking_Ex_Price',width:'8%' },
                  { text: 'Road Tax', datafield: 'Road_Tax',width:'8%' },
                  { text: 'Insurance', datafield: 'Insurance_Charge',width:'8%' },
                  { text: 'Assigned To (DSE) Name', cellsrenderer:dsenamerendered, width:'8%' },
                  { text: 'Battery #', datafield: 'Battery_No',width:'8%' },
                  { text: 'Key #', datafield: 'Key_No',width:'8%',width:'8%' },
                  { text: 'Discount', datafield: 'Booking_Discount_Value',width:'8%' },
                  { text: 'Cancellation Reason', datafield: 'Cancellation_Reason' ,width:'8%'},
                  { text: 'Taxable Value', datafield: 'Booking_Taxable_Price',width:'8%' },
                  { text: 'Status', datafield: 'Invoice_Status',width:'8%' },
                  { text: 'Booking #', datafield: 'Booking_No',width:'10%' },
                  { text: 'Booking Date', datafield: 'Booking_Date',width:'8%' },
                  { text: 'Emission Norms', datafield: 'Emission_Norms',width:'8%' },
                  { text: 'CGST %', datafield: 'Booking_CGST_Rate',width:'8%' },
                  { text: 'CGST Amount', datafield: 'Booking_CGST_Value',width:'8%' },
                  { text: 'SGST %', datafield: 'Booking_SGST_Rate',width:'8%' },
                  { text: 'SGST Amount', datafield: 'Booking_SGST_Value',width:'8%' },

                ]
            });
                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
                  fetchInvoiceData(data.Invoice_No);
              });
        } // <---End of genCustomerDetailGrid

$("#saveInvoicedetailbtn").click(function(){
  var battery = $("#BatteryNo").val();
  var key = $("#KeyNo").val();
  var regnumber = $("#RegistrationNo").val();

  $.ajax({
    url: '../php_action/invoice.php',
    method:'post',
    datatype:'json',
    data: {updateInvoiceDetail:"",battery:battery,key:key,regnumber:regnumber,invoiceno:invoiceno},
    success: function(data,status){
      if (data==0) {
              alert("Updation Failed....");
      }
    }
  })

});

// Cancel Invoice
$("#cancelInvoicebtn").click(function(){
  var reason = $("#CancellationReason").val();
  
  if (reason =="") {
    alert("Please put valid reason for cancellation");
  }else{
    // alert(reason);

    $.ajax({
      url: '../php_action/invoice.php',
      method:'post',
      datatype:'json',
      data: {cancelInvoice:"",reason:reason,invoiceno:invoiceno},
      success: function(data,status){
        if (data==0) {
                alert("Updation Failed....");
        }
      }
    })
  }
});

// customer search invoice grid
$("#search-i-btn").click(function(){
  var searchedcol = $("#searchedcol").val();
  var searcheddata = $("#searchInvoiceListfield").val();

  var lnth = searcheddata.length;
    if (searchedcol == "Invoice_Date") {
        var dd = mm = yy ="";
        if(searcheddata.indexOf("/")==3 || searcheddata.indexOf("/")==4){
            if (searcheddata.indexOf("/")==3) {
                dd = searcheddata.substr(1,2);
                mm = searcheddata.substr(4,2);
                yy = searcheddata.substr(7,4);
                searcheddata = (searcheddata.substring(0,1)+" '"+yy+"-"+mm+"-"+dd+"'");
            }else{
                dd = searcheddata.substr(2,2);
                mm = searcheddata.substr(5,2);
                yy = searcheddata.substr(8,4);
                searcheddata = (searcheddata.substring(0,2)+" '"+yy+"-"+mm+"-"+dd+"'");
            }
        }else{
            alert("Date Is Invalid");
        }
    }else{
        if (searcheddata.indexOf("*")==0) {
            searcheddata = searcheddata.replace("*","%");   
        }else if (searcheddata.indexOf("*")+1==lnth) {
            searcheddata = searcheddata.replace("*","%");
        }else{}
    }

  $.ajax({
      url: '../php_action/invoice.php',
      method:'post',
      datatype:'json',
      data: {searchInvoiceGridData:"",searchedcol:searchedcol,searcheddata:searcheddata},
      success: function(data,status){
        // alert(data);
        var fetcheddata = $.parseJSON(data);
            genInvoiceListGrid(fetcheddata);
      }
    })

});

$("#exportbtn").click(function(){
    $("#invoiceListTableGrid").jqxGrid('exportdata', 'xls', 'Output');
});

}); // End of document function