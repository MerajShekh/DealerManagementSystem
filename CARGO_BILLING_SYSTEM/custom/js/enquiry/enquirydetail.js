$(document).ready(function () {

$("input, select").click(function(){
   $(this).addClass("bgchange");
    })

 $("input, select").on('blur',function(){
 $(this).removeClass("bgchange");
 })


// select2 ----->
// $("#model_category, #model_name, #model_variant, #purchase_type").select2({
//   width:300,
//   placeholder : "Select Data"
// });
var enquiryno = $("#enquiry_id").val();

fetchModelList();
fetchFinancier();
fetchEnquiry(enquiryno);

 function fetchModelList(){
// alert("fetchmodel call");
var html;
// var html = '<option value=""></option>';
    $.ajax({
            url: "../php_action/fetchdata.php",
            method: "POST",
            data: {fetchAllModels:""},
            datatype:"JSON",
            success:function(data,status){
                var fetcheddata = $.parseJSON(data);// decode JSON data----->
                // alert(fetcheddata);
                $.each(fetcheddata, function(key, value){
              // alert(value.Model_Name);
              html += '<option value="'+value.Model_Name+'">'+value.Model_Name+'</option>';
            })
            $("#make_lost_to").html(html);
                // $("#enquiry_date").val(fetcheddata.Model_Category);
                // $("#make_lost_to").html('<option value="'+fetcheddata.Model_Name+'">'+fetcheddata.Model_Name+'</option>');
                
            }
        }) // End ajax method------------->
 } // <----End of fetchModelList function

  

 	// fetch customer detail by customerID
    function fetchEnquiry(enquiryno){
        $.ajax({
            url: "../php_action/enquiry.php",
            method: "POST",
            data: {fetchenquiry:enquiryno},
            datatype:"JSON",
            success:function(data,status){
                var fetcheddata = $.parseJSON(data);// decode JSON data----->
                $("#model_category").val(fetcheddata.Model_Category);
                $("#model_name").html('<option value="'+fetcheddata.Model_Name+'">'+fetcheddata.Model_Name+'</option>');
                $("#model_variant").html('<option value="'+fetcheddata.Model_Variant+'">'+fetcheddata.Model_Variant+'</option>');
                $("#enquiry_date").val(fetcheddata.Enquiry_Date);
                $("#enquiry_type").html('<option value="'+fetcheddata.Enquiry_Type+'">'+fetcheddata.Enquiry_Type+'</option>');
                $("#first_name").val(fetcheddata.First_Name);
                $("#customerid").val(fetcheddata.Customer_Id);
                $("#purchase_type").val(fetcheddata.Purchase_Type);
                $("#financier").val(fetcheddata.F_Id);
                $("#assign_dse").html('<option value="'+fetcheddata.DSE_Code+'">'+fetcheddata.DSE_Code+'</option>');
                $("#enquiry_source").html('<option value="'+fetcheddata.Enquiry_Source+'">'+fetcheddata.Enquiry_Source+'</option>');
                $("#middle_name").val(fetcheddata.Middle_Name);
                $("#credit_note").val(fetcheddata.Credit_Note);
                $("#created_by").val(fetcheddata.Created_By);
                $("#assign_dse_name").val(fetcheddata.DSE_F_Name+" "+fetcheddata.DSE_L_Name);
                $("#enquiry_category").html('<option value="'+fetcheddata.Enquiry_Category+'">'+fetcheddata.Enquiry_Category+'</option>');
                $("#stage").val(fetcheddata.Stage);
                $("#last_name").val(fetcheddata.Last_Name);
                $("#follow_date").val(fetcheddata.F_Date);
                $("#folloup_flag").val(fetcheddata.F_Flag);
                $("#test_ride_date").val(fetcheddata.T_Date);
                $("#test_ride_flag").val(fetcheddata.T_Flag);
                $("#remark").val(fetcheddata.Remark);
                $("#make_lost_to").val(fetcheddata.Model_Name);
                $("#make_lost_to").select2().trigger('change');
                if (fetcheddata.Purchase_Type=='Cash') {
                  $("#financier").prop('disabled',true);
                }
                if (fetcheddata.Stage=='Invoiced') {
                  $("#selectMTOCbtn").attr('disabled',true);
                  
                }
                genMTOCGrid("Default");
                setMTOCVariant(fetcheddata.Model_Variant);
            }

        }) // End ajax method------------->
    }

function getModelData(grid, id, data, fetcheddata){
      // alert(data);
      var a = fetcheddata;
      var html = '<option value=""></option>';
    $.ajax({
          url: "../php_action/fetchdata.php",
          datatype: "json",
          method: "post",
          data: {id:id, data:data, fetcheddata: fetcheddata},
          success: function(data, status) {
            // response(data);
            var mydata = $.parseJSON(data);
            $.each(mydata, function(key, value){
              // alert(value);
              html += '<option value="'+value+'">'+value+'</option>';
            })
            $("#"+grid).html(html);
            
          }
        });
   }

    $("#model_category").on('change', function(){
        $("#model_name").html('<option value=""></option>');
      var mcat = this.value;
      if (mcat !='') {
        // alert(this.value);
      getModelData("model_name", "Model_Category", mcat, "Model_Name");
      $("#model_variant").html('<option value=""></option>');
      }else{

      $("#model_name").html('<option value=""></option>');
      $("#model_variant").html('<option value=""></option>');
      }
    }); // /.ModelCategoryChagenEvent

    $("#model_name").on('change', function(){
      if (this.value !='') {
      getModelData("model_variant", "Model_Name", this.value, "Model_Variant");
      }else{
        $("#model_variant").html('<option value=""></option>');
      }
    });  // /.ModelNameChagenEvent

    $("#model_variant").on('change', function(){
      genMTOCGrid("Change");
      // setMTOCVariant($(this).val());
    });  // /.ModelNameChagenEvent

// Event on financier change
$("#purchase_type").on('change',function(){
  if (this.value=='Cash'){
        $("#financier").prop('disabled',true);
      }else{
        $("#financier").prop('disabled',false);
      }
});

// CustomerListModal
$("#listdialog-parent").on('click', function(){
    $("#CustomerListModal").modal('show');
});

// When New Enquiry Model shown 
        $.ajax({
          url: "../php_action/fetchdata.php",
          datatype: "json",
          method: "post",
          data: {fetchAllcustomer:""},
          success: function(data, status) {
            var mydata = $.parseJSON(data);
            // alert(data);
            genCustomerGrid(mydata);
            // genMTOCGrid(mydata);
            genActivityGrid(mydata);
            

          }
   });


        function genCustomerGrid(data){
                // alert(data);
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Customer_Id',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                        {name:'First_Name',type: 'string'},
                        {name:'Middle_Name',type: 'string'},
                        {name:'Mobile',type: 'string'},
                      ],
                };
            
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#customerListGrid").jqxGrid('getdatainformation');
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
                 $("#pagelist").html(label);
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
                     $("#customerListGrid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#customerListGrid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#customerListGrid").on('pagechanged', function () {
             var datainfo = $("#customerListGrid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#customerListGrid").jqxGrid({
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
                  { text: 'First Date', datafield: 'First_Name',width:'20%', cellsformat:'d'},
                  { text: 'Midle Name', datafield: 'Middle_Name', cellsalign: 'left', width:'20%'},
                  { text: 'Last Name', datafield: 'Last_Name', cellsalign: 'left', width:'20%'},
                  { text: 'Mobile', datafield: 'Mobile', cellsalign: 'left', width:'15%'},
                  { text: 'Customer Id', datafield:'Customer_Id', width:'25%' },
                ]
            });

                $("#customerListGrid").on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = $("#customerListGrid").jqxGrid('getrowdata', row);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
        } // <---End of genCustomerGrid

      $("#selectCustomerbtn").click(function(){
        var selectedcustomerid = $("#selectcustomerid").val();
        if (selectedcustomerid =="") {
          alert("Select Customer");
        }else{
          // alert(selectedcustomerid);
          $("#customerid").val(selectedcustomerid);
          $("#CustomerListModal").modal('hide');

              $.ajax({
              url: "../php_action/fetchdata.php",
              datatype: "json",
              method: "post",
              data: {changedCustomerid:selectedcustomerid},
              success: function(data, status) {
                var fetcheddata = $.parseJSON(data);
                $("#first_name").val(fetcheddata.First_Name);
                $("#middle_name").val(fetcheddata.Middle_Name);
                $("#last_name").val(fetcheddata.Last_Name);

                }
            });
        }

      });

      // <-----saveEnquiryDetail
  $("#saveEnquiryDetail").click(function(){
        var formData = $("#enquiryDetailForm");
        if ($("#purchase_type").val()!='Cash') {
          if ($("#financier").val()=="") {
            alert("Select Financier!");
          }else{
            $.ajax({
            url: "../php_action/enquiry.php",
            method: "POST",
            datatype:"JSON",
            data: formData.serialize(),
            success:function(data,status){
                // alert(data);
            }
        }) //Ajax    
          }
        }else{
        $.ajax({
            url: "../php_action/enquiry.php",
            method: "POST",
            datatype:"JSON",
            data: formData.serialize(),
            success:function(data,status){
                // alert(data);
            }
        }) //Ajax
      } //Else
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

 $("#model_name").on('click',function(){
  var mc = $("#model_category").val();
  fetchProducts("Model_Name","Model_Category",mc, "model_name");
});
$("#model_variant").on('click',function(){
  var mName = $("#model_name").val();
  fetchProducts("Model_Variant","Model_Name",mName, "model_variant");
 });
 

function fetchProducts(fcolumn,ccolumn,data, htmlid){
  // alert(data);
  var html;
  $.ajax({
            url: "../php_action/fetchdata.php",
            method: "POST",
            datatype:"JSON",
            data: {fetchproducts:"",
                    fcolumn : fcolumn,
                    ccolumn : ccolumn,
                    data : data
                  },
            success:function(data,status){
                // alert(data);
                var financiers = $.parseJSON(data);
              $.each(financiers, function(key, value){
                  html += '<option value="'+value+'">'+value+'</option>';
              // alert(html);
                })
                $("#"+htmlid).select2();
                $("#"+htmlid).html(html);
            }
        })
}           

// $("#test_ride_date").select2();

function genMTOCGrid(caller){
                // alert("fun call");
                var ldata = new Array();
                var row = {};
                row[''] = "";
                ldata[0] = row;
                var customer_list_source =
                {
                    localdata : ldata,
                };
            
                var productrenderer = function (row, column, value) {
                var html = '<div class="input-group"><input type="text" class="form-control" id="'+column+'"><div class="input-group-prepend" id="listdialog-parent"><div class="input-group-text" id="mtoclistdialog"><i class="fas fa-search"></i></div></div></div>';
                return html;
              };

              var cellsrenderer = function (row, column, value) {
                var html = '<div style="margin-top: 0px;"><input id="'+column+'" type="text" class="form-control" disabled></div>';
                return html;
              };

                
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#mtoc_table_grid").jqxGrid('getdatainformation');
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
                 // label.appendTo($("#"+pager));
                 $("#mtoc_list_pager_info").html(label);
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
                     $("#mtoc_table_grid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#mtoc_table_grid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#mtoc_table_grid").on('pagechanged', function () {
             var datainfo = $("#mtoc_table_grid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#mtoc_table_grid").jqxGrid({
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
                  { text: 'Product', datafield:'gridrowProduct', width:'25%', cellsformat:'d', cellsrenderer: productrenderer},
                  { text: 'HSN Code', datafield:'gridrowHSNCode', cellsrenderer: cellsrenderer, width:'10%'},
                  { text: 'Color', datafield:'gridrowcolorName', cellsrenderer: cellsrenderer, width:'20%'},
                  { text: 'Color Code',datafield:'gridrowcolorCode', cellsrenderer: cellsrenderer, width:'10%'},
                  { text: 'Model Variant', datafield:'gridrowModelVariant', cellsrenderer: cellsrenderer, width:'25%' },
                  { text: 'MTOC Description', datafield:'gridrowMTOCDes', cellsrenderer: cellsrenderer, width:'25%' },
                ]
            });
            // load proctName in mtocGrid
             var mv = $("#model_variant").val();
             if (caller == "Default") {
              var data4fetch = {mtocproductvariant:enquiryno};
              mtocGridDetail(data4fetch);
             }else { 
              var data4fetch2 = {fetchAllProducts:mv};
              mtocGridDetail(data4fetch2);
             }
             
             function mtocGridDetail(data){
                  $.ajax({
                  url: "../php_action/enquiry.php",
                  datatype: "json",
                  method: "post",
                  data: data,
                  success: function(data, status) {
                    var productlistdata = $.parseJSON(data);
                      // $("#gridrowProduct").val(productlistdata.Model_Code);
                      $.each(productlistdata, function(key, value){
                      var product = value.Model_Code+value.Model_Type+value.Color_Code;
                      $("#gridrowProduct").val(product);
                      $("#gridrowHSNCode").val(value.HSN_Code);
                      $("#gridrowModelVariant").val(value.Model_Variant);
                      $("#gridrowcolorName").val(value.Color_Name);
                      $("#gridrowcolorCode").val(value.Color_Code);
                      $("#gridrowMTOCDes").val(value.Model_Variant+" "+value.Color_Name);
                      })
                   }
                });
              }
            // $("#gridrowProduct").val(enquiryno);
            
            // Open MTOCProductListModal
            $("#mtoclistdialog").on('click', function(){
              setMTOCVariant($("#gridrowModelVariant").val());
            $("#MTOCProductListModal").modal('show');
            // alert($("#gridrowModelVariant").val());
              });

                $("#mtoc_table_grid").on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = $("#mtoc_table_grid").jqxGrid('getrowdata', row);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
        } // <---End of genMTOCGrid

function genActivityGrid(data){
                // alert(data);
                var ldata = new Array();
                var customer_list_source =
                {
                    localdata : ldata,
                    datatype: "json",
                    datafields: [
                        {name:'Customer_Id',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                        {name:'First_Name',type: 'string'},
                        {name:'Middle_Name',type: 'string'},
                        {name:'Mobile',type: 'string'},
                      ],
                };
            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                if (value.indexOf('#') != -1) {
                    value = value.substring(0, value.indexOf('#'));
                }
            var html = '<div style="margin-top: 8px;"><a href="../enquiry/enquirydetail.php?'+column+'='+value+'">'+value+'</a></div>';
                return html;
            };
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#activity_table_grid").jqxGrid('getdatainformation');
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
                 $("#activity_list_pager_info").html(label);
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
                     $("#activity_table_grid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#activity_table_grid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#activity_table_grid").on('pagechanged', function () {
             var datainfo = $("#activity_table_grid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#activity_table_grid").jqxGrid({
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
                  { text: 'Activity #', datafield:'Activity_Id', cellsrenderer: linkrenderer, width:'12%' },
                  { text: 'Type', datafield: 'Enquiry_Date',width:'8%'},
                  { text: 'Staus', datafield: 'Enquiry_Type', width:'10%'},
                  { text: 'Next Planned Date', datafield: 'Purchase_Type', cellsalign: 'left', width:'12%' },
                  { text: 'Start Date', datafield: 'Enquiry_Category', cellsalign: 'left', width:'12%'},
                  { text: 'Created By', datafield: 'Enquiry_Source', cellsalign: 'left', width:'12%' },
                  { text: 'First Name', datafield: 'Status', cellsalign: 'left', width:'5%' },
                  { text: 'Last Name', datafield: 'Sales_Stage', cellsalign: 'left', width:'10%' },
                  { text: 'End Date', datafield: 'Sales_Team', cellsalign: 'left', width:'12%' },
                  { text: 'Enquiry #', datafield: 'Enquiry_No', cellsalign: 'left', width:'12%' },
                  { text: 'Mobile #', datafield: 'mobile', cellsalign: 'left', width:'12%' },
                  { text: 'Model Category', datafield: 'Model_Category', cellsalign: 'left', width:'12%' },
                  { text: 'Model Name', datafield: 'Model_Name', cellsalign: 'left', width:'15%' },
                  { text: 'Model Variant', datafield: 'Model_Variant', cellsalign: 'left', width:'15%' },
                  { text: 'Purchase Type', datafield: 'Test_Ride_Date', cellsalign: 'left', width:'12%'},
                  { text: 'Remarks', datafield: 'Created_At', cellsalign: 'left', width:'12%'},
                ]
            });

                $("#activity_table_grid").on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = $("#activity_table_grid").jqxGrid('getrowdata', row);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
        } // <---End of genActivityGrid
        
function genBookingGrid(data){
                // alert(data);
                var ldata = new Array();
                if (data !=="Error") {
                  ldata = data;
                  $("#createNewBooking").attr('disabled',true);
                  $("#createNewBooking").css('background','none').css('border','none');
                }
                
                var customer_list_source =
                {
                    localdata : ldata,
                    datatype: "json",
                    datafields: [
                        {name:'Booking_No',type: 'string'},
                        {name:'Booking_Date',type: 'string'},
                        {name:'Booking_Status',type: 'string'},
                        {name:'Model_Variant',type: 'string'},
                        {name:'Model_Name',type: 'string'},
                        {name:'Model_Category',type: 'string'},
                      ],
                };
            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                if (value.indexOf('#') != -1) {
                    value = value.substring(0, value.indexOf('#'));
                }
            var html = '<div style="margin-top: 8px;"><a href="../booking/bookingdetail.php?'+column+'='+value+'">'+value+'</a></div>';
                return html;
            };
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#booking_table_grid").jqxGrid('getdatainformation');
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
                    var ir = 0;
                 }else{ir = 1;}
                 label.text(ir+" - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                 
                 $("#booking_list_pager_info").html(label);
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
                     $("#booking_table_grid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#booking_table_grid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#booking_table_grid").on('pagechanged', function () {
             var datainfo = $("#booking_table_grid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#booking_table_grid").jqxGrid({
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
                  { text: 'Booking Date', datafield: 'Booking_Date', cellsalign: 'left', width:'20%'},
                  { text: 'Model Category', datafield: 'Model_Category', cellsalign: 'left', width:'20%'},
                  { text: 'Model Name', datafield: 'Model_Name', cellsalign: 'left', width:'15%'},
                  { text: 'Model Variant', datafield:'Model_Variant', width:'20%' },
                  { text: 'Status', datafield:'Booking_Status', width:'10%' },
                ]
            });

                $("#booking_table_grid").on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = $("#booking_table_grid").jqxGrid('getrowdata', row);
               // alert(data.Customer_Id);
                  // fetchCustomer(data.Customer_Id);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
        } // <---End of genBookingGrid

function getMTOCProductListGrid(data){
                // alert(data);
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Model_Category',type: 'string'},
                        {name:'Model_Name',type: 'string'},
                        {name:'Model_Code',type: 'string'},
                        {name:'Model_Variant',type: 'string'},
                        {name:'Product_Name',type: 'string'},
                        {name:'Color_Name',type: 'string'},
                        {name:'Color_Code',type: 'string'},
                        {name:'Model_Type',type: 'string'},
                        {name:'Color_Id',type: 'integer'},
                      ],
                };
              
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
            var productnamecombiner = function(row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                var html = '<div style="margin: 8px 0px 0px 5px;">'+rowdata.Model_Code+rowdata.Model_Type+rowdata.Color_Code+'</div>';
                return html;
              };

             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#mtocproductlistGrid").jqxGrid('getdatainformation');
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
                    var ir = 0;
                 }else{ir = 1;}
                 label.text(ir+" - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                 $("#mtocproductlistPager").html(label);
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
                     $("#mtocproductlistGrid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#mtocproductlistGrid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#mtocproductlistGrid").on('pagechanged', function () {
             var datainfo = $("#mtocproductlistGrid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#mtocproductlistGrid").jqxGrid({
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
                  { text: 'Model Category', datafield: 'Model_Category',width:'15%'},
                  { text: 'Model Name', datafield: 'Model_Name', width:'20%'},
                  { text: 'Model Variant', datafield: 'Model_Variant', width:'25%'},
                  { text: 'Model Code', datafield: 'Model_Code', width:'15%'},
                  { text: 'Product Name', datafield:'Product_Name', cellsrenderer:productnamecombiner, width:'25%' },
                  { text: 'Color Name', datafield:'Color_Name', width:'25%' },
                  { text: 'Color Code', datafield:'Color_Code', width:'15%' },
                ]
            });

                $("#mtocproductlistGrid").on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = $("#mtocproductlistGrid").jqxGrid('getrowdata', row);
                  $("#selectedmodelcode").val(data.Model_Code);
                  $("#selectedmodeltype").val(data.Model_Type);
                  $("#selectedcolorid").val(data.Color_Id);
              });
        } // <---End of MTOCProductListModal

         $("#selectMTOCbtn").click(function(){
            var modelcode = $("#selectedmodelcode").val();
            var modeltype = $("#selectedmodeltype").val();
            var colorid = $("#selectedcolorid").val();
            if (modelcode =="" || modeltype =="" || colorid=="") {
              alert("Select Product!...");
            }else{
                
                $.ajax({
                  url : "../php_action/enquiry.php",
                  method:'post',
                  data:{updateProduct:"",
                        modelcode:modelcode,
                        modeltype:modeltype,
                        colorid:colorid,
                        enquiryno:enquiryno
                        },
                  datatype: 'JSON',
                  success : function(data, status){
                    // alert(data);
                    if (data = 'Enquiry Table Successfully Updated') {
                      genMTOCGrid("Default");
                      $("#MTOCProductListModal").modal('hide');
                    }else{
                      alert("Something Wrong");
                      }
                    }
                });
            }

      }); // End of selectMTOCbtn


  $("#enquiryMTOC").click(function(){
    // var enquiryno = $("#").val();
    $.ajax({
      url : "../php_action/fetchdata.php",
      method:'post',
      data:{mtocGrid:enquiryno},
      datatype: 'JSON',
      success : function(data, status){
        genMTOCGrid("Default");
      }
    });
});

  $("#enquiryBooking").click(function(){
    // var enquiryno = $(this).html();
    // alert(enquiryno);
    // genBookingGrid("mydata");
    $.ajax({
      url : "../php_action/fetchdata.php",
      method:'post',
      data:{fetchbookinglist:enquiryno},
      datatype: 'JSON',
      success : function(data, status){
        // alert(data);
        var bookingdata = $.parseJSON(data);
        genBookingGrid(bookingdata);
      }
    });
});
  

 // When MTOC Product Model shown 
 function setMTOCVariant(modelvariant){
        $.ajax({
          url: "../php_action/enquiry.php",
          datatype: "json",
          method: "post",
          data: {fetchAllProducts:modelvariant},
          success: function(data, status) {
            var productlistdata = $.parseJSON(data);
            getMTOCProductListGrid(productlistdata);
          }
   });
}
// $("#createNewBooking").add('disabled');
$("#createNewBooking").click(function(){
  $.ajax({
    url:"../php_action/enquiry.php",
    method:"POST",
    datatype:"JSON",
    data : {createnewbooking:"",enquiryno:enquiryno},
    success: function(data,status){
      // alert(data);
      $("#enquiryBooking").click();
    }
  }); // End of ajax

})


});