<!-- files css,js,etc -->
<?php 
session_start();
    include "../includes/header.php";
    include "../includes/chartapi.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>JavaScript Chart with Grid example</title>
        <script type="text/javascript">
        $(document).ready(function () {
            
        
         $("#todate").val(getDate());
         $("#fromdate").val(getDate());   

		var sampleData = new Array();
        function getDate(){
            var date = new Date();
            var dd = date.getDate();
            var mm = date.getMonth()+1;
            var yy = date.getFullYear();
            if (mm<10) {mm='0'+mm;}
            if (dd<10) {dd='0'+dd;}
            // var validdate = dd+ "-" +mm+ "-"+yy;
            var validdate = yy+ "-" +mm+ "-"+dd;
            return validdate;
        }
        
        fetchdata();
        function fetchdata(){
            var fdate = $("#fromdate").val();
            var tdata = $("#todate").val();
        	$.ajax({
        		url:'../php_action/report.php',
        		method:'post',
        		datatype:'json',
                data: {mtddata:"",fdate:fdate},
        		success: function(data,status){
        			var fetcheddata = $.parseJSON(data);
                    
        			getMTDModelChart(fetcheddata);
                    // getMTDDSEChart(fetcheddata)
        		}
        	});
            //MTD DSE wise Performance
            
            $.ajax({
                url:'../php_action/report.php',
                method:'post',
                datatype:'json',
                data: {MTDDSEData:""},
                success: function(data,status){
                    var fetcheddata = $.parseJSON(data);
                    getMTDDSEChart(fetcheddata);
                }
            });
        }//End of function

        	// alert("sampleData");
        	function getMTDModelChart(data)
        	{
                var tablegrid = $("#modelGrid");
                var tablechart = $("#modelChart");
        		sampleData = data;
        	
            
            var settings = {
                title: "Month Till Date Chart",
                description: "Month Till Date Modelwise Enquiry Booking Invoice",
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
            tablechart.jqxChart(settings);
            var adapter = new $.jqx.dataAdapter({
                datafields: [
                    { name: "Model", type: "string" },
                    { name: "Enquiry", type: "string" },
                    { name: "Booking", type: "string" },
                    { name: "Invoice", type: "string" },
                    { name: "ratio", type: "string" },

                ],
                localdata: sampleData,
                datatype: 'json'
            });
            var linkrenderer = function (row, column, value) {
            return '<div style="margin-left: 8px;">'+value+'%</div>';
            };
            tablegrid.jqxGrid({
                width: 848,
                height: 232,
                filterable: true,
                showfilterrow: true,
                source: adapter,
                showstatusbar: true,
                statusbarheight: 30,
                showaggregates: true,
                columns:
                [
                    { text: "Model", width: '34%', datafield: "Model", filteritems: data, filtertype: "checkedlist" },
                    { text: "Enquiry", width: '17%', datafield: "Enquiry",aggregates: ['sum']},
                    { text: "Booking", width: '17%', datafield: "Booking",aggregates: ['sum']},
                    { text: "Invoice", width: '17%', datafield: "Invoice",aggregates: ['sum']},
                    { text: "Conversion", width: '15%', datafield: "ratio",cellsrenderer:linkrenderer},
                ]
            });
            tablegrid.on('filter', function () {
                var rows = tablegrid.jqxGrid('getrows');
                var chart = tablechart.jqxChart('getInstance');
                chart.source = rows;
                chart.update();
            });

            $("#modelprintbtn").click(function () {
                var content = tablechart[0].innerHTML;
                var newWindow = window.open('', '', 'width=800, height=500'),
                document = newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>' +
                    '<html>' +
                    '<head>' +
                    '<meta charset="utf-8" />' +
                    '<title>Month Till Date Sales Chart</title>' +
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

            
        	}

            function getMTDDSEChart(data)
            {
                var tablegrid = $("#DSEGrid");
                var tablechart = $("#DSEChart");
                sampleData = data;
            
            var settings = {
                title: "Month Till Date Chart",
                description: "Month Till Date DSE wise Enquiry Booking Invoice",
                enableAnimations: true,
                showLegend: true,
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                xAxis:
                    {
                        dataField: 'Name',
                        gridLines: { visible: true }
                    },
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            columnsGapPercent: 20,
                            seriesGapPercent: 8,
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
            tablechart.jqxChart(settings);
            var adapter = new $.jqx.dataAdapter({
                datafields: [
                    { name: "Name", type: "string" },
                    { name: "Enquiry", type: "string" },
                    { name: "Booking", type: "string" },
                    { name: "Invoice", type: "string" },
                    
                ],
                localdata: sampleData,
                datatype: 'json'
            });

            tablegrid.jqxGrid({
                width: 848,
                height: 232,
                filterable: true,
                showfilterrow: true,
                showstatusbar:true,
                showaggregates:true,
                statusbarheight:30,
                source: adapter,
                columns:
                [
                    { text: "Saleman", width: '34%', datafield: "Name", filteritems: data, filtertype: "checkedlist" },
                    { text: "Enquiry", width: '22%', datafield: "Enquiry",aggregates: ['sum']},
                    { text: "Booking", width: '22%', datafield: "Booking",aggregates: ['sum']},
                    { text: "Invoice", width: '22%', datafield: "Invoice",aggregates: ['sum']},
                ]
            });
            tablegrid.on('filter', function () {
                var rows = tablegrid.jqxGrid('getrows');
                var chart = tablechart.jqxChart('getInstance');
                chart.source = rows;
                chart.update();
            });

            $("#dseprintbtn").click(function () {
                var content = tablechart[0].outerHTML;
                var newWindow = window.open('', '', 'width=800, height=500'),
                document = newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>' +
                    '<html>' +
                    '<head>' +
                    '<meta charset="utf-8" />' +
                    '<title>Month Till Date DSE wise Sales Chart</title>' +
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

            } // End of MTD DSE Wise Performance
            $("#pdfbtn").click(function () {
                // call the export server to create a JPEG image
                tablechart.jqxChart('saveAsJPEG', 'myChart.jpeg', getExportServer());
            });
            
            $("#todate").val();

        });
    </script>
    <style type="text/css">
    #pagebody .row{
        /*border:1px solid red;*/
        margin-top: 30px;
    }
    #pagebody .row a{
        margin-right: 40px;
    }

</style>
</head>
<body>
    <div class="container-fluid" id="pagebody">
        <div class="row">
            <label class="col-form-label">From Date: </label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="fromdate" name="fromdate">
            </div>
            <label class="col-form-label">To Date: </label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="todate" name="todate" value="mer">
            </div>
            <button class="btn btn-success" id="search">Search</button>
             
        </div>
    <div>
        
        <div class="bg-info" style="margin-top: 10px; width: 57%; height: 6%; position: relative; left: 25%; top: 5px; border-radius: 3px; color: white;">
            <a href="#" id="modelprintbtn" style="float: right; margin:5px 30px 0px 0px; color: blue; font-size: 18px"><i class="fa fa-Print"> Print</i></a>
                <h5><b style="margin-left: 15px; ">Mont Till Date Report</b></h5>
    </div>
    <div id="modelGrid" style="margin-top: 0px; width: 57%; height: 10%; position: relative; left: 25%; top: 0px;"></div>
    <div id='modelChart' style="margin-top: 2%; width: 57%; height: 60%; position: relative; left: 25%; top: 0px;">
    </div>
    </div>

    <div>
        <div class="bg-info" style="margin-top: 100px; width: 57%; height: 6%; position: relative; left: 25%; top: 5px; border-radius: 3px; color: white;">
            <a href="#" id="dseprintbtn" style="float: right; margin:5px 30px 0px 0px; color: blue; font-size: 18px"><i class="fa fa-Print"> Print</i></a>
                <h5><b style="margin-left: 15px;">Mont Till Date DSE Report</b></h5>
    </div>
    <div id="DSEGrid" style="margin-top: 0px; width: 57%; height: 10%; position: relative; left: 25%; top: 0px;"></div>
    <div id='DSEChart' style="margin-top: 2%; width: 57%; height: 60%; position: relative; left: 25%; top: 0px;">
    </div>
    </div>

</div>
</body>
</html>