<link rel="stylesheet" href="{{ asset('resources/css/admin/homeowner/pending.css')}}">
<script src="{{ asset('resources/js/admin/homeowner/homeowner.js')}}"></script>
<script src="{{ asset('resources/js/admin/homeowner/pending.js')}}"></script>
<x-admin>
    <x-view-header title="Pending Registration">
    </x-view-header>
    <div class="container-buttons">
        <button class="btn view-btn" data-url="{{ route('admin.homeowner.index')}}">Homeowners</button>
        <button class="btn view-btn" data-url="{{ route('admin.homeowner.pending')}}">Pending</button>
    </div>

    <div class="table-container container-pending">
        <table class="table table-pending">
            <thead> 
                <tr>
                    <td>#</td>
                    <td>LOT NUMBER</td>
                    <td>FULL NAME</td>
                    <td>EMAIL</td>
                    <td>PAYMENT</td>
                    <td>RECEIPT</td>
                    <td>VALID ID</td>
                    <td>DOCUMENT</td>
                    <td>DATE</td>
                    <td>ACTIONS</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $registration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>B{{ $registration->houseLot->blockNumber}} L{{ $registration->houseLot->lotNumber}}</td>
                        <td>{{ $registration->staff->name()}}</td>
                        <td>{{ $registration->staff->email}}</td>
                        <td>{{ $registration->billing->payment->paymentMethod->methodName ?? 'Gcash'}}</td>
                        <td>
                            <button
                                class="btn btn-primary btn-receipt"
                                data-src="{{ asset('public/storage/' . $registration->receipt) }}">
                                View Receipt
                            </button>
                        </td>

                        <td>
                            <button
                                class="btn btn-primary btn-valid-id"
                                data-src="{{ asset('public/storage/' . $registration->validIDImage) }}">
                                View Valid ID
                            </button>
                        </td>

                        <td>
                            <button
                                class="btn btn-primary btn-lot-document"
                                data-src="{{ asset('public/storage/' . $registration->lotDocument) }}">
                                View Lot Document
                            </button>
                        </td>
                        <td>{{ $registration->registrationDate}}</td>
                        <td>
                            <form action="{{ route('admin.homeowner.approve_registration', $registration->registrationID) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to approve this registration?');">
                                @csrf

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-check"></i>
                                    APPROVE
                                </button>
                            </form>

                            <form action="{{ route('admin.homeowner.reject_registration', $registration->registrationID) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to reject this registration?');">
                                @csrf

                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa-solid fa-x"></i>
                                    REJECT
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No pending Registration yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id="previewOverlay" class="preview-overlay">
        <div class="preview-content">

            <button type="button" class="preview-close">&times;</button>

            <img id="previewImage" src="" alt="Preview" style="display:none;">

            <iframe id="previewPDF"
                    src=""
                    style="display:none;"
                    frameborder="0">
            </iframe>

        </div>
    </div>
</x-admin>