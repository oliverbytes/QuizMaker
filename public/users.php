<?php

/*
  Creator: Oliver Martinez A.K.A. NemOry
  Email, facebook, paypal: nemoryoliver@gmail.com
  Twitter: @NemOry
  if you want to contribute to the System or copy the system and build your own.
  I hope you can please just notify me 1st. :)
*/

require_once("../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("index.php");
}
else
{
    if($session->user_level > 1)
    {
        redirect_to("index.php");
    }
}

?>

<script type="text/javascript">
  $(function()
  {

    var last_clicked_id = 0;

    function imageFormat( cellvalue, options, rowObject )
    {
      return '<img src="groups/<?php echo Group::get_by_id($session->user_group_id)->name; ?>/files/users/'+cellvalue+'" height="30"/>';
    }

    function accessFormat( cellvalue, options, rowObject )
    {
      if(cellvalue == 1)
      {
        return "ENABLED";
      }
      else if(cellvalue == 0)
      {
        return "DISABLED";
      }
    }

    function userLevelFormat( cellvalue, options, rowObject )
    {
      if(cellvalue == 1)
      {
        return "ADMIN";
      }
      else if(cellvalue == 2)
      {
        return "USER";
      }
      else if(cellvalue == 0)
      {
        return "SUPER ADMIN";
      }
    }

    var lastSel = 0;

    $("#grid_users").jqGrid({
        url:'users_xml.php',
        datatype: 'xml',
        mtype: 'GET',
        colNames:['ACTION', 'USERNAME','LEVEL','PASSWORD','NAME','PICTURE','ACCESS TOKEN','EMAIL','ACCESS'],
        colModel :[ 
          {name:'act',index:'act', width:50,sortable:false, search: false },
          {name:'username', index:'username', width:70, align:'left', sortable:true, editable:true, editoptions: {size:30}, search:true}, 
          {name:'level', index:'level', width:30, align:'left', search: true, sortable:true, editable:true, formatter:userLevelFormat, edittype:'select', editoptions:{value:{1:'ADMIN',2:'USER'}}}, 
          {name:'password', index:'password', width:50, align:'left', search: true, sortable:true, editable:true, editoptions: {size:30}},
          {name:'name', index:'name', width:80, align:'left', search: true, sortable:true, editable:true, editoptions: {size:30}}, 
          {name:'picture', index:'picture', width:40, align:'left', search: true, editable:true, formatter:imageFormat, edittype:'select', editoptions:{

          value:"<?php 

          $group = Group::get_by_id($session->user_group_id);

          $directory = PUBLIC_PATH.DS.'groups'.DS.$group->name.DS.'files'.DS.'users'.DS.'*';

          echo ':;';

          foreach(glob($directory) as $file)  {
              echo basename($file).':'.basename($file).';';
          }

          ?>"}},
          {name:'access_token', index:'access_token', width:80, align:'left', search: true, sortable:true, editable:false, editoptions: {size:30}},
          {name:'email', index:'email', width:80, align:'left', search: true, sortable:true, editable:true, editoptions: {size:30}}, 
          {name:'access', index:'access', width:80, align:'left', search: true, sortable:true, editable:true, formatter:accessFormat, edittype:'select', editoptions:{value:{0:'DISABLED',1:'ENABLED'}}}
        ],
        width: 1400,
        height: 500,
        pager: '#nav_users',
        rowNum:30,
        rowList:[10,20,30,40,50,100,200,300,400,500],
        sortname: 'id',
        sortorder: 'desc',
        gridComplete: function()
        {
          var ids = jQuery("#grid_users").jqGrid('getDataIDs');
          for(var i=0;i < ids.length;i++)
          {
            var id = ids[i];
            edit = "<input style='height:22px;width:20px;' type='button' value='..' onclick=\"jQuery('#grid_users').editGridRow('"+id+"', {width:300});\"  />"; 
            del = "<input style='height:22px;width:20px;' type='button' value='x' onclick=\"jQuery('#grid_users').delGridRow('"+id+"');\" />";
            save = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"jQuery('#grid_users').saveRow('"+id+"');\"  />"; 
            jQuery("#grid_users").jqGrid('setRowData',ids[i],{act:edit+del+save});
          }
        },
        editurl: "update_user.php",
        viewrecords: true,
        gridview: true,
        caption: 'Users',
        multiselect:true,
        onSelectRow: function(id)
        {
         if(id && id!==lastSel)
         { 
            jQuery('#grid_users').restoreRow(lastSel); 
            lastSel=id; 
         }
         jQuery('#grid_users').editRow(id);
       }
    });

  jQuery("#grid_users").jqGrid('navGrid','#nav_users',{edit:true, add:true, del:true}).
    navButtonAdd('#nav_users',{
       caption:"Generate Username QRCode", 
       buttonicon:"ui-icon-add", 
       onClickButton: function()
       {

        $('#qrcode').html("");
        $("#input").val("");

        var id = jQuery("#grid_users").jqGrid('getGridParam','selrow');
        var rowData = null; 
        var username = null;//replace name with you column

        if(id != null)
        {
          rowData = jQuery(this).getRowData(id); 
          username = rowData['username'];//replace name with you column
          $("#input").val(username);
          $('#qrcode').qrcode({width: 200, height: 200, text: username});
        }
        
        $( "#dialog-qrcode" ).dialog( "open" );

       },
       position:"last"
    }).
    navButtonAdd('#nav_users',{
       caption:"Delete Selected", 
       buttonicon:"ui-icon-add", 
       onClickButton: function(){
          var ids = jQuery("#grid_users").jqGrid('getGridParam','selarrrow');
          if(ids.length > 0)
          {
            if(confirm("Delete selected records?"))
            {
              $.ajax({
                type:"POST",
                url:"multi_delete.php",
                data: {ids:ids, what:"user"},
                success: function(result)
                {
                    if(result == "success")
                    {
                        jQuery("#grid_users").trigger("reloadGrid");
                        return false;
                    }
                    else
                    {
                        alert(result);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert("error");
                    return false;
                }
              });
            }
          }
          else
          {
            alert("please check atleast one");
          }
          return false;
       },
       position:"last"
    });

    $("#btn_generate_qrcode").click(function(){
      $('#qrcode').html("");
      var input = $("#input").val();
      $('#qrcode').qrcode({width: 200, height: 200, text: input});
    });

});

</script>

<div id="dialog-qrcode" title="QRCODE">
  <input type="text" id="input" />
  <button id="btn_generate_qrcode">Generate</button>
  <div id="qrcode"></div>
</div>

<a class="btnPrint" href="printing/users.php">Print</a>
<table id="grid_users"><tr><td/></tr></table> 
<div id="nav_users"></div>

<script>
    $(function() {
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        
        $( "#dialog-qrcode" ).dialog({
            autoOpen: false,
            height: 400,
            width: 300,
            modal: true,
            buttons: {
                "Print": function() 
                {
                    $("#qrcode").show().printElement();
                },
                Cancel: function() 
                {
                    $( this ).dialog( "close" );
                }
            },
        });
    });
</script>