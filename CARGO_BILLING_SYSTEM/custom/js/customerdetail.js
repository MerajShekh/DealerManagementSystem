$(document).ready(function () {
      
            $("input, select").click(function(){
            $(this).addClass("bgchange");
              })

            $("input, select").on('blur',function(){
            $(this).removeClass("bgchange");
            })

        // <------------ Data Grid---------------------------->
        // function customerenquirygrid(){
            var pagergrid = $("#enquiry_list_pager_info");
            var gridTable = $("#enquiry_table_grid");
            var customerid = $("#customerid").val();
            var source ="";
            // var customerid = "GJ13000119C00001";
            fetchState();
            fetchCustomer(customerid);
            
         fetchData();   
function fetchData(){
  // alert(customerid);
  $.ajax({
      url: "../php_action/customerdetail.php",
      method: "POST",
      data: {fetchenquiries:customerid},
      datatype:"JSON",
      success:function(data,status){
      var fetcheddata = $.parseJSON(data);
      // alert(data);
      genCustomerGrid(fetcheddata);
      genActivityGrid(fetcheddata);
    }
  }) // End ajax method------------->
}

            function genCustomerGrid(data){
              var tablegrid = $("#enquiry_table_grid");
              var ldata = new Array();
              if (data==0) {
                data = ldata;
              }
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Enquiry_No',type: 'string'},
                          {name:'Enquiry_Date',type: 'string'},
                          {name:'Enquiry_Type',type: 'string'},
                          {name:'Purchase_Type',type: 'string'},
                          {name:'Enquiry_Category',type: 'string'},
                          {name:'Enquiry_Source',type: 'string'},
                          {name:'Model_Category',type: 'string'},
                          {name:'Model_Name',type: 'string'},
                          {name:'Model_Variant',type: 'string'},
                          {name:'DSE_F_Name',type: 'string'},
                          {name:'DSE_L_Name',type: 'string'},
                          {name:'Enquiry_Status',type: 'string'},
                          {name:'Booking_Date',type: 'string'},
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
            var dsedata = function(row, columnfield, value, defaulthtml, columnproperties, rowdata){
              return '<div style="margin-top: 8px;">'+rowdata.DSE_F_Name +" "+ rowdata.DSE_L_Name+'</div>';
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
                 $("#enquiry_list_pager_info").html(label);
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
                  { text: 'Enquiry#', datafield:'Enquiry_No', cellsrenderer: linkrenderer, width:'18%' },
                  { text: 'Enquiry Date', datafield: 'Enquiry_Date',width:'8%'},
                  { text: 'Enquiry Type', datafield: 'Enquiry_Type', width:'10%'},
                  { text: 'Purchase Type', datafield: 'Purchase_Type', cellsalign: 'left', width:'12%' },
                  { text: 'Enquiry Category', datafield: 'Enquiry_Category', cellsalign: 'left', width:'12%'},
                  { text: 'Enquiry Source', datafield: 'Enquiry_Source', cellsalign: 'left', width:'12%' },
                  { text: 'Status', datafield: 'Enquiry_Status', cellsalign: 'left', width:'5%' },
                  { text: 'Model Category', datafield: 'Model_Category', cellsalign: 'left', width:'12%' },
                  { text: 'Model Name', datafield: 'Model_Name', cellsalign: 'left', width:'12%' },
                  { text: 'Model Variant', datafield: 'Model_Variant', cellsalign: 'left', width:'12%' },
                  { text: 'Stage 2 (Booking Date)', datafield: 'Booking_Date', cellsalign: 'left', width:'15%' },
                  { text: 'Stage 3 (Invoiced Date)', datafield: 'Invoice_Date', cellsalign: 'left', width:'15%' },
                  { text: 'Test Ride Date', datafield: 'Test_Ride_Date', cellsalign: 'left', width:'12%'},
                  { text: 'Assigned To (DSE)', datafield: 'DSE_F_Name', cellsrenderer: dsedata, cellsalign: 'left', width:'12%'},
                ]
            });

                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
            }

      function genActivityGrid(data){
              var tablegrid = $("#activity_table_grid");
              var ldata = new Array();

                var customer_list_source =
                {
                    localdata : data,
                    datatype: "json",
                    datafields: [
                        {name:'Enquiry_No',type: 'string'},
                          {name:'Enquiry_Date',type: 'string'},
                          {name:'Enquiry_Type',type: 'string'},
                          {name:'Purchase_Type',type: 'string'},
                          {name:'Enquiry_Category',type: 'string'},
                          {name:'Enquiry_Source',type: 'string'},
                          {name:'Model_Category',type: 'string'},
                          {name:'Model_Name',type: 'string'},
                          {name:'Model_Variant',type: 'string'},
                          {name:'DSE_F_Name',type: 'string'},
                          {name:'DSE_L_Name',type: 'string'},
                          {name:'Enquiry_Status',type: 'string'},
                          {name:'Booking_Date',type: 'string'},
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
            var dsedata = function(row, columnfield, value, defaulthtml, columnproperties, rowdata){
              return '<div style="margin-top: 8px;">'+rowdata.DSE_F_Name +" "+ rowdata.DSE_L_Name+'</div>';
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
                  { text: 'Enquiry#', datafield:'Enquiry_No', cellsrenderer: linkrenderer, width:'18%' },
                  { text: 'Enquiry Date', datafield: 'Enquiry_Date',width:'8%'},
                  { text: 'Enquiry Type', datafield: 'Enquiry_Type', width:'10%'},
                  { text: 'Purchase Type', datafield: 'Purchase_Type', cellsalign: 'left', width:'12%' },
                  { text: 'Enquiry Category', datafield: 'Enquiry_Category', cellsalign: 'left', width:'12%'},
                  { text: 'Enquiry Source', datafield: 'Enquiry_Source', cellsalign: 'left', width:'12%' },
                  { text: 'Status', datafield: 'Enquiry_Status', cellsalign: 'left', width:'5%' },
                  { text: 'Model Category', datafield: 'Model_Category', cellsalign: 'left', width:'12%' },
                  { text: 'Model Name', datafield: 'Model_Name', cellsalign: 'left', width:'12%' },
                  { text: 'Model Variant', datafield: 'Model_Variant', cellsalign: 'left', width:'12%' },
                  { text: 'Stage 2 (Booking Date)', datafield: 'Booking_Date', cellsalign: 'left', width:'15%' },
                  { text: 'Stage 3 (Invoiced Date)', datafield: 'Invoice_Date', cellsalign: 'left', width:'15%' },
                  { text: 'Test Ride Date', datafield: 'Test_Ride_Date', cellsalign: 'left', width:'12%'},
                  { text: 'Assigned To (DSE)', datafield: 'DSE_F_Name', cellsrenderer: dsedata, cellsalign: 'left', width:'12%'},
                ]
            });

                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
                  $("#selectcustomerid").val(data.Customer_Id);
              });
            }
            
    // fetch customer detail by customerID
    function fetchCustomer(id){
        $.ajax({
            url: "../php_action/customerdetail.php",
            method: "POST",
            data: {fetchcustomerid:id},
            datatype:"JSON",
            success:function(data,status){
                var fetcheddata = $.parseJSON(data);// decode JSON data----->
                // $("#searchtxt").val(fetcheddata.First_Name);
                $("#firstname").val(fetcheddata.First_Name);
                $("#middlename").val(fetcheddata.Middle_Name);
                $("#lastname").val(fetcheddata.Last_Name);
                // $("#relation").html('<option value="'+fetcheddata.Relation+'">'+fetcheddata.Relation+'</option>');
                // $("#relation").append('<option value="'+fetcheddata.Relation+'">'+fetcheddata.Relation+'</option>');
                $("#relationname").val(fetcheddata.Relative_Name);
                $("#mobilenum").val(fetcheddata.Mobile);
                $("#email").val(fetcheddata.Email);
                $("#gender").val(fetcheddata.Gender);
                $("#address1").val(fetcheddata.Address1);
                $("#address2").val(fetcheddata.Address2);
                $("#city").html('<option value="'+fetcheddata.City_Id+'">'+fetcheddata.City_Name+'</option>');
                $("#pincode").val(fetcheddata.Pin_Code);
                $("#state").val(fetcheddata.State);
                // $("#state").html('<option value="'+fetcheddata.State+'">'+fetcheddata.State+'</option>');
                $("#CreatedDate").val(fetcheddata.Creation_Date);
                // alert(fetcheddata.Title);
            }

        }) // End ajax method------------->
    } // End fetchCustomer function------------->
    // $("#relation").click(function(){
    //   $(this).html('<option value="SO">SO</option><option value="DO">DO</option>');
    //   $(this).change(function(){
    //     $("#relation").html('<option value="'+this.value+'">'+this.value+'</option>');
    //     alert(this.value);
    //   })

    // })


    function fetchEnquiry(customerid){
        $.ajax({
            url: "../php_action/customerdetail.php",
            method: "POST",
            data: {fetchenquiries:customerid},
            datatype:"JSON",
            success:function(data,status){
                var fetcheddata = $.parseJSON(data);// decode JSON data----->
                // $("#searchtxt").val(fetcheddata.First_Name);
            }
        }) // End ajax method------------->
    } // End fetchCustomer function------------->

    $("#saveCustomerDetail").click(function(){
        if ($("#pincode").val().length<6 || $("#city").val()=="" || $("#state").val()=="" || $("#address1").val()=="" || $("#mobilenum").val()=="" || $("#firstname").val()=="") {
          alert("Fill all required fiels!");
        }else{
          $.ajax({
              url: "../php_action/customerdetail.php",
              method: "POST",
              datatype:"JSON",
              data: $("#customerDetailForm").serialize(),
              success:function(data,status){
                  // alert(data);
                  fetchCustomer(customerid);
              }
          })
        }
    });

    
// $("#state option").text("meraj");
    function fetchState(){
      var html = '<option value=""></option>';
      $.ajax({
            url: "../php_action/customerdetail.php",
            method: "POST",
            datatype:"JSON",
            data: {fetchState:""},
            success:function(data,status){
              var stateData = $.parseJSON(data);
                $.each(stateData, function(key, value){
                // alert(value);
                html += '<option value="'+value+'">'+value+'</option>';
                })
                $("#state").html(html);
            }
        })
    }

// fetch Cities on State element change
$("#state").on('change', function(){

  var state = this.value;
  fetchCity(state);
})

// fetch City
function fetchCity(state){
    // alert(state);
      var html = '<option value=""></option>';
      $.ajax({
            url: "../php_action/customerdetail.php",
            method: "POST",
            datatype:"JSON",
            data: {fetchCity:"", state: state},
            success:function(data,status){
              var cityData = $.parseJSON(data);
              // alert(cityData.City_Id);
                $.each(cityData, function(key, value){
                // alert(value.City_Name);
                html += '<option value="'+value.City_Id+'">'+value.City_Name+'</option>';

                })
                $("#city").html(html);
            }
        })
    }  // /. fetch city---->


// When New Enquiry Model shown 
$("#newEnquiry").on('shown.bs.modal', function(){
    // $("#newEnquiryForm").trigger('reset');
    $("#newEnquiry").modal({
        // backdrop:'static',
        keyboard: false,
        // clickClose: false,
        // showClose: false
    });
    getDSE(); //<------ call getDSE function
    function getDSE(){
      // alert("function called");
      var html = '<option value=""></option>';
      $.ajax({
        url :"../php_action/customerdetail.php",
        method: 'post',
        datatype : 'json',
        data : {fetchDSE:""},
        success : function(data){
          var dseList = $.parseJSON(data);
            $.each(dseList, function(key, value){
              // alert(value.DSE_Id);
              html += '<option value="'+value.DSE_Id+'">'+value.DSE_F_Name+" "+value.DSE_L_Name+'</option>';
            })
            $("#inputDSE").html(html); 
        }
      });
    }

    function getData(grid, id, data, fetcheddata){
      // alert(data);
      var a = fetcheddata;
      var html = '<option value=""></option>';
    $.ajax({
          url: "../php_action/fetchdata.php",
          datatype: "json",
          method: "post",
          data: {id:id, data:data, fetcheddata: fetcheddata},
          success: function(data, status) {
            // alert(data);
            var mydata = $.parseJSON(data);
            $.each(mydata, function(key, value){
              // alert(value);
              html += '<option value="'+value+'">'+value+'</option>';
            })
            $("#"+grid).html(html);
            
          }
        });
   }

    $("#inputModelCate").on('change', function(){
      var mcat = this.value;
      $("#inputModelName").html('<option value=""></option>');
      // alert(this.value);
      if (mcat !='') {

      getData("inputModelName", "Model_Category", mcat, "Model_Name");
      $("#inputModelVariant").html('<option value=""></option>');
      }else{

        $("#inputModelName").html('<option value=""></option>');
        $("#inputModelVariant").html('<option value=""></option>');
      }
    }); // /.ModelCategoryChagenEvent

    $("#inputModelName").on('change', function(){
      if (this.value !='') {
      getData("inputModelVariant", "Model_Name", this.value, "Model_Variant");
      }else{
        $("#inputModelVariant").html('<option value=""></option>');
      }
    });  // /.ModelNameChagenEvent

}); // /. End of Enquiry Model shown event

// 
$("#createEnquiryModalbtn").click(function(){
  
  var isValid;
  var newEnquiryFormData = $("#newEnquiryForm").serialize();
  $("#newEnquiryForm select").each(function(){
    if ($(this).val()!=="") {
      isValid = 1;
    }else{
      isValid = 0;
    }
  });

  if (isValid) {
    // alert("All value set "+isValid);
    // alert(fdata);
    $.ajax({
      url : "../php_action/enquiry.php",
      method: "POST",
      datatype:"JSON",
      data: newEnquiryFormData,
      success:function(data,status){
            // alert(data);
            $("#newEnquiryForm").trigger('reset');
            $("#newEnquiry").modal('hide');
            fetchData();
       }

    });
  }else{
    alert("Please select");
  }
});

function function_name(argument) {
  // body...
}

var sourcet = ["Cash2","Finance"];

$("#inputPurType, #inputEnqType, #inputEnqSource, #inputEnqCate, #inputFinancier, #inputDSE, #inputModelCate, #inputModelName, #inputModelVariant").select2({
  width:150,
  placeholder : "Select Data"
});
    
}); // End Document ready function----------------->