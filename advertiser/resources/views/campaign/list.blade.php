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
                    <form method="GET" action="{{ route('campaign.list') }}" class="mb-3">
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
                            <th>AdGroup</th>
                            <th>Test</th>
                            <th>Name</th>
                            <th>End Date</th>
                            <th>Budget</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($campaigns as $campaign)
                          <tr>
                            <td>{{ $campaign->adGroup->adgroup_name ?? 'N/A' }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#testModal{{ $campaign->id }}">
                                    <i class="mdi mdi-play-circle-outline"></i> Test
                                </button>
                            </td>
                            <td>
                                <a href="{{ $campaign->landing_page }}" target="_blank" 
                                    title="{{ $campaign->campaign_name }}">
                                    {{ Str::limit($campaign->campaign_name, 30, '...') }}
                                </a>
                            </td>
                            <td>{{ $campaign->end_date }}</td>
                            <td>{{ $campaign->daily_budget }}</td>
                            <td>
                                @if($campaign->status == "Under Review")
                                    <span class="badge badge-outline-warning" title="Under Review">
                                        <i class="mdi mdi-clock-outline"></i> Pending
                                    </span>                       
                                @elseif($campaign->status == "approved")
                                    <span class="badge badge-outline-success" title="Active">
                                        <i class="mdi mdi-play-circle-outline"></i> Active
                                    </span>
                                    <form action="{{ route('toggle-campaign-status', $campaign->id) }}" method="POST" style="display: inline-block; margin-left: 5px;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Pause Campaign" onclick="return confirm('Pause this campaign?')">
                                            <i class="mdi mdi-pause"></i>
                                        </button>
                                    </form>
                                @elseif($campaign->status == "paused")
                                    <span class="badge badge-outline-secondary" title="Paused">
                                        <i class="mdi mdi-pause-circle-outline"></i> Paused
                                    </span>
                                    <form action="{{ route('toggle-campaign-status', $campaign->id) }}" method="POST" style="display: inline-block; margin-left: 5px;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Activate Campaign" onclick="return confirm('Activate this campaign?')">
                                            <i class="mdi mdi-play"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="badge badge-outline-info" title="{{ $campaign->status }}">
                                        <i class="mdi mdi-information-outline"></i> {{ $campaign->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                              <div class="btn-group" role="group">
                                  <a href="{{ route('edit-campaign', ['id' => $campaign->id]) }}" class="btn btn-outline-primary btn-sm" title="Edit Campaign">
                                      <i class="mdi mdi-pencil"></i>
                                  </a>
                                  <a href="{{ route('delete-campaign', ['id' => $campaign->id]) }}" class="btn btn-outline-danger btn-sm" title="Delete Campaign" onclick="return confirm('Are you sure you want to delete this campaign?')">
                                      <i class="mdi mdi-delete"></i>
                                  </a>
                              </div>
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

          <!-- Modals for each campaign -->
          @foreach($campaigns as $campaign)
          <div class="modal fade" id="testModal{{ $campaign->id }}" tabindex="-1" role="dialog" aria-labelledby="testModalLabel{{ $campaign->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form id="verificationForm{{ $campaign->id }}" action="{{ route('verify.campaign') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $campaign->id }}">
                  
                  <div class="modal-header">
                    <h5 class="modal-title" id="testModalLabel{{ $campaign->id }}">
                      <i class="mdi mdi-test-tube mr-2"></i>Test Campaign: {{ Str::limit($campaign->campaign_name, 40, '...') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-info">
                      <h6><i class="mdi mdi-information-outline mr-2"></i>Verification Required</h6>
                      <p class="mb-0">To test and start this campaign, please verify it by:</p>
                      <ol class="mb-0">
                        <li>Visiting the campaign URL</li>
                        <li>Entering the verification code from the page</li>
                      </ol>
                    </div>
                    
                    <div class="form-group">
                      <label for="campaignUrl{{ $campaign->id }}">Campaign Test URL:</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="campaignUrl{{ $campaign->id }}" value="{{ $campaign->final_url }}" readonly>
                        <div class="input-group-append">
                          <a href="{{ $campaign->landing_page }}" target="_blank" class="btn btn-outline-primary" id="openLinkBtn{{ $campaign->id }}">
                            <i class="mdi mdi-open-in-new mr-1"></i> Open Link
                          </a>
                        </div>
                      </div>
                      <small class="form-text text-muted">Open this link in a new tab to see your campaign and get the verification code.</small>
                    </div>
                    
                    <div class="form-group">
                      <label for="verificationCode{{ $campaign->id }}">
                        <i class="mdi mdi-shield-check-outline mr-1"></i>Verification Code *
                      </label>
                      <input type="text" class="form-control" id="verificationCode{{ $campaign->id }}" 
                             name="verificationCode" placeholder="Enter the code from your campaign page" 
                             required autocomplete="off">
                      <small class="form-text text-muted">The verification code is displayed on your campaign page after opening it.</small>
                    </div>
                    
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="confirmWorking{{ $campaign->id }}" name="confirmed_working" required>
                        <label class="custom-control-label" for="confirmWorking{{ $campaign->id }}">
                          <i class="mdi mdi-check-circle-outline mr-1"></i>I confirm that I have tested the campaign URL and it's working correctly
                        </label>
                      </div>
                    </div>
                    
                    <!-- Display validation errors -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                      @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                      @endforeach
                    </div>
                    @endif
                    
                    <div class="alert alert-warning">
                      <small>
                        <i class="mdi mdi-alert-outline mr-1"></i>
                        <strong>Note:</strong> After verification, the campaign status will change to "Review".
                      </small>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                      <i class="mdi mdi-close mr-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                      <i class="mdi mdi-check-circle mr-1"></i>Verify & Subimit
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endforeach

          <script>
            // Add click event to store timestamp when link is opened
            document.addEventListener('DOMContentLoaded', function() {
              @foreach($campaigns as $campaign)
              document.getElementById('openLinkBtn{{ $campaign->id }}').addEventListener('click', function() {
                localStorage.setItem('campaign_{{ $campaign->id }}_opened', new Date().toISOString());
              });
              @endforeach
            });
          </script>

          @endsection