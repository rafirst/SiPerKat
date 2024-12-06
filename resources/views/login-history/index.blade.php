@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Login</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>IP Address</th>
                                    <th>Browser</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $history)
                                <tr>
                                    <td>{{ $history->user->name }}</td>
                                    <td>{{ $history->ip_address }}</td>
                                    <td>{{ $history->user_agent }}</td>
                                    <td>{{ $history->login_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        @if($history->logout_at)
                                            {{ $history->logout_at->format('d/m/Y H:i:s') }}
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($history->logout_at)
                                            {{ $history->logout_at->diffForHumans($history->login_at, true) }}
                                        @else
                                            {{ now()->diffForHumans($history->login_at, true) }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 