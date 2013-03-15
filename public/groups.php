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

global $session;

if(!$session->is_logged_in())
{
    redirect_to("index.php");
}
else
{
    if($session->user_level > 0)
    {
        redirect_to("index.php");
    }
}

?>
<script type="text/javascript">
  $(function(){ 

    var lastSel = 0;
    
    $("#grid_groups").jqGrid({
      url:'groups_xml.php',
      datatype: 'xml',
      mtype: 'GET',
      colNames:['ACTION','ID','NAME','DESCRIPTION','BANNER'],
      colModel :[ 
        {name:'act',index:'act', width:75, sortable:false, search: false},
        {name:'id', index:'id', width:55, editable:false, search: true}, 
        {name:'name', index:'name', width:90, sortable:true, editable:true, search: true},
        {name:'description', index:'description', width:55, editable:true, search: true, editoptions: {size:80, maxlength: 255, rows:"5",cols:"50"}, edittype:"textarea"}, 
        {name:'banner', index:'banner', width:90, sortable:true, editable:true, search: true}
      ],
      width: 1400,
      height: 500,
      pager: '#nav_groups',
      rowNum:10,
      rowList:[10,20,30,40,50,100,200,300,400,500],
      sortname: 'id',
      sortorder: 'desc',
      gridComplete: function()
      {
        var ids = jQuery("#grid_groups").jqGrid('getDataIDs');
        for(var i=0;i < ids.length;i++)
        {
          var id = ids[i];
          edit = "<input style='height:22px;width:20px;' type='button' value='..' onclick=\"jQuery('#grid_groups').editGridRow('"+id+"', {width:400});\"  />"; 
          del = "<input style='height:22px;width:20px;' type='button' value='x' onclick=\"jQuery('#grid_groups').delGridRow('"+id+"');\" />"; 
          save = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"jQuery('#grid_groups').saveRow('"+id+"');\"  />"; 
            jQuery("#grid_groups").jqGrid('setRowData',ids[i],{act:edit+del+save});
        }
      },
      editurl: "update_group.php",
      viewrecords: true,
      gridview: true,
      caption: 'Groups',
      multiselect:true,
      onSelectRow: function(id)
      {
       if(id && id!==lastSel)
       { 
          jQuery('#grid_groups').restoreRow(lastSel); 
          lastSel=id; 
       }
       jQuery('#grid_groups').editRow(id);
     }
    });

    jQuery("#grid_groups").jqGrid('navGrid','#nav_groups',{edit:true,add:true,del:true}).
    navButtonAdd('#nav_groups',{
       caption:"Delete Selected", 
       buttonicon:"ui-icon-add", 
       onClickButton: function(){
          var ids = jQuery("#grid_groups").jqGrid('getGridParam','selarrrow');
          if(ids.length > 0){

            if(confirm("Delete selected records?"))
            {
              $.ajax({
                type:"POST",
                url:"multi_delete.php",
                data: {ids:ids, what:"group"},
                success: function(result)
                {
                    if(result == "success")
                    {
                        jQuery("#grid_groups").trigger("reloadGrid");
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
    
  });

</script>

<table id="grid_groups"><tr><td/></tr></table> 
<div id="nav_groups"></div>