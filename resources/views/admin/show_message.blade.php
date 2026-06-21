@extends('layouts.admin') @section('title', 'View Message Details')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title" style="font-weight: 700; color: #333;"><a href="{{ route('admin.messages') }}" class="btn btn-white btn-sm" style="border: 1px solid #ccc; margin-right: 10px;"><i class="fa fa-arrow-left"></i> Back</a> Message Details</h4>
    </div>
</div>

<div class="row justify-content-center" style="margin-top: 20px;">
    <div class="col-md-8">
        <div class="card" style="border: none; box-shadow: 0 4px 25px rgba(0,0,0,0.06); border-radius: 12px; overflow: hidden;">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0" style="font-weight: 700; color: #1a3d6d;">From: {{ $message->name }}</h5>
                    <small class="text-muted"><i class="fa fa-envelope"></i> {{ $message->email }}</small>
                </div>
                <span class="badge badge-success" style="padding: 6px 12px; font-size: 11px;">Opened & Read</span>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <label class="text-muted small text-uppercase" style="letter-spacing: 0.5px;">Phone Number</label>
                        <p class="mb-0" style="font-weight: 600; color: #333;">{{ $message->phone ?? 'Not Provided' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small text-uppercase" style="letter-spacing: 0.5px;">Department</label>
                        <p class="mb-0"><span class="badge badge-info text-dark">{{ $message->department ?? 'General Inquiry' }}</span></p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <label class="text-muted small text-uppercase" style="letter-spacing: 0.5px;">Received At</label>
                        <p class="mb-0 text-secondary" style="font-size: 13px;"><i class="fa fa-clock-o"></i> {{ $message->created_at->toDayDateTimeString() }}</p>
                    </div>
                </div>
                
                <hr style="border-top: 1px solid #eee;">

                <div class="mt-4">
                    <label class="text-muted small text-uppercase mb-2" style="letter-spacing: 0.5px; font-weight: 700;">Message Content</label>
                    <div style="background-color: #fdfdfd; border: 1px solid #eaeaea; border-radius: 8px; padding: 20px; color: #555; line-height: 1.7; white-space: pre-line;">
                        {{ $message->message }}
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top text-right py-3">
                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message permanently?');" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="border-radius: 6px; padding: 8px 20px; font-weight: 600;">
                        <i class="fa fa-trash-o"></i> Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection