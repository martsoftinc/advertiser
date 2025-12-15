@extends('layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">New Campaign
                        <br><br> 
                    
                    <form action="" method="POST">
        @csrf
        <input type="hidden" name="id" value ='{{$edit->id}}'>  
        <div class="form-group">
        <label for="ad_group_id">Select Ad Group</label>
        <select name="adgroup_id"  class="form-control" required>
            <option value="">Select an Ad Group</option>
            @foreach($adGroups as $adGroup)
                <option value="{{ $adGroup->adgroup_id }}">{{ $adGroup->adgroup_name }} (ID: {{ $adGroup->adgroup_id }})</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="campaign_name">Campaign Name</label>
            <input type="text" class="form-control" value="campaign_name" name="campaign_name" >
        </div>

        <div class="form-group">
            <label for="website_url">Landing Page</label>
            <input type="url" class="form-control" value="{{$edit->landing_page}}" name="landing_page" readonly>
        </div>

         <div class="form-group">
            <label for="website_url">Final URL</label>
            <input type="url" class="form-control" id="final_url" name="final_url" value="{{$edit->final_url}}" readonly>
        </div>


        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control"  name="end_date" >
        </div>

        <div class="form-group">
            <label for="end_date">Daily Budget ($)</label>
            <input type="number" class="form-control"  name="daily_budget" value="{{$edit->daily_budget}}" required>
        </div>

        <div class="form-group">
        <label for="ad_group_id">Gender</label>
        <select name="gender"  class="form-control" required>
            
            <option value="" disabled selected>Select Gender</option>
                        <option value="all">All Genders</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      
        </select>
        </div>

        

        

        

        

        <div class="form-group">
            <label for="country">Country</label>
             <select multiple class="form-control select2" id="exampleSelect2" name="country" required>
             <option value="SA">South Africa</option>
             <option value="Kenya">Kenya</option>
           
    <!-- More options -->
</select>
</div>



        

        <button type="submit" class="btn btn-primary">Create Campaign</button>
    </form>
                    
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>

            <!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
           
          <!-- content-wrapper ends -->
@endsection