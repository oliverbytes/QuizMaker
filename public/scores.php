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

    var lastSel = 0;

    $("#grid_scores").jqGrid({
      url:'scores_xml.php',
      datatype: 'xml',
      mtype: 'GET',
      colNames:['ACTION','SCORE', 'USER', 'TIME ELAPSED', 'CORRECT ANSWERS', 'DATE'],
      colModel :[ 
        {name:'act',index:'act', width:75, sortable:false},
        {name:'score', index:'score', width:90, sortable:true, editable:true, search:true},
        {name:'user_id', index:'user_id', width:90, sortable:true, editable:true, search:true},
        {name:'time_elapsed', index:'time_elapsed', width:90, sortable:true, editable:true, search:true},
        {name:'correct_answers', index:'correct_answers', width:90, sortable:true, editable:true, search:true},
        {name:'date', index:'date', width:90, sortable:true, editable:false, search:true}
      ],
      width: 1400,
      height: 500,
      pager: '#nav_scores',
      rowNum:30,
      rowList:[10,20,30,40,50,100,200,300,400,500],
      sortname: 'id',
      sortorder: 'desc',
      gridComplete: function(){
        var ids = jQuery("#grid_scores").jqGrid('getDataIDs');
        for(var i=0;i < ids.length;i++)
        {
          var id = ids[i];
          edit = "<input style='height:22px;width:20px;' type='button' value='..' onclick=\"jQuery('#grid_scores').editGridRow('"+id+"', {width:300});\"  />"; 
          del = "<input style='height:22px;width:20px;' type='button' value='x' onclick=\"jQuery('#grid_scores').delGridRow('"+id+"');\" />"; 
          save = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"jQuery('#grid_scores').saveRow('"+id+"');\"  />"; 
          jQuery("#grid_scores").jqGrid('setRowData',ids[i],{act:edit+del+save});
        }
      },
      editurl: "update_score.php",
      viewrecords: true,
      gridview: true,
      caption: 'scores',
      multiselect:true,
      onSelectRow: function(id)
      {
       if(id && id!==lastSel)
       { 
          jQuery('#grid_scores').restoreRow(lastSel); 
          lastSel=id; 
       }
       jQuery('#grid_scores').editRow(id);
     }
    });

    jQuery("#grid_scores").jqGrid('navGrid','#nav_scores',{edit:true,add:true,del:true}).
    navButtonAdd('#nav_scores',{
       caption:"Delete Selected", 
       buttonicon:"ui-icon-add", 
       onClickButton: function()
       {
          var ids = jQuery("#grid_scores").jqGrid('getGridParam','selarrrow');
          if(ids.length > 0)
          {
            if(confirm("Delete selected records?"))
            {
              $.ajax({
                type:"POST",
                url:"multi_delete.php",
                data: {ids:ids, what:"score"},
                success: function(result){
                    if(result == "success")
                    {
                        jQuery("#grid_scores").trigger("reloadGrid");
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

<table id="grid_scores"><tr><td/></tr></table> 
<div id="nav_scores"></div>