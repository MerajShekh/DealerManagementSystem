$(document).ready(function(){

$("input, select").click(function(){
   $(this).addClass("bgchange");
    })

 $("input, select").on('blur',function(){
 $(this).removeClass("bgchange");
 })

$("#exportbtn").click(function(){
    $("#invoiceListTableGrid").jqxGrid('exportdata', 'xls', 'Output');
});


// fetch Invoice Data for Detail
function fetchVehicleData(data){
  $.ajax({
        url: "../php_action/inventory.php",
        method: "POST",
        datatype:"JSON",
        data: {fetchframedetail:"",frame:data},
        success:function(data,status){
        var fetcheddata = $.parseJSON(data);// decode JSON data----->
            // alert(fetcheddata.Frame_No);
            $("#frame").val(fetcheddata.Frame_No);
            $("#engine").val(fetcheddata.Engine_No);
            $("#registration").val(fetcheddata.Registration_No);
            $("#physicalstatus").val(fetcheddata.Physical_Status);
            $("#invoiceno").val(fetcheddata.SAP_Invoice_No);
            $("#invoicedate").val(fetcheddata.SAP_Invoice_Date);
            $("#manufacturedate").val(fetcheddata.Manufacturing_Date);
            $("#dlrinvoicedate").val(fetcheddata.Invoice_Date);
            $("#modelcategory").val(fetcheddata.Model_Category);
            $("#modelname").val(fetcheddata.Model_Name);
            $("#modelvariant").val(fetcheddata.Model_Variant);
            $("#vehiclestatus").val(fetcheddata.Vehicle_Status);
            $("#fisrtname").val(fetcheddata.First_Name);
            $("#lastname").val(fetcheddata.Last_Name);
            $("#sellingdlr").val("Cargo Motors Pvt Ltd");
            $("#location").val(fetcheddata.Inventory_Location);

        }
    })
}
fetchVehiclelistData();
function fetchVehiclelistData(){
    $.ajax({
        url: '../php_action/inventory.php',
        method:'post',
        datatype:'json',
        data:{fetchvehiclesgrid:""},
        success: function(data,status){
            // var fetcheddata = $.parseJSON(data);
            genVehiclesListGrid(data);
            // alert(data);
        }
    });
}

$("#gobtn").click(function(){
    var searcheddata = $("#searchVehicleData").val();
    var searchedcol = $("#gridcol").val();
    var lnth = searcheddata.length;
    if (searchedcol=="SAP_Invoice_Date") {
        var dd = mm = yy ="";
        if(searcheddata.indexOf("/")==3 || searcheddata.indexOf("/")==4){
            if (searcheddata.indexOf("/")==3) {
                dd = searcheddata.substr(1,2);
                mm = searcheddata.substr(4,2);
                yy = searcheddata.substr(7,4);
                searcheddata = (searcheddata.substring(0,1)+" '"+yy+"-"+mm+"-"+dd+"'");
                alert(searcheddata);
            }else{
                dd = searcheddata.substr(2,2);
                mm = searcheddata.substr(5,2);
                yy = searcheddata.substr(8,4);
                searcheddata = (searcheddata.substring(0,2)+" '"+yy+"-"+mm+"-"+dd+"'");
                alert(searcheddata);
            }
        }else{
            alert("put valid date");
        }
    }else{
        if (searcheddata.indexOf("*")==0) {
            searcheddata = searcheddata.replace("*","%");   
        }else if (searcheddata.indexOf("*")+1==lnth) {
            searcheddata = searcheddata.replace("*","%");
        }else{}
    }

    $.ajax({
        url: '../php_action/inventory.php',
        method:'post',
        datatype:'json',
        data:{searcheddata:searcheddata,searchedcol:searchedcol},
        success: function(data,status){
            // var fetcheddata = $.parseJSON(data);
            genVehiclesListGrid(data);
            // alert(data);
        }
    });
});


// genVehiclesListGrid("da");
function genVehiclesListGrid(data){
                // alert(data);
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
                        {name:'First_Name',type: 'string'},
                        {name:'Last_Name',type: 'string'},
                        {name:'Frame_No',type: 'string'},
                        {name:'Model_Category',type: 'string'},
                        {name:'Model_Name',type: 'string'},
                        {name:'Model_Variant',type: 'string'},
                        {name:'Model_Code',type: 'string'},
                        {name:'Model_Type',type: 'string'},
                        {name:'Color_Code',type: 'string'},
                        {name:'Engine_No',type: 'string'},
                        {name:'Emission_Norms',type: 'string'},
                        {name:'Color_Name',type: 'string'},
                        {name:'SAP_Invoice_No',type: 'string'},
                        {name:'SAP_Invoice_Date',type: 'string'},
                        {name:'Vehicle_Status',type: 'string'},
                        {name:'Physical_Status',type: 'string'},
                        {name:'Inventory_Location',type: 'string'},
                        {name:'Manufacturing_Date',type: 'string'},
                        {name:'Invoice_Date',type: 'string'},
                        {name:'Invoice_No',type: 'string'},
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
                  { text: 'Vehicle Status', datafield:'Vehicle_Status' ,width:'10%' },
                  { text: 'SAP Invoice #', datafield: 'SAP_Invoice_No',width:'8%'},
                  { text: 'Customer Name', datafield: 'First_Name',width:'8%' },
                  { text: 'Category', datafield: 'Model_Category', width:'7%' },
                  { text: 'Model Name', datafield: 'Model_Name',width:'8%' },
                  { text: 'Model Variant', datafield: 'Model_Variant',width:'10%' },
                  { text: 'Model Code', datafield: 'Model_Code',width:'8%' },
                  { text: 'Product', datafield: 'Product',cellsrenderer:motcrendered, width:'10%' },
                  { text: 'Engine #', datafield: 'Engine_No' ,width:'10%'},
                  { text: 'Frame #', datafield: 'Frame_No',width:'12%' },
                  { text: 'Color', datafield: 'Color_Name',width:'8%' },
                  { text: 'Color Code', datafield: 'Color_Code',width:'8%' },
                  { text: 'Manufacturing Date', datafield: 'Manufacturing_Date',width:'8%' },
                  { text: 'Emission Norms', datafield: 'Emission_Norms',width:'8%' },
                  { text: 'Physical Status', datafield: 'Physical_Status',width:'8%' },
                  { text: 'SAP Invoice Date', datafield: 'SAP_Invoice_Date',width:'8%' },
                  { text: 'Inventory Location', datafield: 'Inventory_Location',width:'8%' },
                  { text: 'Dlr Invoice No', datafield: 'Invoice_No',width:'8%' },
                  { text: 'Dlr Invoice Date', datafield: 'Invoice_Date',width:'8%' },
                  { text: 'HSN Code', datafield: 'HSN_Code',width:'8%' },
                ]
            });
                tablegrid.on('rowselect', function (event) {
               var row = event.args.rowindex;
               var data = tablegrid.jqxGrid('getrowdata', row);
               // alert(data.Frame_No);
               fetchVehicleData(data.Frame_No);
              });
        } // <---End of genCustomerDetailGrid

});