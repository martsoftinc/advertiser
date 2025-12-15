@extends('layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Campaigns 
                        <br><br><a href="/create-campaign"><button type="button" class="btn btn-outline-success btn-fw">Create New Campaign</button></a></h4> 
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('campaign.list') }}" class="mb-3"> <!-- Adjust route name if different -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="adgroup_id">Filter by AdGroup:</label>
                                <select name="adgroup_id" id="adgroup_id" class="form-control">
                                    <option value="">All AdGroups</option>
                                    @foreach($adgroups as $adgroup)
                                        <option value="{{ $adgroup->adgroup_id }}" {{ $adgroupFilter == $adgroup->adgroup_id ? 'selected' : '' }}>
                                            {{ $adgroup->adgroup_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> AdGroup</th>
                            <th> Name</th>
                            
                           
                            <th> End Date </th>
                            <th> Budget </th>
                            <!-- <th> Country </th> -->
                            <th> Status</th>
                            <th> Edit</th>
                          
                     
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($campaigns as $campaign)
                          <tr>
                            
                            <td>{{ $campaign->adGroup->adgroup_name ?? 'N/A' }}</td>
                           <td><a href="{{ $campaign->final_url }}" target="_blank">{{ $campaign->campaign_name }}</a></td>
                           
                          
                            <td> {{$campaign->end_date}}</td>
                            <td> {{$campaign->daily_budget}}</td>
                            
                            <td>
                                @if($campaign->status == "Under Review")
                                    <div class="badge badge-outline-warning">{{$campaign->status}}</div>                       
                                @elseif($campaign->status == "approved")
                                    <div class="badge badge-outline-success">{{$campaign->status}}</div>
                                    <form action="{{ route('toggle-campaign-status', $campaign->id) }}" method="POST" style="display: inline-block; margin-left: 5px;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Pause this campaign?')">Pause</button>
                                    </form>
                                @elseif($campaign->status == "paused")
                                    <div class="badge badge-outline-secondary">{{$campaign->status}}</div>
                                    <form action="{{ route('toggle-campaign-status', $campaign->id) }}" method="POST" style="display: inline-block; margin-left: 5px;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Activate this campaign?')">Activate</button>
                                    </form>
                                @else
                                    <div class="badge badge-outline-info">{{$campaign->status}}</div>
                                @endif
                            </td>
                           
                           <td>
                              <a href="{{ route('edit-campaign', ['id' => $campaign->id]) }}"><button type="button"
                              class="btn btn-warning">Edit</button></a>
                              <a href="{{ route('delete-campaign', ['id' => $campaign->id]) }}"><button type="button"
                              class="btn btn-danger">Delete</button></a>
                            </td>
                          </tr>
                          
                          @endforeach
                          
                          
                          
                        </tbody>
                      </table><br>
                      <div class="d-flex justify-content-end">
                 {{ $campaigns->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>
            
           
          <!-- content-wrapper ends -->
          @endsection