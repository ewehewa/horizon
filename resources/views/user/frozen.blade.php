@extends('layouts.dash2')
@section('title', 'Account Frozen')
@section('content')

<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 20px;">
    <div
        style="max-width: 600px; width: 100%; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,0.10); padding: 40px 32px; text-align: center;">
        <div style="margin-bottom: 24px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none"
                stroke="#dc3545" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                <line x1="12" y1="16" x2="12" y2="19"></line>
            </svg>
        </div>
        <h2 style="color: #dc3545; font-size: 26px; font-weight: 700; margin-bottom: 16px;">Account Frozen</h2>
        <div
            style="background: #fff3cd; border: 1px solid #ffc107; border-radius: 8px; padding: 20px; margin-bottom: 24px;">
            <p style="color: #664d03; font-size: 16px; line-height: 1.6; margin: 0;">
                Your account has been temporarily frozen pending IRS tax clearance. To proceed with unfreezing it,
                please contact support for further assistance.
            </p>
        </div>
        <a href="{{ route('support') }}"
            style="display: inline-block; background: #0d6efd; color: #fff; text-decoration: none; padding: 12px 32px; border-radius: 6px; font-size: 16px; font-weight: 600; transition: background 0.2s;">
            Contact Support
        </a>
    </div>
</div>

@endsection