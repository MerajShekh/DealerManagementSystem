$(document).ready(function(){
	alert("ok");

function fetchData() {
	
}

	generateGrid();
	function generateGrid(){
              var tablegrid = $("#enquiry_table_grid");
              var ldata = new Array();
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
            }


})