// function currentMenu(e) {

// 				alert(e);
//                 $(e).addClass("active");
//                 alert(e.className);
// 			// document.getElementById('subMenu').innerHTML=e;
// 			}

 function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function myFunction2() {
	var x = document.getElementById("submenu");
	if (x.className === "submenu") {
	x.className += " responsive";
	} else {
	x.className = "submenu";
	}
	//alert(e);
}

// DataGrid------------------------------>
function genGrid(id)
{
// alert(id);
var data = new Array();
            var firstNames =
            [
                "Andrew", "Nancy", "Shelley", "Regina", "Yoshi"
            ];
            var lastNames =
            [
                "Fuller", "Davolio", "Burke", "Murphy", "Nagase"
            ];
            var productNames =
            [
                "Black Tea", "Green Tea", "Caffe Espresso", "Doubleshot Espresso", "Caffe Latte"
            ];
            var priceValues =
            [
                "2.25", "1.5", "3.0", "3.3", "4.5"
            ];
            for (var i = 0; i < 20; i++) {
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
                    { name: 'total', type: 'number' },
                    { name: 'gst', type: 'number' }
                ],
                datatype: "array"
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#act_grid").jqxGrid(
            {
                // width: getWidth('Grid'),
                width: '100%',
                source: dataAdapter,
                selectionmode: 'singlerowsextended',
                sortable: true,
                pageable: true,
                autoheight: true,
                columnsresize: true,
                // filterable: true,
                // showfilterrow: true,
                theme: 'exampleTheme',
                // pagermode: 'simple',
                columns: [
                  { text: 'First', datafield: 'firstname', width: 100 },
                  { text: 'Last Name', datafield: 'lastname', width: 100 },
                  { text: 'Product', datafield: 'productname', width: 180 },
                  { text: 'Available', datafield: 'available', width: 180 },
                  { text: 'GST', datafield: 'gst', width: 100 },
                  { text: 'Quantity', datafield: 'quantity', width: 80, cellsalign: 'right' },
                  { text: 'Unit Price', datafield: 'price', width: 90, cellsalign: 'right', cellsformat: 'c2' },
                  { text: 'Total', datafield: 'total', minwidth: 100, resizable: false, width: 'auto', cellsalign: 'right', cellsformat: 'c2' }
                ]

            });
// alert("end of function");
}

// /////////Enquirylist

// function Querymtoc(e){
// 	// alert(e);

// 	$("#Act").html("hello");
// 	$("#act_go").show();
// }

// search mtoc query
function demofun()
{
	$("#Act").jqxGrid();
}

// $("#mtoc_go").invisble();

// enquirylist
$(document).ready(function(){
$("#go").hide();

$("#query").click(function(){
	// alert("click");
	$("#go").show();
	$("#query").hide();

});
 
// $("#act_go").hide();
$("#act_form").hide();

$("#act_query").on('click',function(){
$("#act_form").show();
$("#act_grid").hide();
// $("#Act").jqxGrid('destroy');
	// $("#act_go").show();
	// $("#act_query").hide();
// $("#Act").clear();

});

$("#act_go").on('click',function(){

$("#act_form").hide();
$("#act_grid").show();
// genGrid();
// $("#act_grid").jqxGrid('refreshdata');

// alert($("#Act").html());
// $("#act_go").hide();
// $("#act_query").show();

});


// Data Grid
			var data = new Array();
            var firstNames =
            [
                "Andrew", "Nancy", "Shelley", "Regina", "Yoshi"
            ];
            var lastNames =
            [
                "Fuller", "Davolio", "Burke", "Murphy", "Nagase"
            ];
            var productNames =
            [
                "Black Tea", "Green Tea", "Caffe Espresso", "Doubleshot Espresso", "Caffe Latte"
            ];
            var priceValues =
            [
                "2.25", "1.5", "3.0", "3.3", "4.5"
            ];
            for (var i = 0; i < 20; i++) {
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
                    { name: 'total', type: 'number' },
                    { name: 'gst', type: 'number' }
                ],
                datatype: "array"
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#mtocgrid").jqxGrid(
            {
                // width: getWidth('Grid'),
                width: '100%',
                source: dataAdapter,
                selectionmode: 'singlerowsextended',
                sortable: true,
                pageable: true,
                autoheight: true,
                columnsresize: true,
                // filterable: true,
                // showfilterrow: true,
                theme: 'exampleTheme',
                // pagermode: 'simple',
                columns: [
                  { text: 'Name', datafield: 'firstname', width: 100 },
                  { text: 'Last Name', datafield: 'lastname', width: 100 },
                  { text: 'Product', datafield: 'productname', width: 180 },
                  { text: 'Available', datafield: 'available', width: 180 },
                  { text: 'GST', datafield: 'gst', width: 100 },
                  { text: 'Quantity', datafield: 'quantity', width: 80, cellsalign: 'right' },
                  { text: 'Unit Price', datafield: 'price', width: 90, cellsalign: 'right', cellsformat: 'c2' },
                  { text: 'Total', datafield: 'total', minwidth: 100, resizable: false, width: 'auto', cellsalign: 'right', cellsformat: 'c2' }
                ]

            });

            var xbtn = $("#btn-container").html($("#pdfexport").jqxButton());
            alert(xbtn);
            $("#pdfexport").click(function(){
               $("#grid").jqxGrid('exportdata', 'xls', 'jqxGrid');
               // alert("ok");
            });
            $("#columnchooser").jqxDropDownList({ 
                autoDropDownHeight: true,
                selectedIndex: 0,
                width: 200,
                height: 25,
                source: [{ label: 'First Name', value: 'firstname' },
                  { label: 'Last Name', value: 'lastname' },
                  { label: 'Product', value: 'productname' },
                  { label: 'Order Date', value: 'date' },
                  { label: 'Quantity', value: 'quantity' },
                  { label: 'Unit Price', value: 'price' }
                ]
            });

            // handle columns selection.
            $("#columnchooser").on('select', function (event) {
                updateFilterBox(event.args.item.value);
            });

            // trigger the column resized event.
            $("#mtocgrid").on('columnresized', function (event) {
                var column = event.args.columntext;
                var newwidth = event.args.newwidth
                var oldwidth = event.args.oldwidth;
                $("#eventlog").text("Column: " + column + ", " + "New Width: " + newwidth + ", Old Width: " + oldwidth);
            });

});
