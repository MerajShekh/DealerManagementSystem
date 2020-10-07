$(document).ready(function() {
myfun();
fetchModelList();
$("#logs" ).val('SP125');
  $("#model_category" ).val("SC");
    
    // getModelData("model_name", "Model_Category", $("#model_category" ).val(), "Model_Name");
    $( "#model_category").combobox();
    $( "#model_name").combobox();
    $( "#model_variant").combobox();
    
    $( "#example").combobox();


function fetchModelList(){
  var html;
      $.ajax({
              url: "../php_action/fetchdata.php",
              method: "POST",
              data: {fetchAllModels:""},
              datatype:"JSON",
              success:function(data,status){
                  var fetcheddata = $.parseJSON(data);// decode JSON data----->
                  // alert(fetcheddata);
                  $.each(fetcheddata, function(key, value){
                // alert(value.Model_Name);
                html += '<option value="'+value.Model_Name+'">'+value.Model_Name+'</option>';
              })
              $("#logs").html(html);
                  
              }
          }) // End ajax method------------->
   } // <----End of fetchModelList function
// getModelData();
function getModelData(grid, id, data, fetcheddata){
      // alert(data);
      var a = fetcheddata;
      var html = '<option value=""></option>';
    $.ajax({
          url: "../php_action/fetchdata.php",
          datatype: "json",
          method: "post",
          data: {id:id, data:data, fetcheddata: fetcheddata},
          success: function(data, status) {
            // response(data);
            var mydata = $.parseJSON(data);
            $.each(mydata, function(key, value){
              // alert(value);
              html += '<option value="'+value+'">'+value+'</option>';
            })
            $("#"+grid).html(html);
            
          }
        });
   }
   $("#model_category").on('comboboxselect', function(event, ui){
    var value = $(this).val();
    $("#model_name").html('<option>');
    getModelData("logs", "Model_Category", value, "Model_Name");
   });

    

    var mydata = ["activa","dio","shine"];

    
  function myfun(){  
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            // alert();
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
          
        }) );
        
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 }
    
    $("#logs").click(function(){
      myfun();
      $(this).combobox();
    })
    
    
  });