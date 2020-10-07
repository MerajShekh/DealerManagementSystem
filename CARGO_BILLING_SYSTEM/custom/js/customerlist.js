$(document).ready(function(){
// alert(location.pathname);
// alert($("#customerid").val());
            $("input, select").click(function(){
                $(this).addClass("bgchange");
            })

            $("input, select").on('blur',function(){
                $(this).removeClass("bgchange");
            })
            
            var gridTable = $("#customer_table_grid"); 
            var pagergrid = $("#customer_table_pager");
            var url = "../php_action/customerList.php?";

            var searchfname = $("#fname").val();
            var searchlname = $("#lname").val();
            var searchmobile = $("#mobile").val();
            var searchcid = $("#customerid").val();
            
            // alert(searchcid);
            searchData();
            function searchData(){
                // alert(searchcid);
                $.ajax({
                    url: "../php_action/customerList.php",
                    method: 'GET',
                    datatye:'JSON',
                    data:{mobile:searchmobile,
                            fname:searchfname,
                            lname:searchlname,
                            customerid:searchcid,
                        },
                    success : function(data, status){
                        var mydata2 = $.parseJSON(data);
                        // alert(data);
                        if (mydata2=="Data Not Found") {
                            // alert("Not Match");
                            customerListGrid(gridTable,pagergrid, mydata2);
                        }else{
                            // alert("else");
                        customerListGrid(gridTable,pagergrid, mydata2);
                        }
                        // mydata = data;
                    }

                });

            }

        
        function customerListGrid(gridTable,pagergrid, data){ 
            if (data == "Data Not Found") {
                // alert("Default");
                    var customer_list_source =
                {
                    url: "../php_action/customerList.php",
                    
                    datatype: "json",
                    // root: "data",
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

            }else{
                // alert(data.First_Name);
                var customer_list_source =
                {
                    // url: "../php_action/customerList.php?defaul=1",
                    // url: url,
                    localdata : data,
                    datatype: "json",
                    // root: "data",
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
            }
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
                 var datainfo = gridTable.jqxGrid('getdatainformation');
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
                 
                 label.appendTo(pagergrid);
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
                     gridTable.jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     gridTable.jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             gridTable.on('pagechanged', function () {
             var datainfo = gridTable.jqxGrid('getdatainformation');
             var paginginfo = datainfo.paginginformation;
             label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
             
                });
             // manage style
             // var style = {
             //            headerBackgroundColor: '#4267B2',
             //            headerColor: '#fff',
             //            headerBackgroundHoveredColor: '#FE6602',
             //            headerHoveredColor: '#fff',
             //            headerBackgroundSelectedColor: '#FC3752',
             //            headerSelectedColor: '#fff',
             //            backgroundColor: '#fff',
             //            color: '#333',
             //            backgroundHoveredColor: '#FE6602',
             //            hoveredColor: '#fff',
             //            backgroundSelectedColor: '#FC3752',
             //            selectedColor: '#fff'          
             //        };

            gridTable.jqxGrid(
            {
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
        } //<-------- end Data Grid of Customer List------------>
 
  
    gridTable.on('rowselect', function (event) {
     var row = event.args.rowindex;
     var data = gridTable.jqxGrid('getrowdata', row);
     // alert(data.model);
        fetchCustomer(data.Customer_Id);
    });

    function fetchCustomer(id){
        
        $.ajax({
            url: "../php_action/customerList.php",
            method: "POST",
            data: {Customer_Id:id},
            datatype:"JSON",
            success:function(data,status){
                var fetcheddata = $.parseJSON(data);// decode JSON data----->
                $("#searchtxt").val(fetcheddata.First_Name);
                $("#firstname").val(fetcheddata.First_Name);
                $("#middlename").val(fetcheddata.Middle_Name);
                $("#lastname").val(fetcheddata.Last_Name);
                $("#relation").html('<option value="'+fetcheddata.Relation+'">'+fetcheddata.Relation+'</option>');
                $("#relationname").val(fetcheddata.Relative_Name);
                $("#mobilenum").val(fetcheddata.Mobile);
                $("#email").val(fetcheddata.Email);
                $("#gender").html('<option value="'+fetcheddata.Gender+'">'+fetcheddata.Gender+'</option>');
                $("#customerid-2").val(fetcheddata.Customer_Id);
                $("#address1").val(fetcheddata.Address1);
                $("#address2").val(fetcheddata.Address2);
                $("#city").html('<option value="'+fetcheddata.City_Id+'">'+fetcheddata.City_Name+'</option>');
                $("#pincode").val(fetcheddata.Pin_Code);
                $("#state").html('<option value="'+fetcheddata.State+'">'+fetcheddata.State+'</option>');
                $("#CreatedDate").val(fetcheddata.Creation_Date);
                // alert(fetcheddata.Title);
            }

        })
    }

});