@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="mt-5">Countries/Regions</h3>
<table id="example" class="table table-bordered table-condensed table-hover">
 <thead>
    <tr>
     <th>#</th>
     <th>Country/Region</th>
     <th>Reviewers</th>
     <th>Top Reviewers</th>
     <th>Verified Reviews</th>
     <th>Verified Reviews last 12 months</th>
     <th>Verified editor records</th>
    </tr>
 </thead>
 <tbody>
    <tr>
     <td>1</td>
     <td>
       <img src="{{url('image/logo/unknown.png')}}">mokbul hossain
     </td>
     <td>5000</td>
      <td>1</td>
     <td>bicycle</td>
     <td>5000</td>
     <td>5000</td>
    </tr>

    <tr>
     <td>1</td>
     <td>bicycle</td>
     <td>5000</td>
      <td>1</td>
     <td>bicycle</td>
     <td>5000</td>
     <td>5000</td>
    </tr>

 </tbody>
</table>

    </div>
  </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endpush