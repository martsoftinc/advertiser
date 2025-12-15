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
                    
                    <form action="{{route('store')}}" method="POST">
        @csrf

        <div class="form-group">
        <label for="ad_group_id">Select Ad Group(<i>create adgroup <a href="adgroup">here</a></i>)</label>
        <select name="adgroup_id"  class="form-control" required>
            <option value="">Select an Ad Group</option>
            @foreach($adGroups as $adGroup)
                <option value="{{ $adGroup->adgroup_id }}">{{ $adGroup->adgroup_name }} (ID: {{ $adGroup->adgroup_id }})</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="campaign_name">Campaign Name</label>
            <input type="text" class="form-control" id="campaign_name" name="campaign_name" >
        </div>

        <div class="form-group">
            <label for="website_url">Landing Page</label>
            <input type="url" class="form-control" id="landing_page" name="landing_page">
        </div>

         <div class="form-group">
            <label for="website_url">Final URL</label>
            <input type="url" class="form-control" id="final_url" name="final_url" >
        </div>


        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control"  name="end_date" >
        </div>

        <div class="form-group">
            <label for="end_date">Daily Budget ($)</label>
            <input type="number" class="form-control"  name="daily_budget" required>
        </div>

        <div class="form-group">
            <label for="end_date">Cpc (minimum 0.01)</label>
            <input type="number" class="form-control" name="cpc" step="0.001" min="0" required>
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
        <label for="age_group">Age Group</label>
        <select name="age_group"  class="form-control" required>
            
            <option value="" disabled selected>Select Gender</option>
                        <option value="all">All age groups</option>
                        <option value="18-25">18-25</option>
                        <option value="26-35">26-35</option>
                        <option value="36-45">36-45</option>
                        <option value="46-55">46-55</option>
                        <option value="56+">56+</option>
                      
        </select>
        </div>

        
        

        

        

       <div class="form-group">
    <label for="countries">Select Countries</label>
    <select class="form-control select2-multiple" id="countries" name="countries[]" multiple="multiple">
        @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
</div>



        

        <button type="submit" class="btn btn-primary">Create Campaign</button>
    </form>

    <script>
    $(document).ready(function() {
        $('#countrySelect').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select countries',
            allowClear: true,
            closeOnSelect: false
        });
    });
</script>
                    
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Wait for document to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Check if jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded');
            return;
        }
        
        // Check if Select2 is loaded
        if (typeof $.fn.select2 === 'undefined') {
            console.error('Select2 is not loaded');
            return;
        }
        
        // Initialize Select2
        try {
            $('#countries').select2({
                placeholder: 'Search and select countries',
                allowClear: true,
                width: '100%'
            });
            console.log('Select2 initialized successfully');
        } catch (error) {
            console.error('Error initializing Select2:', error);
        }
    });
</script>
           
          <!-- content-wrapper ends -->
          @endsection