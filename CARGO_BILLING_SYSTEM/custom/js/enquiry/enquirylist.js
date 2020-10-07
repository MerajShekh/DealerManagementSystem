$(document).ready(function () {

$("input, select").click(function(){
   $(this).addClass("bgchange");
    })

 $("input, select").on('blur',function(){
 $(this).removeClass("bgchange");
 })

//fetch all enquiries list
$.ajax({
	url: '../php_action/enquiry.php',
	method:'post',
	datatype:'json',
	data:{fetchenquirieslist:""},
	success: function(data,status){
		var fetcheddata = $.parseJSON(data);
		genEnquiryListGrid(fetcheddata);
	}
});

//fetch searched enquiries list
$("#c-l-go").click(function(){
    var searchedcol = $("#enquirygridcol").val();
    var searcheddata = $("#searchEnquiryfield").val();
    
    var lnth = searcheddata.length;
    if (searchedcol=="Enquiry_Date") {
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
        url: '../php_action/enquiry.php',
        method:'post',
        datatype:'json',
        data:{searchenquiries:"",searchedcol:searchedcol,searcheddata:searcheddata},
        success: function(data,status){
            var fetcheddata = $.parseJSON(data);
            genEnquiryListGrid(fetcheddata);
            // alert(data);
        }
    });
});


function genEnquiryListGrid(data){
				var tablegrid = $("#enquiryListTableGrid");
                var ldata = new Array();
                if (data!=0) {
                    ldata = data;
                }
                var customer_list_source =
                {
                    localdata : ldata,
                    datatype: "json",
                    datafields: [
                        {name:'Enquiry_No',type: 'string'},
                        {name:'Enquiry_Date',type: 'string'},
                        {name:'Enquiry_Source',type: 'string'},
                        {name:'Enquiry_Status',type: 'string'},
                        {name:'Enquiry_Type',type: 'string'},
                        {name:'Purchase_Type',type: 'string'},
                        {name:'Stage',type: 'string'},
                        {name:'Mobile',type: 'string'},
                        {name:'First_Name',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                        {name:'Model_Code',type: 'string'},
                        {name:'Model_Category',type: 'string'},
                        {name:'Model_Name',type: 'string'},
                        {name:'Model_Variant',type: 'string'},
                        {name:'DSE_F_Name',type: 'string'},
                        {name:'DSE_L_Name',type: 'string'},
                        {name:'Color_Name',type: 'string'},
                        {name:'F_Name',type: 'string'},
                        {name:'Booking_Date',type: 'string'},
                        {name:'Invoice_Date',type: 'string'},
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
              return '<div style="margin-top: 8px; margin-left:8px;"> '+rowdata.DSE_F_Name +" "+ rowdata.DSE_L_Name+'</div>';
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
                  { text: 'Enquiry #', datafield:'Enquiry_No', cellsrenderer: linkrenderer, width:'16%' },
                  { text: 'First Name', datafield: 'First_Name',width:'8%', cellsformat:'d'},
                  { text: 'Last Name', datafield: 'Last_Name', width:'8%'},
                  { text: 'Mobile #', datafield: 'Mobile', cellsalign: 'left', width:'8%' },
                  { text: 'Sales Cycle', datafield: 'Stage', cellsalign: 'left', width:'8%'},
                  { text: 'Assigned To (DSE)', datafield: '',cellsrenderer:dsedata, width:'10%' },
                  { text: 'Created Date', datafield: 'Enquiry_Date', cellsalign: 'left', width:'12%' },
                  { text: 'Stage 2 (Booking)', datafield: 'Booking_Date', cellsalign: 'left', width:'12%' },
                  { text: 'Stage 3 (Invoiced)', datafield: 'Invoice_Date', cellsalign: 'left', width:'12%' },
                  { text: 'Enquiry Type', datafield: 'Enquiry_Type', cellsalign: 'left', width:'5%' },
                  { text: 'Enquiry Source', datafield: 'Enquiry_Source', cellsalign: 'left', width:'12%' },
                  { text: 'Purchase Type', datafield: 'Purchase_Type', cellsalign: 'left', width:'12%' },
                  { text: 'Model Code', datafield: 'Model_Code', width:'8%' },
                  { text: 'Color', datafield: 'Color_Name', cellsalign: 'left', width:'7%' },
                  { text: 'Category', datafield: 'Model_Category', width:'8%'},
                  { text: 'Model Name', datafield: 'Model_Name', width:'8%'},
                  { text: 'Model Variant', datafield: 'Model_Variant', cellsalign: 'left', width:'12%'},
                  { text: 'Financier', datafield: 'F_Name', cellsalign: 'left', width:'12%'},
                  { text: 'Test Ride Date', datafield: 'Test_Ride_Date', cellsalign: 'left', width:'12%'},
                  { text: 'Status', datafield: 'Enquiry_Status', cellsalign: 'left', width:'12%'},

                ]
            });

                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
               fetchEnquiry(data.Enquiry_No);
              });
        } // <---End of genCustomerDetailGrid

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
                // alert(fetcheddata.Stage);
                $("#model_name").html('<option value="'+fetcheddata.Model_Name+'">'+fetcheddata.Model_Name+'</option>');
                $("#model_variant").html('<option value="'+fetcheddata.Model_Variant+'">'+fetcheddata.Model_Variant+'</option>');
                $("#enquiry_date").val(fetcheddata.Enquiry_Date);
                $("#enquiry_type").html('<option value="'+fetcheddata.Enquiry_Type+'">'+fetcheddata.Enquiry_Type+'</option>');
                $("#first_name").val(fetcheddata.First_Name);
                $("#enquiry_id").val(fetcheddata.Enquiry_No);
                $("#purchase_type").val(fetcheddata.Purchase_Type);
                $("#financier").html('<option value="'+fetcheddata.F_Name+'">'+fetcheddata.F_Name+'</option>');
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
            }

        }) // End ajax method------------->
    }

});