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
$(function(){

  function checkTimer(value, colname)
  {
    if (value < 5 || value > 300)
    { 
      return [false, "We only allow timers from 5 seconds up to 5 minutes (300 seconds)"];
    }
    else
    {
      return [true, ""];
    }
  }

  var lastSel = 0;

  $("#grid_questions").jqGrid({
    url:'questions_xml.php',
    datatype: 'xml',
    mtype: 'GET',
    colNames:['ACTION','QUESTION','IDENTIFICATION','ANSWER','A','B','C','FILE','TYPE','POINTS','TIMER'],
    colModel :[ 
      {name:'act',index:'act', width:50,sortable:false, search: false},
      {name:'text', index:'text', width:300, align:'left', sortable:true, editable:true, search: true, stype:'text', editoptions: {size:100, maxlength: 200, rows:"5",cols:"60"}, edittype: "textarea"},
      {name:'identification', index:'identification', width:70, align:'left', sortable:true, editable:true, search: true, stype:'text', edittype:'select', editoptions:{value:{1:'TRUE',0:'FALSE'}}},  
      // {name:'difficulty', index:'difficulty', width:30, align:'left', sortable:true, editable:true, search: true, stype:'text', edittype:'select', editoptions:{value:{'easy':'easy','medium':'medium','hard':'hard'}}},
      {name:'answer', index:'answer', width:80, align:'left', sortable:true, editable:true, search: true, stype:'text', editoptions: {size:50}}, 
      {name:'choice_a', index:'choice_a', width:80, align:'left', sortable:true, editable:true, search: true, stype:'text', editoptions: {size:50}}, 
      {name:'choice_b', index:'choice_b', width:80, align:'left', sortable:true, editable:true, search: true, stype:'text', editoptions: {size:50}}, 
      {name:'choice_c', index:'choice_c', width:80, align:'left', sortable:true, editable:true, search: true, stype:'text', editoptions: {size:50}}, 
      {name:'file', index:'file', width:80, align:'left', sortable:true, editable:true, search: true, stype:'text', edittype:'select',editoptions:{

      value:"<?php

      $group = Group::get_by_id($session->user_group_id);

      $directory = PUBLIC_PATH.DS.'groups' .DS. $group->name .DS.'files'.DS.'questions'.DS.'*';

      echo ':;';
      
      foreach(glob($directory) as $file)  {
          echo basename($file).':'.basename($file).';';
      }
      
      ?>"}}, 
      {name:'type', index:'type', width:80, align:'left', sortable:true, editable:true, search: true, stype:'text', edittype:'select', editoptions:{value:{text:'text',image:'image',video:'video',audio:'audio'}}}, 
      {name:'points', index:'points', width:80, align:'right', sortable:true, editable:true, search: true, editrules:{number:true}, editoptions: {size:50}}, 
      {name:'timer', index:'timer', width:80, align:'right', sortable:true, editable:true, search: true, editrules:{number:true, custom:true, custom_func:checkTimer}, editoptions: {size:50}}
    ],
    width: 1400,
    height: 500,
    pager: '#nav_questions',
    rowNum:30,
    rowList:[10,20,30,40,50,100,200,300,400,500],
    sortname: 'id',
    toppager: true,
    sortorder: 'desc',
    gridComplete: function(){
      var ids = jQuery("#grid_questions").jqGrid('getDataIDs');
      for(var i=0;i < ids.length;i++)
      {
        var id = ids[i];
        edit = "<input style='height:22px;width:20px;' type='button' value='..' onclick=\"jQuery('#grid_questions').editGridRow('"+id+"', {width:400});\"  />"; 
        del = "<input style='height:22px;width:20px;' type='button' value='x' onclick=\"jQuery('#grid_questions').delGridRow('"+id+"');\" />"; 
        save = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"jQuery('#grid_questions').saveRow('"+id+"');\"  />"; 
        jQuery("#grid_questions").jqGrid('setRowData',ids[i],{act:edit+del+save});
      }
    },
    editurl: "update_question.php",
    viewrecords: true,
    gridview: true,
    caption: 'Questions',
    multiselect:true,
    onSelectRow: function(id)
    {
     if(id && id!==lastSel)
     { 
        jQuery('#grid_questions').restoreRow(lastSel); 
        lastSel=id; 
     }
     jQuery('#grid_questions').editRow(id);
   }
  });

  jQuery("#grid_questions").jqGrid('navGrid','#nav_questions',{edit:true, add:true, del:false, cloneToTop:true}).
    navButtonAdd('#nav_questions',{
       caption:"Delete Selected", 
       buttonicon:"ui-icon-add", 
       onClickButton: function()
       {
          var ids = jQuery("#grid_questions").jqGrid('getGridParam','selarrrow');
          if(ids.length > 0)
          {
            if(confirm("Delete selected records?"))
            {
              $.ajax({
                type:"POST",
                url:"multi_delete.php",
                data: {ids:ids, what:"question"},
                success: function(result)
                {
                    if(result == "success")
                    {
                        jQuery("#grid_questions").trigger("reloadGrid");
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
            alert("please select atleast one");
          }
          return false;
       },
       position:"last"
    });

});

</script>

<table id="grid_questions"><tr><td/></tr></table> 
<div id="nav_questions"></div>