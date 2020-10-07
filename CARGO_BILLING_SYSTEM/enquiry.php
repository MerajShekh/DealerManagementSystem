<!-- files css,js,etc -->
<?php require_once "./includes/header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>JavaScript Chart with Grid example</title>
    <meta name="description" content="This is an example of Javascript Chart with Grid control." />
    <meta name="description" content="This is an example of Javascript Chart Export to JPEG, PNG and PDF." />
    <link rel="stylesheet" href="assets/datagrid/jqwidgets/styles/jqx.base.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />	
    <!-- <script type="text/javascript" src="assets/datagrid/scripts/jquery-1.11.1.min.js"></script> -->
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxchart.core.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxdata.export.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="assets/datagrid/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="assets/datagrid/scripts/demos.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
		var sampleData = new Array();
        	$.ajax({
        		url:'php_action/report.php',
        		method:'post',
        		datatype:'json',
        		success: function(data,status){
        			var fetcheddata = $.parseJSON(data);
        			setData(fetcheddata);
        		}
        	})
        	// alert(sampleData);
        	function setData(data)
        	{
        		sampleData = data;
        	
            // prepare chart data as an array
            // var sampleData = [
            //         { Day: 'Monday', Keith: 30, Erica: 15, George: 25 },
            //         { Day: 'Tuesday', Keith: 25, Erica: 25, George: 30 },
            //         { Day: 'Wednesday', Keith: 30, Erica: 20, George: 25 },
            //         { Day: 'Thursday', Keith: 35, Erica: 25, George: 45 },
            //         { Day: 'Friday', Keith: 20, Erica: 20, George: 25 },
            //         { Day: 'Saturday', Keith: 30, Erica: 20, George: 30 },
            //         { Day: 'Sunday', Keith: 60, Erica: 45, George: 90 }
            // ];
            // prepare jqxChart settings
            
            var settings = {
                title: "Fitness & exercise weekly scorecard",
                description: "Time spent in vigorous exercise",
                enableAnimations: true,
                showLegend: true,
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                xAxis:
                    {
                        dataField: 'Model',
                        gridLines: { visible: true }
                    },
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            columnsGapPercent: 50,
                            seriesGapPercent: 0,
                            valueAxis:
                            {
                                visible: true,
                                unitInterval: 10,
                                minValue: 0,
                                maxValue: 100,
                                title: { text: 'Time in minutes' }
                            },
                            series: [
                                    { dataField: 'Enquiry', displayText: 'Enquiry' },
                                    { dataField: 'Booking', displayText: 'Booking' },
                                    { dataField: 'Invoice', displayText: 'Invoice' }
                                    
                            ]
                        }
                    ]
            };
            // setup the chart
            $('#jqxChart').jqxChart(settings);
            var adapter = new $.jqx.dataAdapter({
                datafields: [
                    { name: "Model", type: "string" },
                    { name: "Enquiry", type: "string" },
                    { name: "Booking", type: "string" },
                    { name: "Invoice", type: "string" },
                    
                ],
                localdata: sampleData,
                datatype: 'json'
            });
            $("#jqxGrid").jqxGrid({
                width: 848,
                height: 232,
                filterable: true,
                showfilterrow: true,
                source: adapter,
                columns:
                [
                    { text: "Model", width: '34%', datafield: "Model", filteritems: data, filtertype: "checkedlist" },
                    { text: "Enquiry", width: '22%', datafield: "Enquiry"},
                    { text: "Booking", width: '22%', datafield: "Booking"},
                    { text: "Invoice", width: '22%', datafield: "Invoice"},
                ]
            });
            $("#jqxGrid").on('filter', function () {
                var rows = $("#jqxGrid").jqxGrid('getrows');
                var chart = $('#jqxChart').jqxChart('getInstance');
                chart.source = rows;
                chart.update();
            });

            $("#printbtn").click(function () {
                var content = $('#jqxChart')[0].innerHTML;
                var newWindow = window.open('', '', 'width=800, height=500'),
                document = newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>' +
                    '<html>' +
                    '<head>' +
                    '<meta charset="utf-8" />' +
                    '<title>jQWidgets Chart</title>' +
                    '</head>' +
                    '<body>' + content + '</body></html>';
                try
                {
                    document.write(pageContent);
                    document.close();
                    newWindow.print();
                    newWindow.close();
                }
                catch (error) {
                }
            });

            $("#pdfbtn").click(function () {
                // call the export server to create a JPEG image
                $('#jqxChart').jqxChart('saveAsPDF', 'myChart.jpeg', getExportServer());
            });

        	}
        });
    </script>
</head>
<body class='default'>
    <div id="jqxGrid"></div>
    <div id='jqxChart' style="margin-top: 50px; width: 850px; height: 400px; position: relative; left: 0px; top: 0px;">
    </div>
    <div class="example-description">
    	<div><input type="button" name="" id="printbtn" value="Print"></div>
    	<div><input type="button" name="" id="pdfbtn" value="Save PDF"></div>
    </div>
</body>
</html>