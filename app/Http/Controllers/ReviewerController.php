<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Organization;
use App\Bio_info;
use App\Who_can_see;
use App\User;
use App\Keyword;
class ReviewerController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$user = User::find(auth()->user()->id);
    	$countries = Country::all();
        return view('reviewers.home',compact('user','countries'));
    }

    public function get_organization_name(Request $request){
    	 $value = $request->form_data;
         $organizations =Organization::where('name','like',"%$value%")->get();
         $data = '';
         foreach ($organizations as $value) {
         	$country_name =$value->country->name;
         	$country_id =$value->country->id;
         	$data .= '<li onclick="put_value('."'$value->name','$value->city','$value->state_region','$country_id'".')"><a href="#">'."<b>$value->name</b><br><span class='font-size-13px'>$value->city,$value->state_region,$country_name</span></a><hr></li>";
         }
    	 return $data;
    }

    public function submit_employment(Request $request){
    	 $value = $request->form_data;
    	$organization_name = $value[2]['value'];
    	$city = $value[3]['value'];
    	$state_region = $value[4]['value'];
    	$country_id = $value[5]['value'];
    	$exist_organization = Organization::where('name',$organization_name )->where('city',$city)->where('state_region',$state_region)->where('country_id',$country_id)->first();
    	$bio_info = new Bio_info;
        if (empty($exist_organization)) {
        	$organization = new Organization;
        	$organization->name = $organization_name ;
        	$organization->city = $city ;
        	$organization->state_region = $state_region ;
        	$organization->country_id = $country_id ;
        	$organization->save();
        	$bio_info->organization_id = $organization->id;
        }
        else{$bio_info->organization_id = $exist_organization->id;}
    	$bio_info->user_id = auth()->user()->id;
    	$bio_info->type = $value[1]['value'];
    	$bio_info->department = $value[6]['value'];
    	$bio_info->role_title = $value[7]['value'];
    	$bio_info->url = $value[8]['value'];
    	$bio_info->start_year = $value[9]['value'];
    	$bio_info->start_month = $value[10]['value'];
    	$bio_info->start_date = $value[11]['value'];
    	$bio_info->end_year = $value[12]['value'];
    	$bio_info->end_month = $value[13]['value'];
    	$bio_info->end_date = $value[14]['value'];
    	$bio_info->save();
    	$who_can_see = new Who_can_see;
    	$who_can_see->table_name = 'Organization';
    	$who_can_see->table_primarykey_id = $bio_info->id;
    	if ($value[15]['value'] == "every_one_true") {
    		$who_can_see->everyone = 1;
    	}
    	elseif ($value[15]['value'] == "trasted_people_true") {
    		$who_can_see->trusted_parties = 1;
    	}
    	elseif ($value[15]['value'] == "only_me_true") {
    		$who_can_see->only_me = 1;
    	}
    	$who_can_see->save();
    	$user = User::find(auth()->user()->id);
    	$data = '';
    	if(count($user->bio_infos)>0){
          foreach($user->bio_infos as $bio_info){
            $data .='<div class="card margin-top-10px col-md-12" > <div class="card-body"> <div class="row"> <div class="col-md-9">'; $organization_info=$bio_info->organization; $data .="<p><b>$organization_info->name,$organization_info->city,$organization_info->state_region,".$organization_info->country->name."</b></p> <p>$bio_info->start_year-$bio_info->start_month-$bio_info->start_date to"; $data .=($bio_info->end_year != NULL)?$bio_info->end_year : ' Present'; $data .="-$bio_info->end_month-$bio_info->end_date</p> <p>$bio_info->type</p> </div>"; $data .='<div class="col-md-3"> <span class="float-right"><a onclick="hide_show_toggle('."'employment_$bio_info->id'".')"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a> <ul id="who_see'.$bio_info->id.'" style="width: 150px;height: 50px;border-radius: 15px 50px;background-color: #E8EAED;margin-top:-40px;margin-left: 30px; " tabindex="0" data-placement="top" role="button" data-toggle="popover" data-trigger="hover" title="Who Can See this" > <li class="list-inline-item " onclick="permission('."'who_see$bio_info->id',this)".'" style="margin: 15px 0px 0px -10px"><a><i class="fa fa-users margin-right-10px color-black"></i></a></li> <li class="list-inline-item" onclick="permission('."'who_see$bio_info->id',this)".'"><a><i class="fa fa-key margin-right-10px"></i></a></li> <li class="list-inline-item" onclick="permission('."'who_see$bio_info->id',this)".'"><a><i class="fa fa-lock margin-right-10px"></i></a></li> </ul> </span> </div> <div class="col-md-12" id="employment_'.$bio_info->id.'" style="display: none"> <hr> <div class="row"> <div class="col-md-12"> <p><b>Organization identifiers</b></p> <p>Ringgold: 130058</p> <div>'; $data .="<p>$organization_info->name,$organization_info->city,$organization_info->state_region,".$organization_info->country->name."</p> <p><b>Other organization identifiers provided by Ringgold</b></p> <p>ISNI: 0000000122266721</p> </div> <p><b>URL</b></p>"; $data .= '<a href="'.$bio_info->url.'">'.$bio_info->url.'</a> </div> <div class="col-md-7"><br> <p><b>Added</b></p>'; $data .= "<p>$bio_info->created_at</p> </div>"; $data .=' <div class="col-md-5"><br> <p><b>Last modified</b></p> <p>'.$bio_info->updated_at.'</p> </div> </div> </div> <div class="col-md-12"> <div class="row"> <div class="col-md-8"> <p><b>Source : </b>'.$user->first_name.' '.$user->last_name.'</p> </div> <div class="col-md-4"> <p>*Preferred source <div class="float-right" style="margin-top: -25px;"> <a class="margin-right-10px"><i class="fa fa-edit"></i></a> <a onclick="confirm_delete('."'delete_employment',$bio_info->id)".'"><i class="fa fa-trash"></i></a> </div> </p> </div> </div> </div> </div> </div> </div>';
         
             }

    	}
   return $data;

    }
    public function delete_employment(Request $request){
      $id = $request->form_data;
      Bio_info::find($id)->delete();
      Who_can_see::where('table_primarykey_id',$id)->delete();
      return 'success';
    }

   public function submit_name(Request $request){
   	   $value = $request->form_data;
       $user_info = User::find(auth()->user()->id);
       $user_info->first_name = $value[0]['value'];
       $user_info->last_name = $value[1]['value'];
       $user_info->published_name = $value[2]['value'];
       $user_info->save();
       $data = '<div id="name_show_div"><a href="#" class="margin-right-10px" onclick="hide_show_toggle('."'name_edit_div','name_show_div'".')"><i class="fa fa-pencil"></i></a>'.$value[0]['value'].' '.$value[1]['value'].'<br><br> </div><div id="name_edit_div" style="display: none"><form id="name_edit_form"> <div class="form-group"> <label for="first_name" class="col-form-label">First Name</label> <input type="text" class="form-control" id="first_name" name="first_name" value="'.$value[0]['value'].'"></div><div class="form-group"> <label for="last_name" class="col-form-label">Last Name</label> <input type="text" class="form-control" id="last_name" name="last_name" value="'.$value[1]['value'].'"> </div><div class="form-group"> <label for="published_name" class="col-form-label">Published Name</label> <input type="text" class="form-control" id="published_name" name="published_name" value="'.$value[2]['value'].'"> </div><div class="form-group"> <button type="button" class="btn btn-primary" onclick="submit_data('."'submit_name','name_edit_form','name_show'".')">Submit</button> <button type="button" class="btn btn-danger" onclick="hide_show_toggle('."'name_edit_div','name_show_div'".')">Cancle</button> </div> </form> </div>';
   return $data;                           
   }

   public function submit_country(Request $request){
   	   $value = $request->form_data;
       $user_info = User::find(auth()->user()->id);
       $user_info->country_id = $value[0]['value'];
       $data = '<span style="color:red">'.$value[0]['value'].'</span>';
       $countries = Country::all();
       if($user_info->save()){
       	$user = User::find(auth()->user()->id);
        $data='<div id="country_show_div"> <a onclick="hide_show_toggle('."'country_edit_div','country_show_div')".'" class="margin-right-10px"><i class="fa fa-pencil"></i></a>Country<br> <span class="side_sub">'.$user->country->name.'</span> </div> <div id="country_edit_div" style="display:none"> <form id="country_edit_form"> <div class="form-group"> <label for="country" class="col-form-label">Country</label> <select class="form-control" name="user_country_id"> <option value="'.$user->country->id.'">'.$user->country->name.'</option>'; foreach($countries as $country){ $data .='<option value="'.$country->id.'">'.$country->name.'</option>'; } $data .=' </select> </div> <div class="form-group"> <button type="button" class="btn btn-primary" onclick="submit_data('."'submit_country','country_edit_form','country_show')".'">Submit</button> <button type="button" class="btn btn-danger" onclick="hide_show_toggle('."'country_edit_div','country_show_div')".'">Cancle</button> </div> </form> </div>';
       }
    return $data;
   }

  public function submit_keywords(Request $request){
    $value_get = $request->form_data;
   $old_keys = Keyword::where('user_id',auth()->user()->id)->get();
   $array_id=array();$i=0;
   foreach ($old_keys as $key ) {
     $array_id[]=$key->id;
   }
   Keyword::whereIn('id',$array_id)->delete();
  $whosee = Who_can_see::where('table_name','Keyword')->whereIn('table_primarykey_id',$array_id)->get();
   $array_id=array();
   foreach ($whosee as $key ) {
     $array_id[]=$key->id;
   }
   Who_can_see::whereIn('id',$array_id)->delete();
   foreach ($value_get as $key ) {
    if ($i==0) {
     $new_keyword = new Keyword;
     $new_keyword->user_id = auth()->user()->id;
     $new_keyword->keyword = $key['value'];
     $new_keyword->save();
     $i=1;
    }
    else{ 
      $permission = new Who_can_see;
      $permission->table_name = 'Keyword';
      $permission->table_primarykey_id = $new_keyword->id;
      if ($key['value'] == "list-inline-item ev22") {
        $permission->everyone = 1;
      }
       elseif ($key['value'] == "list-inline-item ev11") {
        $permission->trusted_parties = 1;
      }
      else{
        $permission->only_me = 1;
      }
      $permission->save();
      $i=0;
    }
    
   }
 $user_info = User::find(auth()->user()->id);
 $data ='<a class="margin-right-10px" data-toggle="modal" data-target="#keywords_modal" data-keywords='.json_encode($user_info->keywords).'><i class="fa fa-pencil"></i></a>Keywords<br><span class="side_sub">';
   foreach($user_info->keywords as $keyword){
     $data .= $keyword->keyword.',';                      
   }                        
$data .='</span>';                        
return $data;
  }
}
