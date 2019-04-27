@extends('layouts.app')

@section('content')


<div style="background-image: url('image/index_page/image-home.jpg');height: 500px;color: white">
    <h3 style="font-size: 80px;width: 600px;margin-left: 80px;">Track more of your research impact</h3>
</div>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <h3><br><br>Over 650,000 researchers</h3>
    </div>
    <div class="col-md-6">
        <p>Use Publons to track your publications, citation metrics, peer reviews, and journal editing work in a single, easy-to-maintain profile.</p>
        <ul>
            <li>All your publications, instantly imported from Web of Science, ORCID, or your bibliographic reference manager (e.g. EndNote or Mendeley).</li>
             <li>All your publications, instantly imported from Web of Science, ORCID, or your bibliographic reference manager (e.g. EndNote or Mendeley).</li>
              <li>All your publications, instantly imported from Web of Science, ORCID, or your bibliographic reference manager (e.g. EndNote or Mendeley).</li>
               <li>All your publications, instantly imported from Web of Science, ORCID, or your bibliographic reference manager (e.g. EndNote or Mendeley).</li>
        </ul>
    </div>
    <div class="col-md-6">
        <img src="{{url('image/index_page/index_dashboard.png')}}" width="100%">
    </div>

    <div class="col-md-4" style="height:220px;">
      <div style="text-align: center;position: relative;">
            <img src="{{url('image/index_page/index_researchers.jpg')}}" width="100%">
          <p style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white">For Researchers</p>
      </div>
    </div>
   <div class="col-md-4" style="height:200px;">
      <div style="text-align: center;position: relative;">
            <img src="{{url('image/index_page/index_researchers.jpg')}}" width="100%">
          <p style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white">For Researchers</p>
      </div>
    </div>
    <div class="col-md-4" style="height:200px;">
      <div style="text-align: center;position: relative;">
            <img src="{{url('image/index_page/index_researchers.jpg')}}" width="100%">
          <p style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white">For Researchers</p>
      </div>
    </div>
</div>
</div>


@endsection
