<?php


function get_user_actions($countonly=false,$type="",$order_by="date",$sort="DESC")
	{
    global $actions_notify_states, $actions_resource_types_hide, $default_display, $list_display_fields, $search_all_workflow_states,$actions_approve_hide_groups,
    $actions_resource_review,$actions_resource_requests,$actions_account_requests, $view_title_field, $actions_on;
        
    $actionsql="";    
    $filtered = $type!="";
    
    if(!$actions_on){return array();}
        
    if($actions_resource_review && (!$filtered || 'resourcereview'==$type))
        {
        $search_all_workflow_states = false;
        $default_display	= $list_display_fields;
        $editable_resource_sql=get_editable_resource_sql($countonly);
          $actionsql .="SELECT creation_date as date,ref, field" . $view_title_field . " as description,'resourcereview' as type FROM (" . $editable_resource_sql . ") resources" ;
        }
    if(checkperm("R") && $actions_resource_requests && (!$filtered || 'resourcerequest'==$type))
        {
        $request_sql = get_requests(true,true,true);        
        $actionsql .= (($actionsql!="")?" UNION ":"") . "SELECT created as date,ref,username as description,'resourcerequest' as type FROM (" . $request_sql . ") requests";
        }
    if(checkperm("u") && $actions_account_requests && (!$filtered || 'userrequest'==$type))
        {
        $availgroups=get_usergroups(true);
        $get_groups=implode(",",array_diff(array_column($availgroups,"ref"),explode(",",$actions_approve_hide_groups)));
        $account_requests_sql = get_users($get_groups,"","u.created",true,-1,0,true,"u.ref,u.created,u.fullname,u.email,u.username"); 
        $actionsql .= (($actionsql!="")?" UNION ":"") . "SELECT created as date,ref,concat(fullname,if(email<>'',concat('(',email,')'),'')) as description,'userrequest' as type FROM (" . $account_requests_sql . ") users";
        }
        
    $hookactionsql = hook("addtoactions");
    
    if($hookactionsql != false){$actionsql = (($actionsql!="")?$actionsql . " UNION ":"") . $hookactionsql;}
    
    if($actionsql==""){return $countonly?0:array();}
    
    if ($countonly)
        {return sql_value("SELECT COUNT(*) value FROM (" . $actionsql . ") allactions",0);}
    else
        {$actionsql = "SELECT date, ref, description, type FROM (" . $actionsql . ")  allactions ORDER BY " . $order_by . " " . $sort;}
        
    return sql_query($actionsql);  
    }
    
function get_editable_resource_sql()
	{
	global $actions_notify_states, $actions_resource_types_hide, $default_display, $list_display_fields, $search_all_workflow_states;
    $default_display	= $list_display_fields;
    $search_all_workflow_states = false;
    $rtypes=get_resource_types();
    $searchable_restypes=implode(",",array_diff(array_column($rtypes,"ref"),explode(",",$actions_resource_types_hide)));
	$editable_resource_sql=do_search("",$searchable_restypes,'resourceid',$actions_notify_states,-1,'desc',false,0,false,false,'',false,false,false,true,true);
    return $editable_resource_sql;
	}
    
