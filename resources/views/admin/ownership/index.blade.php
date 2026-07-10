<x-admin>
    <x-view-header title="Ownership Transfer">
    </x-view-header>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>BLOCK/LOT</td>
                    <td>FROM</td>
                    <td>TO</td>
                    <td>REASON</td>
                    <td>DOCUMENT</td>
                    <td>STATUS</td>
                    <td>DATE</td>
                    <td>ACTIONS</td>
                </tr>
            </thead>
            <tbody>
                @forelse($ownershipTransfer as $ownership)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                </tr>
                @empty
                <tr>
                    <td>
                        No request ownership transfer request
                    </td>
                </tr>
                @endforelse
        </table>
    </div>
</x-admin>