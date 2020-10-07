<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>Data Table</title>
    <link rel="stylesheet" href="../assets/datagrid/jqwidgets/styles/jqx.base.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
    <script type="text/javascript" src="../assets/datagrid/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.columnsresize.js"></script> 
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxdata.export.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.export.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.edit.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxpanel.js"></script>
    <script type="text/javascript" src="../assets/datagrid/jqwidgets/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="generatedata.js"></script>
    <script type="text/javascript" src="../assets/datagrid/scripts/demos.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajax({
          url: "../php_action/fetchdata.php",
          datatype: "json",
          method: "post",
          data: {fetchAllcustomer:""},
          success: function(data, status) {
            var mydata = $.parseJSON(data);
            // alert(data);
            genCustomerGrid(mydata);


            $.each(mydata, function(key, value){
              // alert(value);
            });
          }
        });
            // alert("ok");
            var data = new Array();
            var firstNames =
            [
                "Andrew", "Nancy", "Shelley", "Regina", "Yoshi", "Antoni", "Mayumi", "Ian", "Peter", "Lars", "Petra", "Martin", "Sven", "Elio", "Beate", "Cheryl", "Michael", "Guylene"
            ];
            var lastNames =
            [
                "Fuller", "Davolio", "Burke", "Murphy", "Nagase", "Saavedra", "Ohno", "Devling", "Wilson", "Peterson", "Winkler", "Bein", "Petersen", "Rossi", "Vileid", "Saylor", "Bjorn", "Nodier"
            ];
            var productNames =
            [
                "Black Tea", "Green Tea", "Caffe Espresso", "Doubleshot Espresso", "Caffe Latte", "White Chocolate Mocha", "Cramel Latte", "Caffe Americano", "Cappuccino", "Espresso Truffle", "Espresso con Panna", "Peppermint Mocha Twist"
            ];
            var priceValues =
            [
                "2.25", "1.5", "3.0", "3.3", "4.5", "3.6", "3.8", "2.5", "5.0", "1.75", "3.25", "4.0"
            ];
            for (var i = 0; i < 200; i++) {
                var row = {};
                var productindex = Math.floor(Math.random() * productNames.length);
                var price = parseFloat(priceValues[productindex]);
                var quantity = 1 + Math.round(Math.random() * 10);
                row["firstname"] = firstNames[Math.floor(Math.random() * firstNames.length)];
                row["lastname"] = lastNames[Math.floor(Math.random() * lastNames.length)];
                row["productname"] = productNames[productindex];
                row["price"] = price;
                row["quantity"] = quantity;
                row["total"] = price * quantity;
                data[i] = row;
            }
            // genCustomerGrid(data)
            function genCustomerGrid(data){
                // alert(data);
                var customer_list_source =
                {
                    localdata : data,
                    datatype: "array",
                    datafields: [
                        {name:'Customer_Id',type: 'string'},
                        {name:'Title',type: 'string'},
                        {name:'First_Name',type: 'string'},
                      ],
                };
            
            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                if (value.indexOf('#') != -1) {
                    value = value.substring(0, value.indexOf('#'));
                }
            var html = '<div style="margin-top: 8px;"><a href=../customer/customerdetail.php?'+column+'='+value+'>'+value+'</a></div>';
                return html;
            };
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(customer_list_source);
            var self = this;
            var label = $("<div></div>");
             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = $("#grid").jqxGrid('getdatainformation');
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
                 label.text("1 - " + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                 label.appendTo($("#pagerlist"));
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
                     $("#grid").jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     $("#grid").jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             $("#grid").on('pagechanged', function () {
             var datainfo = $("#grid").jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });

            $("#grid").jqxGrid({
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
                  { text: 'First Name', datafield: 'First_Name', width: 100 },
                  { text: 'Last Name', datafield: 'lastname', width: 100 },
                  { text: 'Product', datafield: 'productname', width: 180 },
                  { text: 'Quantity', datafield: 'quantity', width: 80, cellsalign: 'right' },
                  { text: 'Unit Price', datafield: 'price', width: 90, cellsalign: 'right', cellsformat: 'c2' },
                  { text: 'Total', datafield: 'total', minwidth: 100, resizable: false, width: 'auto', cellsalign: 'right', cellsformat: 'c2' }
                ]
            }); 
        } // <---End of genCustomerGrid

 });
    </script>
</head>
<body class='default'>


    <div id='jqxWidget'>
        <div id="grid">
            
        </div>
        <div id="pagerlist"></div>
        <div style="margin-top: 30px;" id="eventlog"></div>
    </div>
</body>
</html>