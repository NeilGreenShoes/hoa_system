<link rel="stylesheet" href="{{ asset('resources/css/admin/billing/index.css')}}?v={{ filemtime(resource_path('css/admin/billing/index.css')) }}">
<x-admin>
    <x-view-header title="Billing">
        <button class="btn btn-primary" 
                data-url="{{ route('admin.billing.create') }}" 
                onclick="window.location = this.getAttribute('data-url')">
            Create Billing
        </button>
    </x-view-header>
    <div class="kanban">
        <div class="kanban-card">
            <h2>Total Collected</h2>
            <p style="color: green">₱ {{$total_collected}}</p>
        </div>

        <div class="kanban-card">
            <h2>Total Unpaid</h2>
            <p style="color: red">₱ {{$total_unpaid}}</p>
        </div>

        <div class="kanban-card">
            <h2>Total Billings</h2>
            <p>{{$total}}</p>
        </div>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>HOMEOWNERS</th>
                    <th>BLOCK/LOT</th>
                    <th>DATE</th>
                    <th>FEES</th>
                    <th>TOTAL</th>
                    <th>DUE</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bill as $b)
                    <tr>
                        <td>{{$b->membership->homeowner->fullname()}}</td>
                        <td>B{{$b->membership->homeowner->lot->blockNumber}} L{{$b->membership->homeowner->lot->lotNumber}}</td>
                        <td>{{$b->billingDate->format('M d, Y')}}</td>
                        <td> 
                            @if ($b->monthlyDue)Monthly Fee @endif
                            @if ($b->securityFee), Security Fee @endif
                            @if ($b->penaltyFee), Penalty Fee @endif
                            @if ($b->reconnectionFee), Reconnection Fee @endif
                            @if ($b->arrears), Arrears Fee @endif
                        </td>
                        <td>{{$b->totalAmount}}</td>
                        <td>{{$b->dueDate->format('M d, Y')}}</td>
                        <td>
                            <span class="status-cell status-{{ str_replace(' ', '', strtolower($b->status)) }}">
                                {{$b->status}}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No billings</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin>