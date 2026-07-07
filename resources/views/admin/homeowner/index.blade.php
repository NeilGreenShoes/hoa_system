<x-admin>
    <x-view-header title="Homeowner Registrations">

    </x-view-header>
    <div class="container-buttons">
        <button href="">Homeowners</button>
        <button href="">Pending</button>
    </div>
    <div class="container-homeowner">
        <table class="table homeowner">
            <thead>
                <td>#</td>
                <td>NAME</td>
                <td>GENDER</td>
                <td>CONTACT</td>
                <td>DATE CREATED</td>
            </thead>
            <tbody>
                @if ($homeowners)
                    @foreach($homeowners as $homeowner)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/public/' . $homeowner->profileImage ) ?? 'storage/public/profile/default.png'}}"> {{ $homeowner->fullname()}}</td>
                        <td>{{ $homeowner->gender}}</td>
                        <td>{{ $homeowner->contactNumber}}</td>
                        <td>{{ $homeowner->created_at}}</td>

                    @endforeach
                @else
                    </tr>
                        <td>No homeowners, registered!</td>
                    </tr>
                @endif

    </div>
</x-admin>