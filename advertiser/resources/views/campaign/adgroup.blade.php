@extends('layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Adgroups
                            <br><br>
                            <a href="/create-adgroup">
                                <button type="button" class="btn btn-outline-success btn-fw">Create New Adgroup</button>
                            </a>
                        </h4> 
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Campaigns</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($adgroup_list as $group)
                                    <tr>
                                        <td>{{ $group->adgroup_id }}</td>
                                        <td>
                                            <!-- Display ad group name -->
                                            <span id="adgroupName_{{ $group->adgroup_id }}">{{ $group->adgroup_name }}</span>
                                        </td>
                                        <td>
                                            <!-- Show campaign count with link to campaigns -->
                                            <a href="{{ route('campaigns.by.adgroup', $group->adgroup_id) }}" class="badge badge-info">
                                                {{ $group->campaigns_count }} Campaigns
                                            </a>
                                        </td>
                                        <td>
                                            <!-- Edit Button - Opens Modal -->
                                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editAdgroupModal{{ $group->adgroup_id }}">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </button>
                                            
                                            <!-- View Button -->
                                            <a href="{{ route('campaigns.by.adgroup', $group->adgroup_id) }}" class="btn btn-outline-info btn-sm">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    <!-- Edit Modal for each ad group -->
                                    <div class="modal fade" id="editAdgroupModal{{ $group->adgroup_id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Ad Group</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('adgroup.update', $group->adgroup_id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="adgroup_name">Ad Group Name</label>
                                                            <input type="text" class="form-control" name="adgroup_name" value="{{ $group->adgroup_name }}" required>
                                                            <small class="form-text text-muted">Ad Group ID: {{ $group->adgroup_id }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection