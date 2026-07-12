<x-admin>
    <x-view-header title="Water Reading">
    </x-view-header>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>BLOCK/LOT</th>
                    <th>HOMEOWNER</th>
                    <th>PREVIOUS</th>
                    <th>CURRENT</th>
                    <th>CONSUMPTION</th>
                    <th>READING DATE</th>
                    <th>AMOUNT</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($water as $reading)
                    <tr>
                        <td>B{{ $reading->membership->homeowner->lot->blockNumber}} L{{ $reading->membership->homeowner->lot->lotNumber}}</td>
                        <td>{{$reading->membership->homeowner->fullname()}}</td>
                        <td>{{number_format($reading->previousReading, 0)}}</td>
                        <td>{{number_format($reading->currentReading, 0)}}</td>
                        <td>{{number_format($reading->consumption, 0)}} m²</td>
                        <td>{{$reading->readingDate->format('M d, Y')}}</td>
                        <td>{{number_format($reading->amount, 2)}}</td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td>No water readings yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin>