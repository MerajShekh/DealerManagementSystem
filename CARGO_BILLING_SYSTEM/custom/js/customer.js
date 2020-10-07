$(document).ready(function () {
            // alert(location.pathname);

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
            // var url = '../php_action/customerList.php';
            var source =
            {
                url: '../php_action/customerList.php',
                // url: url,
                datatype: "json",
                datafields: [
                    {name:'Frame',type: 'string'},
                    {name:'Engine',type: 'string'},
                    {name:'Model',type: 'string'},
                    {name:'Variant',type: 'string'},
                    {name:'Location',type: 'string'},
                  ],
                  
            };
            
            // frame with anchor tag--------------->
            var linkrenderer = function (row, column, value) {
                if (value.indexOf('#') != -1) {
                    value = value.substring(0, value.indexOf('#'));
                }
            var html = "<a href=../customer/customerdetail.php?a="+column+">"+value+"</a>";
                return html;
            };
            // data Adapter--------------->
            var dataAdapter = new $.jqx.dataAdapter(source);
            var self = this;
            var label = $("<div></div>");

             var pagerrenderer = function () {
                 var element = $("<div class='container-fluid row d-flex justify-content-center'></div>");
                 var datainfo = gridTable.jqxGrid('getdatainformation');
                 var paginginfo = datainfo.paginginformation;
                 var leftButton = $("<div class='' style='margin:5px 0px 0px 0px'><div class=''><i class='fa fa-backward' aria-hidden='true'></i></div></div>");
                 // leftButton.find('div').addClass('jqx-icon-arrow-left');
                 leftButton.width(25);
                 leftButton.jqxButton({
                     theme: 'energyblue'
                 });

                 var rightButton = $("<div class='' style='margin:5px 0px 0px 10px'><div class=''><i class='fa fa-forward' aria-hidden='true'></i></div></div>");
                 // rightButton.find('div').addClass('jqx-icon-arrow-right');
                 rightButton.width(25);
                 rightButton.jqxButton({
                     theme: 'energyblue'
                 });
                 leftButton.appendTo(element);
                 rightButton.appendTo(element);
                 
                 label.text("1-" + Math.min(datainfo.rowscount, paginginfo.pagesize) + ' of ' + datainfo.rowscount);
                 
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
                     pageChange(); // call pa
                     gridTable.jqxGrid('gotonextpage');
                 });
                 leftButton.click(function () {
                     pageChange(); //Call p
                     gridTable.jqxGrid('gotoprevpage');
                 });
                 return element;
             }  //end of pagerrenderer-------------->

             // page change event--------------->
             function pageChange(){
                 gridTable.on('pagechanged', function () {
                 var datainfo = gridTable.jqxGrid('getdatainformation');
                 var paginginfo = datainfo.paginginformation;
                 label.text(1 + paginginfo.pagenum * paginginfo.pagesize + "-" + Math.min(datainfo.rowscount, (paginginfo.pagenum + 1) *paginginfo.pagesize) + ' of ' + datainfo.rowscount );
                    });
            } // page change event--------------->

           var ec = [{ text: 'Customer Id', datafield:'Frame', cellsrenderer: linkrenderer, width:'12%' },
                  { text: 'Created Date', datafield: 'created_date',width:'8%'},
                  { text: 'Title', datafield: 'title', width:'5%'},
                  { text: 'First Name', datafield: 'first_name', cellsalign: 'left', width:'12%' },
                  { text: 'Middle Name', datafield: 'middle_name', cellsalign: 'left', width:'12%'},
                  { text: 'Last Name', datafield: 'last_name', cellsalign: 'left', width:'12%' },
                  { text: 'Gender', datafield: 'gender', cellsalign: 'left', width:'5%' },
                  { text: 'Mobile#', datafield: 'mobile_phone', cellsalign: 'left', width:'10%' },
                  { text: 'Email', datafield: 'email', cellsalign: 'left', width:'12%' },
                  { text: 'Address1', datafield: 'address1', cellsalign: 'left', width:'12%' },
                  { text: 'Address2', datafield: 'address2', cellsalign: 'left', width:'12%' },
                  { text: 'City', datafield: 'city', cellsalign: 'left', width:'12%' },
                  { text: 'District', datafield: 'district', cellsalign: 'left', width:'12%' },
                  { text: 'State', datafield: 'state', cellsalign: 'left', width:'12%' },
                  { text: 'Pin Code', datafield: 'pin_code', cellsalign: 'left', width:'5%' },
                  { text: 'Relation', datafield: 'relation', cellsalign: 'left', width:'7%' },
                  { text: 'Relative Name', datafield: 'relative_name', cellsalign: 'left', width:'12%'},];
         //<----------End Data Grid of Enquiry list------------>
            // var gridTable = $("#activity_table_grid");


    function genDataGrid(t,p,s,c){

        t.jqxGrid({
                width: '100%',
                source: s,
                columnsresize: true,
                pageable: true,
                autoheight: true,
                horizontalscrollbarstep: 200,
                pagesize: 5,
                pagermode:'simple',
                theme: 'energyblue',
                pagerrenderer: p,
                columns: c  
        });
    }
    // alert(getTable());

    function getTable(){
        return tablegrid;
    }

    function getPager(){
        return pagergrid;
    }

    function setData(tg,pg){
        gridTable = tg;
        pagergrid = pg;
    }

    function customerEnquiryTable(){
        var tableg = $("#enquiry_table_grid");
        var pagerg = $("#enquiry_list_pager_info"); 
        setData(tableg,pagerg);
        // genDataGrid(gridTable,pagerrenderer,source,ec);
        // gridTable = $("#enquiry_table_grid");
        genDataGrid(gridTable,pagerrenderer,source,ec);
    }

    function customerActivityTable(){
        var tableg = $("#activity_table_grid");
            var pagerg = $("#activity_list_pager_info");  
        setData(tableg,pagerg);
        genDataGrid(gridTable,pagerrenderer,source,ec);
    }
    
    function customerlistTable(){
        var tableg = $("#customer_table_grid");
        var pagerg = $("#customer_table_pager");  
        setData(tableg,pagerg);
        genDataGrid(gridTable,pagerrenderer,source,ec);
    }

      customerEnquiryTable();

    $("#customer_activity").on('click', function(){
            customerActivityTable();
    });

        $("#customer_enquiry").on('click', function(){
            
            customerEnquiryTable(); // call customerEnquiryTable function------->
    });

}); // End Document ready function----------------->