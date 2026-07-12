<link rel="stylesheet" href="{{ asset('resources/css/admin/billing/create.css')}}?v={{ filemtime(resource_path('css/admin/billing/create.css')) }}">
<x-admin>
    <x-view-header title="Create Billing">
    </x-view-header>
    <div class="form-container">
        <form action="{{route('admin.billing.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
            <h1 class="form-header">CREATE NEW BILLING</h1>
            <br>
            <hr />
            <br>
            <div class="form-group-grid">
                <div class="form-group">
                    <label for="homeowner"><p>Homeowner</p></label>
                    <select class="select" name="homeowner" id="homeowner">
                        <option value="" {{ old('homeowner') === null ? 'selected' : '' }} disabled>Select Homeowner</option>
                        @forelse ($lot as $lotItem)
                            <option value="{{ $lotItem->homeownerID }}" {{ old('homeowner') == $lotItem->homeownerID ? 'selected' : '' }}>
                                {{ $lotItem->homeowner->fullname() }} [B{{$lotItem->blockNumber}} L{{$lotItem->lotNumber}}]
                            </option>
                        @empty
                            <option value="" disabled>No blocks found</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="date"><p>Due</p></label>
                    <input class="input" type="date" name="date" id="date" value="{{ old('date') }}">
                </div>
            </div>

            <br>

            <div class="form-group-check">
                <h1>FEE ITEMS:</h1>
                
                <label>
                    <input type="checkbox" name="monthly" value="1" {{ old('monthly') ? 'checked' : '' }}>
                    <span>Monthly Due</span>
                </label>

                <label>
                    <input type="checkbox" name="security" value="1" {{ old('security') ? 'checked' : '' }}>
                    <span>Security Fee</span>
                </label>

                <label>
                    <input type="checkbox" name="penalty" value="1" {{ old('penalty') ? 'checked' : '' }}>
                    <span>Penalty Fee</span>
                </label>

                <label>
                    <input type="checkbox" name="water" value="1" {{ old('water') ? 'checked' : '' }}>
                    <span>Water Bill</span>
                </label>

                <label>
                    <input type="checkbox" name="maintenance" value="1" {{ old('maintenance') ? 'checked' : '' }}>
                    <span>Maintenance Fee(s)</span>
                </label>
            </div>
            <br>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
        </form>
    </div>
</x-admin>