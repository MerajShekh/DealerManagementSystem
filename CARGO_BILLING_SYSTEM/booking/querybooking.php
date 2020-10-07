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
            // prepare the data
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
            var source =
            {
                localdata: data,
                datafields:
                [
                    { name: 'firstname', type: 'string' },
                    { name: 'lastname', type: 'string' },
                    { name: 'productname', type: 'string' },
                    { name: 'available', type: 'bool' },
                    { name: 'quantity', type: 'number' },
                    { name: 'price', type: 'number' },
                    { name: 'total', type: 'number' }
                ],
                datatype: "array"
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#grid").jqxGrid(
            {
                width: getWidth('Grid'),
                source: dataAdapter,
                selectionmode: 'multiplerowsextended',
                sortable: true,
                pageable: true,
                autoheight: true,
                columnsresize: true,
                filterable: true,
                showfilterrow: true,
                theme: 'exampleTheme',
                // pagermode: 'simple',
                columns: [
                  { text: 'First Name', datafield: 'firstname', width: 100 },
                  { text: 'Last Name', datafield: 'lastname', width: 100 },
                  { text: 'Product', datafield: 'productname', width: 180 },
                  { text: 'Quantity', datafield: 'quantity', width: 80, cellsalign: 'right' },
                  { text: 'Unit Price', datafield: 'price', width: 90, cellsalign: 'right', cellsformat: 'c2' },
                  { text: 'Total', datafield: 'total', minwidth: 100, resizable: false, width: 'auto', cellsalign: 'right', cellsformat: 'c2' }
                ]
            });

            $("#pdfexport").jqxButton();
            $("#pdfexport").click(function(){
               $("#grid").jqxGrid('exportdata', 'xls', 'jqxGrid');
               // alert("ok");
            });
            $("#columnchooser").jqxDropDownList({ 
                autoDropDownHeight: true,
                selectedIndex: -1,
                width: 200,
                height: 25,
                source: [{ label: 'First Name', value: 'firstname' },
                  { label: 'Last Name', value: 'lastname' },
                  { label: 'Product', value: 'productname' },
                  { label: 'Order Date', value: 'date' },
                  { label: 'Quantity', value: 'quantity' },
                  { label: 'Unit Price', value: 'price' },
                  { label: 'Unit Price', value: 'price' }
                ]
            });

            // handle columns selection.
            $("#columnchooser").on('select', function (event) {
                updateFilterBox(event.args.item.value);
            });

            // trigger the column resized event.
            $("#grid").on('columnresized', function (event) {
                var column = event.args.columntext;
                var newwidth = event.args.newwidth
                var oldwidth = event.args.oldwidth;
                $("#eventlog").text("Column: " + column + ", " + "New Width: " + newwidth + ", Old Width: " + oldwidth);
            });
        });
    </script>
</head>
<body class='default'>
    <div id="btncontainer">
        <button class="btn" id="pdfexport">Export</button>
        <input type="button" value="Export to CSV" id='csvExport'/>
        <div>
            <div id="columnchooser">ab</div>
            <div id="filterbox">adr</div>
            <div>
            <input type="button" value="Apply Filter" id='applyfilter'/>
            </div>
        </div>
    </div>

    <div id='jqxWidget'>
        <div id="grid">
            
        </div>
        <div style="margin-top: 30px;" id="eventlog"></div>
    </div>
</body>
</html>