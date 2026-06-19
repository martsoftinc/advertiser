@extends('layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Campaigns for Ad Group: <span class="text-primary">{{ $adgroup->adgroup_name }}</span>
                            <br><br>
                            <a href="/campaign-list">
                                <button type="button" class="btn btn-outline-secondary btn-fw">
                                    <i class="mdi mdi-arrow-left"></i> Back to All Campaigns
                                </button>
                            </a>
                            <a href="{{ route('campaign.create') }}?adgroup_id={{ $adgroup->adgroup_id }}">
                                <button type="button" class="btn btn-outline-success btn-fw">
                                    <i class="mdi mdi-plus"></i> Create New Campaign
                                </button>
                            </a>
                        </h4>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Campaign Name</th>
                                        <th>Landing Page</th>
                                        <th>Daily Budget</th>
                                        <th>Gender</th>
                                        <th>Age Group</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campaigns as $campaign)
                                    <tr>
                                        <td>{{ $campaign->id }}</td>
                                        <td>{{ $campaign->campaign_name }}</td>
                                        <td>
                                            <div class="input-group" style="max-width: 200px;">
                                                <input type="text" class="form-control form-control-sm" id="campaignUrl{{ $campaign->id }}" value="{{ $campaign->landing_page }}" readonly style="font-size: 12px;">
                                                <button class="btn btn-sm btn-outline-primary" onclick="copyLink('{{ $campaign->id }}')">
                                                    <i class="mdi mdi-content-copy"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>${{ number_format($campaign->daily_budget, 2) }}</td>
                                        <td>
                                            @if($campaign->gender == 'all')
                                                <span class="badge badge-info">All</span>
                                            @elseif($campaign->gender == 'male')
                                                <span class="badge badge-primary">Male</span>
                                            @elseif($campaign->gender == 'female')
                                                <span class="badge badge-danger">Female</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $campaign->gender }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($campaign->age_group == 'all')
                                                <span class="badge badge-info">All</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $campaign->age_group }}</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($campaign->end_date)->format('M d, Y') }}</td>
                                        <td>
                                            @if($campaign->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($campaign->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($campaign->status == 'paused')
                                                <span class="badge badge-secondary">Paused</span>
                                            @elseif($campaign->status == 'completed')
                                                <span class="badge badge-info">Completed</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit-campaign', $campaign->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <a href="#" class="btn btn-outline-info btn-sm">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            <div class="p-5">
                                                <i class="mdi mdi-inbox" style="font-size: 48px; color: #ccc;"></i>
                                                <p class="mt-3">No campaigns found for this ad group.</p>
                                                <a href="{{ route('campaign.create') }}?adgroup_id={{ $adgroup->adgroup_id }}" class="btn btn-success">
                                                    <i class="mdi mdi-plus"></i> Create Your First Campaign
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Display campaign stats -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Total Campaigns</h6>
                                        <h3 class="text-primary">{{ $campaigns->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Active Campaigns</h6>
                                        <h3 class="text-success">{{ $campaigns->where('status', 'active')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Pending Campaigns</h6>
                                        <h3 class="text-warning">{{ $campaigns->where('status', 'pending')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Total Daily Budget</h6>
                                        <h3 class="text-info">${{ number_format($campaigns->sum('daily_budget'), 2) }}</h3>
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

<script>
function copyLink(id) {
    var input = document.getElementById('campaignUrl' + id);
    input.select();
    input.setSelectionRange(0, 99999);
    
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(input.value).then(function() {
            // Show feedback
            var btn = event.target.closest('button');
            var originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="mdi mdi-check"></i>';
            btn.className = 'btn btn-sm btn-outline-success';
            setTimeout(function() {
                btn.innerHTML = originalHTML;
                btn.className = 'btn btn-sm btn-outline-primary';
            }, 2000);
        });
    } else {
        // Fallback
        document.execCommand('copy');
        alert('Link copied to clipboard!');
    }
}
</script>
@endsection