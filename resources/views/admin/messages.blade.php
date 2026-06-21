@extends('layouts.admin') @section('title', 'Admin - Messages Management')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title" style="font-weight: 700; color: #333; margin-bottom: 20px;">Contact Messages</h4>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card" style="border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-radius: 12px; margin-bottom: 25px;">
    <div class="card-body">
        <form action="{{ route('admin.messages') }}" method="GET">
            <div class="row filter-row">
                <div class="col-sm-6 col-md-5">
                    <div class="form-group form-focus">
                        <input type="text" name="search" class="form-control floating" placeholder="Search by name or keyword..." value="{{ request('search') }}" style="border-radius: 8px; height: 45px;">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group form-focus select-focus">
                        <select name="status" class="form-control select floating" onchange="this.form.submit()" style="border-radius: 8px; height: 45px;">
                            <option value="">All Messages</option>
                            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread Only</option>
                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read Only</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; height: 45px; font-weight: 600;"> Filter </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm" style="border: none; border-radius: 12px; overflow: hidden;">
            <div class="table-responsive">
                <table class="table table-border table-striped custom-table datatable mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th style="padding: 15px;">Sender Details</th>
                            <th>Department</th>
                            <th>Message Snippet</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                            <tr style="{{ !$msg->is_read ? 'background-color: #f0f7ff; font-weight: 600;' : '' }}">
                                <td style="padding: 15px;">
                                    <span style="color: #1a3d6d; font-weight: 700;">{{ $msg->name }}</span><br>
                                    <small class="text-muted">{{ $msg->email }}</small><br>
                                    <small class="text-muted">{{ $msg->phone ?? 'No Phone' }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-light" style="border: 1px solid #ddd; padding: 6px 10px; border-radius: 20px;">
                                        {{ $msg->department ?? 'General' }}
                                    </span>
                                </td>
                                <td style="max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #555;">
                                    {{ $msg->message }}
                                </td>
                                <td class="text-muted" style="font-size: 13px;">
                                    {{ $msg->created_at->format('M d, Y - h:i A') }}
                                </td>
                                <td>
                                    @if($msg->is_read)
                                        <span class="badge badge-success" style="padding: 5px 10px; border-radius: 4px;">Read</span>
                                    @else
                                        <span class="badge badge-danger" style="padding: 5px 10px; border-radius: 4px;">New</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action" style="display: inline-flex; gap: 8px;">
                                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center" style="padding: 40px; color: #999;">
                                    <i class="fa fa-envelope-open-o" style="font-size: 32px; margin-bottom: 10px; display:block;"></i>
                                    No contact messages available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $messages->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection