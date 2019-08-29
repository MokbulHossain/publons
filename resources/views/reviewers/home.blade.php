@extends('..layouts.app')

@section('content')
@push('style')
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">a{cursor: pointer;}input::-webkit-calendar-picker-indicator {display: none;}#organization_list{display: none;} #organization_list li{margin-left: -30px;} #organization_list li:hover{ background-color: #afcac469 }</style>
@endpush
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @include('..layouts.auth_internal_header')
                    <div style="margin-top: 20px;">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                         @endif
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                           <div id="name_show">
                              <div id="name_show_div">
                               <a class="margin-right-10px" onclick="hide_show_toggle('name_edit_div','name_show_div')"><i class="fa fa-pencil"></i></a>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<br><br>
                               </div>
                               <div id="name_edit_div" style="display: none">
                               <form id="name_edit_form">
                                 <div class="form-group">
                                <label for="first_name" class="col-form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}">
                              </div>
                               <div class="form-group">
                                <label for="last_name" class="col-form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}">
                              </div>
                               <div class="form-group">
                                <label for="published_name" class="col-form-label">Published Name</label>
                                <input type="text" class="form-control" id="published_name" name="published_name" value="{{$user->published_name}}">
                              </div>
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="submit_data('submit_name','name_edit_form','name_show')">Submit</button>
                                <button type="button" class="btn btn-danger" onclick="hide_show_toggle('name_edit_div','name_show_div')">Cancle</button>
                              </div>
                               </form>
                               </div>
                               </div> 


                               <a href=""><i class="fa fa-print margin-right-10px"></i> Public record print view</a><br><br>
                              
                              <div id="country_show">
                                <div id="country_show_div">
                               <a onclick="hide_show_toggle('country_edit_div','country_show_div')"  class="margin-right-10px"><i class="fa fa-pencil"></i></a>Country<br>
                               <span class="side_sub">{{isset($user->country->name)?$user->country->name : ''}}</span>
                               </div>
                               <div id="country_edit_div" style="display: none">
                                <form id="country_edit_form">
                                 <div class="form-group">
                                  <label for="country" class="col-form-label">Country</label>
                                  <select class="form-control" name="user_country_id">
                                     {!!isset($user->country->name)?'<option value="'.$user->country->id.'">'.$user->country->name.'</option>' : '<option value="null">---------</option>'!!}
                                     @foreach($countries as $country)
                                     <option value="{{$country->id}}">{{$country->name}}</option>
                                     @endforeach 
                                  </select>
                                </div>
                                <div class="form-group">
                                  <button type="button" class="btn btn-primary" onclick="submit_data('submit_country','country_edit_form','country_show')">Submit</button>
                                <button type="button" class="btn btn-danger" onclick="hide_show_toggle('country_edit_div','country_show_div')">Cancle</button>
                                </div>
                            </form>

                               </div>
                               </div>


                               <br>
                               <div id="keywords_div">
                               <a class="margin-right-10px" data-toggle="modal" data-target="#keywords_modal" data-keywords="{{json_encode($user->keywords)}}"><i class="fa fa-pencil"></i></a>Keywords<br>
                               <span class="side_sub">
                                @if(count($user->keywords)>0)
                                 @foreach($user->keywords as $keyword)
                                 {{$keyword->keyword}},
                                 @endforeach
                                @endif
                               </span>
                             </div><br>

                                <a class="margin-right-10px"><i class="fa fa-pencil"></i></a>Websites<br>
                                <span class="side_sub">
                                @if(count($user->websites)>0)
                                 @foreach($user->websites as $website)
                                 <a href="{{url($website->url)}}">{{$website->description}}</a><br>
                                 @endforeach
                                @endif
                               </span><br>
                                 <a class="margin-right-10px"><i class="fa fa-pencil"></i></a>Emails<br>
                                 <span class="side_sub">
                                @if(count($user->emails)>0)
                                 @foreach($user->emails as $email)
                                 {{$email->email}}<br>
                                 @endforeach
                                @endif
                               </span><br>
                          
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                            <h5><b>Biography</b>
                             <span class="float-right"><a ><i class="fa fa-pencil"></i></a>
                             <ul id="who_see" style="width: 150px;height: 50px;border-radius: 15px 50px;background-color: #E8EAED;margin-top:-40px;margin-left: 30px; "  tabindex="0"  data-placement="top" role="button" data-toggle="popover" data-trigger="hover" title="Who Can See this" >
                                    <li class="list-inline-item " onclick="permission('who_see',this)" style="margin: 15px 0px 0px -10px"><a ><i class="fa fa-users margin-right-10px color-black"></i></a></li>
                                    <li class="list-inline-item" onclick="permission('who_see',this)"><a ><i class="fa fa-key margin-right-10px"></i></a></li> 
                                    <li class="list-inline-item" onclick="permission('who_see',this)"><a ><i class="fa fa-lock margin-right-10px"></i></a></li>
                                </ul> 
                            </span>
                        </h5>

                                <p>{!!$user->biography!!}</p>
                               <br>
                           </div>
                           <div class="col-md-12 ">
                            <div class="row">
                               <div class="col-md-8" style=" background-color: #494A4C;color: white;height: 35px;">
                              <h3 ><a class="margin-right-10px" onclick="hide_show_toggle('employment_main_div')"><i class="fa fa-chevron-down"></i></a>Employment(<span id="count_employment">0</span>)</h3>
                            </div>
                            <div class="col-md-4" style="height: 35px;">
                                <button class="btn form-control btn-primary" data-toggle="modal" data-target="#employment_modal" data-modal_name="Employment" data-modal_url="submit_employment" data-type="Employment" data-success_div_id="employment_main_div"><i class="fa fa-plus margin-right-10px"></i>Add Employment</button>
                            </div>
                       
                       <div class="row" id="employment_main_div">

                       @if(count($user->bio_infos)>0)
                         @foreach($user->bio_infos as $bio_info)
                            <div class="card margin-top-10px col-md-12" >
                              <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                      @php $organization_info=$bio_info->organization; @endphp
                                        <p><b>{{$organization_info->name}},{{$organization_info->city}},{{$organization_info->state_region}},{{$organization_info->country->name}}</b></p>
                                        <p>{{$bio_info->start_year}}-{{$bio_info->start_month}}-{{$bio_info->start_date}} to {{$bio_info->end_year != NULL?$bio_info->end_year : 'Present'}}{{'-'.$bio_info->end_month.'-'}}{{$bio_info->end_date}}</p>
                                        <p>{{$bio_info->type}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="float-right"><a onclick="hide_show_toggle('employment_{{$bio_info->id}}')"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a>
                             <ul id="who_see{{$bio_info->id}}" style="width: 150px;height: 50px;border-radius: 15px 50px;background-color: #E8EAED;margin-top:-40px;margin-left: 30px; "  tabindex="0"  data-placement="top" role="button" data-toggle="popover" data-trigger="hover" title="Who Can See this" >
                                    <li class="list-inline-item " onclick="permission('who_see{{$bio_info->id}}',this)" style="margin: 15px 0px 0px -10px"><a><i class="fa fa-users margin-right-10px color-black"></i></a></li>
                                    <li class="list-inline-item" onclick="permission('who_see{{$bio_info->id}}',this)"><a><i class="fa fa-key margin-right-10px"></i></a></li> 
                                    <li class="list-inline-item" onclick="permission('who_see{{$bio_info->id}}',this)"><a><i class="fa fa-lock margin-right-10px"></i></a></li>
                                </ul> 
                            </span>
                                    </div>
                                    <div class="col-md-12" id="employment_{{$bio_info->id}}" style="display: none">
                                    <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><b>Organization identifiers</b></p>
                                                <p>Ringgold: 130058</p>
                                                <div>
                                                    <p>{{$organization_info->name}},{{$organization_info->city}},{{$organization_info->state_region}},{{$organization_info->country->name}}</p>
                                                    <p><b>Other organization identifiers provided by Ringgold</b></p>
                                                    <p>ISNI: 0000000122266721</p>
                                                </div>
                                                <p><b>URL</b></p>
                                                <a href="{{$bio_info->url}}">{{$bio_info->url}}</a>
                                            </div>
                                            <div class="col-md-7"><br>
                                                <p><b>Added</b></p>
                                                <p>{{$bio_info->created_at}}</p>
                                            </div>
                                            <div class="col-md-5"><br>
                                                 <p><b>Last modified</b></p>
                                                <p>{{$bio_info->updated_at}}</p>
                                            </div>
                                         
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="row">
                                                 <div class="col-md-8">
                                                <p><b>Source : </b>{{$user->first_name}} {{$user->last_name}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>*Preferred source
                                                <div class="float-right" style="margin-top: -25px;">
                                                      <a  class="margin-right-10px"><i class="fa fa-edit"></i></a>
                                                    <a  onclick="confirm_delete('delete_employment',{{$bio_info->id}})"><i class="fa fa-trash"></i></a>
                                                </div>
                                                </p>
                                            </div>
                                          </div>
                                      </div>
                                    
                                </div>
                              </div>
                            </div>
                       @endforeach
                    @endif




                   </div>

                        </div>

                           </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popover-content" class="d-none">
   <ul>
    <li class="list-inline-item "><i class="fa fa-users margin-right-10px"></i>EveryOne</li>
    <li class="list-inline-item"><i class="fa fa-key margin-right-10px"></i>Trusted parties</li> 
    <li class="list-inline-item"><i class="fa fa-lock margin-right-10px"></i>Only Me</li>
</ul>
</div>
{{--keywords model start--}}
<script type="text/javascript"> var k_div=1;</script>
<div class="modal fade bd-example-modal-lg " id="keywords_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 3rem">
        <h3>Edit keywords</h3>
        <form id="submit_keywords_form">
          <div id="new_keyword_div"></div>
          <div class="row">
          <div class="col-md-6">
          <a onclick="create_keyword_div()"><i class="fa fa-plus-circle"></i></a>
        </div>
        <div class="col-md-6">
          <button type="button" class="btn btn-primary" onclick="submit_data('submit_keywords','submit_keywords_form','keywords_div')" data-dismiss="modal">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
        </div>
        </div>
          </form>
        </div>
      </div>
    </div>
  </div>
{{--keywords websites emails model end--}}
{{--Modal start--}}
<div class="modal fade bd-example-modal-lg " id="employment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 3rem">
        <h3 id="moda_title"></h3>
        <form id="bio_info_form">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="modal_url" id="modal_url">
                    <input type="hidden" name="type" id="type">
                     <div class="form-group">
                    <label for="organization-name" class="col-form-label">Organization</label>
                    <input type="text" class="form-control" id="organization-name" name="organization_name"  autocomplete="off" onkeyup="get_organization_name()">
                    <ul id="organization_list" style="position: absolute;border: solid 1px black;  width: 340px;max-height: 280px;overflow: scroll;background-color: #fff;list-style: none;">
                        
                    </ul>

                  </div>
                   <div class="form-group">
                    <label for="city" class="col-form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                  </div>
                  <div class="form-group">
                    <label for="state_region" class="col-form-label">State/Region</label>
                    <input type="text" class="form-control" id="state_region" name="state_region">
                  </div>
                  <div class="form-group">
                    <label for="country" class="col-form-label">Country</label>
                    <select class="form-control" id="country" name="country_id">
                        <option value="null">---------</option>
                    </select>
                  </div>

                </div>
                <div class="col-md-6">
                   <div class="form-group">
                    <label for="department" class="col-form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department">
                  </div>
                   <div class="form-group">
                    <label for="role_title" class="col-form-label">Role/Title</label>
                    <input type="text" class="form-control" id="role_title" name="role_title">
                  </div>
                  <div class="form-group">
                    <label for="url" class="col-form-label">Url</label>
                    <input type="text" class="form-control" id="url" name="url">
                  </div> 
                  <div class="form-group">
                    <label for="" class="col-form-label">Start date</label>
                    <div class="row">
                    <select class="form-control col-md-4" id="" name="start_year">
                        <option value="">Year</option>
                        @for($i=now()->year;$i>now()->year-50;$i--)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    <select class="form-control col-md-4" id="" name="start_month">
                        <option value="">Month</option>
                        @for($i=01;$i<13;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                     <select class="form-control col-md-4" id="" name="start_date">
                        <option value="">Day</option>
                        @for($i=01;$i<32;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="" class="col-form-label">End date (leave blank if current)</label>
                    <div class="row">
                    <select class="form-control col-md-4" id="" name="end_year">
                        <option value="">Year</option>
                        @for($i=now()->year;$i>now()->year-50;$i--)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    <select class="form-control col-md-4" id="" name="end_month">
                        <option value="">Month</option>
                        @for($i=01;$i<13;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                     <select class="form-control col-md-4" id="" name="end_date">
                        <option value="">Day</option>
                        @for($i=01;$i<32;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-form-label">Set visibility:</label>
                      <input type="hidden" id="who_see_input" name="who_see_input">
                        <ul id="accessing_permission_modal" style="width: 150px;height: 50px;border-radius: 15px 50px;background-color: #E8EAED;margin-top:-40px;margin-left: 100px; "  tabindex="0"  data-placement="top" role="button" data-toggle="popover" data-trigger="hover" title="Who Can See this" >
                        <li class="list-inline-item " id="every_one_true" style="margin: 15px 0px 0px -10px"><a ><i class="fa fa-users margin-right-10px color-black"></i></a></li>
                        <li class="list-inline-item" id="trasted_people_true" ><a ><i class="fa fa-key margin-right-10px"></i></a></li> 
                        <li class="list-inline-item" id="only_me_true" ><a ><i class="fa fa-lock margin-right-10px"></i></a></li>
                    </ul>
                  </div>
                   <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                          <input type="hidden" id="send_success_div_id">
                            <button type="button" class="btn btn-primary" onclick="submit_data(document.getElementById('modal_url').value,'bio_info_form',document.getElementById('send_success_div_id').value)">Add to list</button>
                        </div>
                        <div class="col-md-3">
                            <a data-dismiss="modal" class="btn btn-danger">Cancle</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
{{--Modal end--}}
@push('scripts')
<script type="text/javascript">

 $(function () {
my_ajax('get_country_name','',document.getElementById('country'));
  $('[data-toggle="popover"]').popover({
     html: true,
      content: function() {
        return $('#popover-content').html();
      }
  })

  $('#keywords_modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var keyword_obj = button.data('keywords') 
  var modal = $(this)
  var data='<div class="row" id="keyword_div0"><div class="col-md-7"><div class="form-group"><input type="text" class="form-control" name="keyword"></div></div><div class="col-md-1"><a onclick="remove_keyword_div('+"'keyword_div0'"+')"><i class="fa fa-trash" style="color: red"></i></a></div><div class="col-md-4"><div class="form-group"><input type="hidden" name="permission" id="p02i" value="list-inline-item ev22"><ul id="120who42_see_a_0nkdmsjn" style="width: 150px;height: 50px;border-radius: 15px 50px;background-color: #E8EAED; "  tabindex="0"  data-placement="top" role="button" data-toggle="popover" data-trigger="hover" title="Who Can See this" ><li class="list-inline-item ev22" onclick="permission('+"'120who42_see_a_0nkdmsjn',this,'p02i')"+'" style="margin: 15px 0px 0px -10px"><a><i class="fa fa-users margin-right-10px color-black"></i></a></li><li class="list-inline-item ev11" onclick="permission('+"'120who42_see_a_0nkdmsjn',this,'p02i')"+'"><a><i class="fa fa-key margin-right-10px"></i></a></li> <li class="list-inline-item ev00" onclick="permission('+"'120who42_see_a_0nkdmsjn',this,'p02i')"+'"><a><i class="fa fa-lock margin-right-10px"></i></a></li></ul> </div></div></div>';
  console.log(keyword_obj);
  var len = keyword_obj.length;
  if(len >0){ data = ''; 
  for(var i=0;i<len;i++){
    data += '<div class="row" id="keyword_div'+keyword_obj[i]['keyword']+'"><div class="col-md-7"><div class="form-group"><input type="text" class="form-control" name="keyword" value="'+keyword_obj[i]['keyword']+'"></div></div><div class="col-md-1"><a onclick="remove_keyword_div('+"'keyword_div"+keyword_obj[i]['keyword']+"')"+'"><i class="fa fa-trash" style="color: red"></i></a></div><div class="col-md-4"><div class="form-group"><input type="hidden" name="permission" id="key_p_in'+i+'" value="list-inline-item ev22"><ul id="who_see'+keyword_obj[i]['keyword']+'" style="width: 150px;height: 50px;border-radius: 15px 50px;background-color: #E8EAED; "  tabindex="0"  data-placement="top" role="button" data-toggle="popover" data-trigger="hover" title="Who Can See this" ><li class="list-inline-item ev22" onclick="permission('+"'who_see"+keyword_obj[i]['keyword']+"',this,'key_p_in"+i+"')"+'" style="margin: 15px 0px 0px -10px"><a><i class="fa fa-users margin-right-10px color-black"></i></a></li><li class="list-inline-item ev11" onclick="permission('+"'who_see"+keyword_obj[i]['keyword']+"',this,'key_p_in"+i+"')"+'"><a><i class="fa fa-key margin-right-10px"></i></a></li> <li class="list-inline-item ev00" onclick="permission('+"'who_see"+keyword_obj[i]['keyword']+"',this,'key_p_in"+i+"')"+'"><a><i class="fa fa-lock margin-right-10px"></i></a></li></ul> </div></div></div>';
  }
}
  document.getElementById('new_keyword_div').innerHTML = data
})


  //..............................................................
 $('#employment_modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var modal_name = button.data('modal_name') // Extract info from data-* attributes
  var modal_url = button.data('modal_url') // Extract info from data-* attributes
  var type = button.data('type') // Extract info from data-* attributes
  var success_div_id = button.data('success_div_id') // Extract info from data-* attributes
  var modal = $(this)
  modal.find('.modal-body input').val('')
  modal.find('#moda_title').text('Add '+modal_name)
  modal.find('#modal_url').val(modal_url)
  modal.find('#who_see_input').val('every_one_true')
  modal.find('#type').val(type)
  modal.find('#send_success_div_id').val(success_div_id)
})

$("#accessing_permission_modal li").click(function(){
    $("#accessing_permission_modal li a i").removeClass("color-black");
    $("a i",this).addClass("color-black");
    $('input[name=who_see_input]').val($(this).attr('id'));
  });

  })
function create_keyword_div(){
      var div = document.createElement('div');
      document.getElementById('new_keyword_div').appendChild(div);
      div.innerHTML = '<div class="row" id="keyword_divqq'+k_div+'"><div class="col-md-7"><div class="form-group"><input type="text" class="form-control" name="keyword"></div></div><div class="col-md-1"><a onclick="remove_keyword_div('+"'keyword_divqq"+k_div+"'"+')"><i class="fa fa-trash" style="color: red"></i></a></div><div class="col-md-4"><div class="form-group"><input type="hidden" id="put_premission'+k_div+'" name="permission" value="list-inline-item ev22"><ul id="120who42_see_a_0nkdmsjn'+k_div+'" style="width: 150px;height: 50px;border-radius: 15px 50px;background-color: #E8EAED; "  tabindex="0"  data-placement="top" role="button" data-toggle="popover" data-trigger="hover" title="Who Can See this" ><li class="list-inline-item ev22"  onclick="permission('+"'120who42_see_a_0nkdmsjn"+k_div+"',this,'put_premission"+k_div+"')"+'" style="margin: 15px 0px 0px -10px"><a><i class="fa fa-users margin-right-10px color-black"></i></a></li><li class="list-inline-item ev11" onclick="permission('+"'120who42_see_a_0nkdmsjn"+k_div+"',this,'put_premission"+k_div+"')"+'"><a><i class="fa fa-key margin-right-10px"></i></a></li> <li class="list-inline-item ev00" onclick="permission('+"'120who42_see_a_0nkdmsjn"+k_div+"',this,'put_premission"+k_div+"')"+'"><a><i class="fa fa-lock margin-right-10px"></i></a></li></ul> </div></div></div>';
      k_div++;
    }
 function remove_keyword_div(div_id){
      document.getElementById(div_id).remove();
    }

 function permission(id,a,p_val=null){
    $("#"+id+" li a i").removeClass("color-black");
    $("a i",a).addClass("color-black");
    if(p_val !=null){$('input[id='+p_val+']').val($(a).attr('class'))}
 }

    function hide_show_toggle(id1,id2=null){
     var div_id1=document.getElementById(id1)
     var div_id2=document.getElementById(id2)
       if(div_id1.style.display == 'none')
       { $("#"+id1).show(1000);
        $("#"+id2).hide(1000);}
       else
       { $("#"+id2).show(1000);
        $("#"+id1).hide(1000);}
    }

function my_ajax(url,form_data,success_div=null,error_div=null){
    $.ajax({
               type: 'POST',
                url: url,
                cache: false,
                data: {
                      "_token" : $('meta[name=_token]').attr('content'),  
                      form_data:form_data 
                    },   
                 success: function (msg) { 
                      success_div.innerHTML=msg;
                     console.log(msg);
                    }
                });
 }
 function get_organization_name(){
     var value = document.getElementById('organization-name').value;
     var success_div = document.getElementById('organization_list');
     my_ajax('get_organization_name',value,success_div);
     success_div.style.display='block';
 }
 function put_value(name,city,state_region,country_id){
    document.getElementById('organization_list').style.display='none';
    document.getElementById('organization-name').value=name;
    document.getElementById('city').value=city;
    document.getElementById('state_region').value=state_region;
    var op='option[value="'+country_id+'"]';
    $('#country').find(op).attr('selected','selected')

 }
 function submit_data(url,form_id,success_div_id=null){
    var value = $('#'+form_id).serializeArray();
    if(success_div_id != null){
      var s_div = document.getElementById(success_div_id);
      my_ajax(url,value,s_div);
    }
    else{my_ajax(url,value,'');}
    //$('#employment_modal').modal('hide');
 }
   
function confirm_delete(url,primary_key_id){
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    my_ajax(url,primary_key_id,'');
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
} 

   

</script>


@endpush
@endsection
