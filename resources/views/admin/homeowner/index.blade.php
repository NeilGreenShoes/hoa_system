<link rel="stylesheet" href="{{ asset('resources/css/admin/homeowner/index.css')}}">
<script src="{{ asset('resources/js/admin/homeowner/homeowner.js')}}"></script>
<script src="{{ asset('resources/js/admin/homeowner/index.js')}}"></script>
<x-admin>
    <x-view-header title="Homeowner Registrations">

    </x-view-header>
    <div class="container-buttons">
        <button class="btn view-btn" data-url="{{ route('admin.homeowner.index')}}">Homeowners</button>
        <button class="btn view-btn" data-url="{{ route('admin.homeowner.pending')}}">Pending</button>
    </div>
    <div class="table-container container-homeowner">
        <table class="table homeowner">
            <thead class="thead">
                <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>CONTACT</th>
                    <th>EMAIL</th>
                    <th>STATUS</th>
                    <th>ONLINE</th>
                    <th>LAST SESSION</th>
                    <th>REGISTERED</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @if ($homeowners)
                    @foreach($homeowners as $homeowner)
                    <tr>
                        <td>{{ $homeowners->firstItem() + $loop->index }}</td>
                        <td>
                            <img class="profile-img"
                            src="{{ asset('storage/app/public/' . ($homeowner->profileImage ?: 'profiles/default-profile.png')) }}"
                            onerror="this.onerror=null;this.src='{{ asset('storage/app/public/profiles/default-profile.png') }}';"
                            alt="Profile">
                            {{ $homeowner->fullname()}}
                        </td>
                        <td>{{ $homeowner->gender}}</td>
                        <td>{{ $homeowner->contactNumber}}</td>
                        <td>{{ $homeowner->user->loginEmail}}</td>
                        <td>{{ $homeowner->user->status}}</td>
                        <td>
                            @if ($homeowner->user->isLoggedIn)
                                <span class="status span-online"><i class="online circle fa-solid fa-circle fa-xs"></i> Online</span>
                            @else 
                                <span class="status span-offline"><i class="offline circle fa-solid fa-circle fa-xs"></i> Offline</span>
                            @endif
                        </td>
                        <td>{{ $homeowner->user->lastSession ?? 'Has not logged in yet'}}</td>
                        <td>{{ \Carbon\Carbon::parse($homeowner->created_at)->format('M d, Y') }}</td>
                        <td>
                            <button class="btn btn-view" data-url="{{route('admin.homeowner.show', $homeowner->homeownerID)}}">
                                <i class="fa-regular fa-eye"></i>
                                View
                            </button>
                            <form class="requestUpdateForm"
                                action="{{ route('admin.homeowner.request_update_profile', $homeowner->homeownerID) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Confirm request update?');">
                                @csrf

                                <button type="submit" class="btn btn-request-update">
                                    <i class="fa-solid fa-pen fa-xs"></i>
                                    <span class="btnText">Request Update</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    </tr>
                        <td>No homeowners, registered!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    {{ $homeowners->links('vendor.pagination.bootstrap-5') }}
</x-admin>