@extends('template.personal-page')

@section('title', 'Client Profile')

@push('styles')
    <link href="{{ asset('css/miscellaneous/client-profile.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/miscellaneous/client-profile.js') }}"></script>
@endpush

@section('breadcrumbs')
    <a href="{{ route('client-list') }}" class="text-decoration-none text-reset">Client List</a> &gt;
    <a href="{{ route('client.profile.show', $client->client_id) }}" class="text-decoration-none text-reset">Client Profile</a>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $e)
                        <div>{{ $e }}</div>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-container-top pb-2">
            <div class="profile-grid-container-top">
                <div class="header-grid text-start">ID: {{ $client->client_id }}</div>
                <div class="header-grid text-center">
                    {{ $client->surname }}, {{ $client->given_name }}{{ $client->middle_name ? ' ' . strtoupper(substr($client->middle_name, 0, 1)) . '.' : '' }}
                </div>
                <div class="header-grid text-end">Registered On: {{ \Carbon\Carbon::parse($client->time_registered)->format('m/d/y') }}</div>
            </div>
        </div>

        <form id="profileForm" method="POST" action="{{ route('client.profile.update', $client->client_id) }}">
            @csrf
            @method('PUT')

            <div class="profile-container-middle-top pb-5">
                <div class="row gx-3 gy-3 mb-3">
                    <div class="col-md-2">
                        <label class="form-label">Surname <span class="required-asterisk">*</span></label>
                        <input type="text" name="surname" class="form-control" value="{{ old('surname', $client->surname) }}" required>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Given Name <span class="required-asterisk">*</span></label>
                        <input type="text" name="given_name" class="form-control" value="{{ old('given_name', $client->given_name) }}" required>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $client->middle_name) }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Gender <span class="required-asterisk">*</span></label>
                        <select name="gender" class="form-select" required>
                            <option value="" {{ old('gender', $client->gender)==''?'selected':'' }}></option>
                            <option value="Male" {{ old('gender', $client->gender)=='Male'?'selected':'' }}>Male</option>
                            <option value="Female" {{ old('gender', $client->gender)=='Female'?'selected':'' }}>Female</option>
                            <option value="Prefer not to say" {{ old('gender', $client->gender)=='Prefer not to say'?'selected':'' }}>Prefer not to say</option>
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Birthdate <span class="required-asterisk">*</span></label>
                        <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate', $client->birthdate) }}" required>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Age <span class="required-asterisk">*</span></label>
                        <input type="number" name="age" class="form-control" value="{{ old('age', $client->age) }}" readonly required>
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>

                <div class="row gx-3 gy-3 mb-3">
                    <div class="col-md-2">
                        <label class="form-label">Civil Status <span class="required-asterisk">*</span></label>
                        <select name="civil_status" class="form-select" required>
                            <option value="" {{ old('civil_status', $client->civil_status)==''?'selected':'' }}></option>
                            <option value="Single" {{ old('civil_status', $client->civil_status)=='Single'?'selected':'' }}>Single</option>
                            <option value="Married" {{ old('civil_status', $client->civil_status)=='Married'?'selected':'' }}>Married</option>
                            <option value="Widowed" {{ old('civil_status', $client->civil_status)=='Widowed'?'selected':'' }}>Widowed</option>
                            <option value="Separated" {{ old('civil_status', $client->civil_status)=='Separated'?'selected':'' }}>Separated</option>
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Job Status <span class="required-asterisk">*</span></label>
                        <select name="job_status" class="form-select" required>
                            <option value="" {{ old('job_status', $client->job_status)==''?'selected':'' }}></option>
                            <option value="Unemployed" {{ old('job_status', $client->job_status)=='Unemployed'?'selected':'' }}>Unemployed</option>
                            <option value="Permanent" {{ old('job_status', $client->job_status)=='Permanent'?'selected':'' }}>Permanent</option>
                            <option value="Contractual" {{ old('job_status', $client->job_status)=='Contractual'?'selected':'' }}>Contractual</option>
                            <option value="Casual" {{ old('job_status', $client->job_status)=='Casual'?'selected':'' }}>Casual</option>
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Province <span class="required-asterisk">*</span></label>
                        <select id="province" name="province" class="form-select" required>
                            <option value="" {{ old('province', $client->province)==''?'selected':'' }}></option>
                            <option value="South Cotabato" {{ old('province', $client->province)=='South Cotabato'?'selected':'' }}>South Cotabato</option>
                            <option value="Sarangani" {{ old('province', $client->province)=='Sarangani'?'selected':'' }}>Sarangani</option>
                            <option value="Other" {{ old('province', $client->province)=='Other'?'selected':'' }}>Other</option>
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">City <span class="required-asterisk">*</span></label>
                        <select id="city" name="city" class="form-select" required>
                            <option value="" {{ old('city', $client->city)==''?'selected':'' }}></option> 
                            <option class="south-cotabato-option" value="General Santos" {{ old('city', $client->city)=='General Santos'?'selected':'' }}>General Santos</option>
                            <option class="south-cotabato-option" value="Polomolok" {{ old('city', $client->city)=='Polomolok'?'selected':'' }}>Polomolok</option>
                            <option class="south-cotabato-option" value="Tupi" {{ old('city', $client->city)=='Tupi'?'selected':'' }}>Tupi</option>
                            <option class="sarangani-option" value="Alabel" {{ old('city', $client->city)=='Alabel'?'selected':'' }}>Alabel</option> 
                            <option class="sarangani-option" value="Glan" {{ old('city', $client->city)=='Glan'?'selected':'' }}>Glan</option>
                            <option class="sarangani-option" value="Kiamba" {{ old('city', $client->city)=='Kiamba'?'selected':'' }}>Kiamba</option>
                            <option class="sarangani-option" value="Maasim" {{ old('city', $client->city)=='Maasim'?'selected':'' }}>Maasim</option>
                            <option class="sarangani-option" value="Maitum" {{ old('city', $client->city)=='Maitum'?'selected':'' }}>Maitum</option>
                            <option class="sarangani-option" value="Malapatan" {{ old('city', $client->city)=='Malapatan'?'selected':'' }}>Malapatan</option> 
                            <option class="sarangani-option" value="Malungon" {{ old('city', $client->city)=='Malungon'?'selected':'' }}>Malungon</option>
                            <option class="other-province-option" value="Other" {{ old('city', $client->city)=='Other'?'selected':'' }}>Other</option>
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Barangay <span class="required-asterisk">*</span></label>
                        <select id="barangay" name="barangay" class="form-select" required>
                            <option value="" {{ old('barangay', $client->barangay)==''?'selected':'' }}></option>
                            @php
                                $barangays = [
                                    'Apopong', 'Baluan', 'Batomelong', 'Buayan', 'Bula', 'Calumpang',
                                    'City Heights', 'Conel', 'Dadiangas East', 'Dadiangas North', 'Dadiangas South',
                                    'Dadiangas West', 'Fatima', 'Katangawan', 'Labangal', 'Lagao', 'Ligaya', 'Mabuhay',
                                    'Olympog', 'San Isidro', 'San Jose', 'Siguel', 'Sinawal', 'Tambler', 'Tinagacan',
                                    'Upper Labay'
                                ];
                            @endphp
                            @foreach($barangays as $brgy)
                                <option class="gensan-option" value="{{ $brgy }}" {{ old('barangay', $client->barangay)==$brgy?'selected':'' }}>{{ $brgy }}</option>
                            @endforeach
                            <option class="other-barangay-option" value="Other" {{ old('barangay', $client->barangay)=='Other'?'selected':'' }}>Other</option>
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Street</label>
                        <input type="text" name="street" class="form-control" value="{{ old('street', $client->street) }}">
                    </div>
                </div>

                <div class="row gx-3 gy-3 mb-3">
                    <div class="col-md-2">
                        <label class="form-label">Phone Number <span class="required-asterisk">*</span></label>
                        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $client->phone_number) }}" required>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Occupation <span class="required-asterisk">*</span></label>
                        <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $client->occupation) }}" required>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Monthly Income <span class="required-asterisk">*</span></label>
                        <input type="number" step="0.01" name="monthly_income" class="form-control" value="{{ old('monthly_income', $client->monthly_income) }}" required>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Housing Status <span class="required-asterisk">*</span></label>
                        <select name="house_status" class="form-select" required>
                            @foreach(['Owner','Renter','House Sharer'] as $status)
                                <option value="{{ $status }}" {{ old('house_status', $client->house_status)==$status?'selected':'' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Lot Status <span class="required-asterisk">*</span></label>
                        <select name="lot_status" class="form-select" required>
                            <option value="" {{ old('lot_status', $client->lot_status)==''?'selected':'' }}></option>
                            <option value="Owner" {{ old('lot_status', $client->lot_status)=='Owner'?'selected':'' }}>Owner</option>
                            <option value="Renter" {{ old('lot_status', $client->lot_status)=='Renter'?'selected':'' }}>Renter</option>
                            <option value="Lot Sharer" {{ old('lot_status', $client->lot_status)=='Lot Sharer'?'selected':'' }}>Lot Sharer</option>
                            <option value="Informal Settler" {{ old('lot_status', $client->lot_status)=='Informal Settler'?'selected':'' }}>Informal Settler</option>
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" id="viewBtn" class="btn btn-primary w-100">View Images</button>
                    </div>
                </div>

                <div class="row gx-3 gy-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label" for="philhealth">PHIC Affiliation <span class="required-asterisk">*</span></label>
                        <select id="philhealth" name="philhealth_affiliation" class="form-select" required>
                            @foreach(['Unaffiliated','Affiliated'] as $aff)
                                <option value="{{ $aff }}"
                                    {{ old('philhealth_affiliation', $client->philhealth_affiliation)==$aff ? 'selected' : '' }}>
                                    {{ $aff }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Required</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="philhealth_category">PHIC Category <span class="required-asterisk">*</span></label>
                        <select id="philhealth_category" name="philhealth_category" class="form-select">
                            <option value="" {{ old('philhealth_category', $client->philhealth_category)==''?'selected':'' }}></option>
                            <option value="Self-Employed" {{ old('philhealth_category', $client->philhealth_category)=='Self-Employed'?'selected':'' }}>Self-Employed</option>
                            <option value="Sponsored / Indigent" {{ old('philhealth_category', $client->philhealth_category)=='Sponsored / Indigent'?'selected':'' }}>Sponsored / Indigent</option>
                            <option value="Employed" {{ old('philhealth_category', $client->philhealth_category)=='Employed'?'selected':'' }}>Employed</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" id="updateClientBtn" class="btn btn-primary w-100">Update Profile</button>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" id="deleteClientBtn" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteClientModal">Delete Profile</button>
                    </div>
                </div>
            </div>

            <div class="profile-container-middle-bottom">
                <div class="form-section-card pb-2">
                    <legend class="form-legend"><i class="fas fa-exclamation-circle me-3"></i><span class="fw-bold">CLIENT's EMERGENCY CONTACT/S</span></legend>
                    <div id="emergency-contact-container">
                        @foreach($client->emergencyContacts as $i => $ec)
                            <div class="emergency-contact-template">
                                <div class="row gx-3 gy-3 mb-3">
                                    <h5 class="fw-bold emergencyContactCount">Emergency Contact {{ $i+1 }}</h5>
                                    <input type="hidden" name="emergency_contacts[{{ $i }}][id]" value="{{ $ec->id }}">
                                    <div class="col-md-2">
                                        <label class="form-label">Surname <span class="required-asterisk">*</span></label>
                                        <input type="text" name="emergency_contacts[{{ $i }}][surname]" class="form-control" value="{{ old("emergency_contacts.{$i}.surname",$ec->surname) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Given Name <span class="required-asterisk">*</span></label>
                                        <input type="text" name="emergency_contacts[{{ $i }}][given_name]" class="form-control" value="{{ old("emergency_contacts.{$i}.given_name",$ec->given_name) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="emergency_contacts[{{ $i }}][middle_name]" class="form-control" value="{{ old("emergency_contacts.{$i}.middle_name",$ec->middle_name) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Gender <span class="required-asterisk">*</span></label>
                                        <select name="emergency_contacts[{{ $i }}][gender]" class="form-select" required>
                                            <option value=""></option>
                                            <option value="Male" {{ old("emergency_contacts.{$i}.gender",$ec->gender)=='Male'?'selected':'' }}>Male</option>
                                            <option value="Female" {{ old("emergency_contacts.{$i}.gender",$ec->gender)=='Female'?'selected':'' }}>Female</option>
                                            <option value="Prefer not to say" {{ old("emergency_contacts.{$i}.gender",$ec->gender)=='Prefer not to say'?'selected':'' }}>Prefer not to say</option>
                                        </select>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Birthdate <span class="required-asterisk">*</span></label>
                                        <input type="date" name="emergency_contacts[{{ $i }}][birthdate]" class="form-control" value="{{ old("emergency_contacts.{$i}.birthdate",$ec->birthdate) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Age <span class="required-asterisk">*</span></label>
                                        <input type="number" name="emergency_contacts[{{ $i }}][age]" class="form-control" value="{{ old("emergency_contacts.{$i}.age",$ec->age) }}" readonly required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                </div>
                                <div class="row gx-3 gy-3 mb-4">
                                    <div class="col-md-3">
                                        <label class="form-label">Phone Number <span class="required-asterisk">*</span></label>
                                        <input type="text" name="emergency_contacts[{{ $i }}][contact_number]" class="form-control" value="{{ old("emergency_contacts.{$i}.contact_number",$ec->contact_number) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Relationship <span class="required-asterisk">*</span></label>
                                        <select name="emergency_contacts[{{ $i }}][relationship_to_client]" class="form-select" required>
                                            <option value=""></option>
                                            <option value="Friend" {{ old("emergency_contacts.{$i}.relationship_to_client",$ec->relationship)=='Friend'?'selected':'' }}>Friend</option>
                                            <option value="Child" {{ old("emergency_contacts.{$i}.relationship_to_client",$ec->relationship)=='Child'?'selected':'' }}>Child</option>
                                            <option value="Sibling" {{ old("emergency_contacts.{$i}.relationship_to_client",$ec->relationship)=='Sibling'?'selected':'' }}>Sibling</option>
                                            <option value="Parent" {{ old("emergency_contacts.{$i}.relationship_to_client",$ec->relationship)=='Parent'?'selected':'' }}>Parent</option>
                                            <option value="Grandparent" {{ old("emergency_contacts.{$i}.relationship_to_client",$ec->relationship)=='Grandparent'?'selected':'' }}>Grandparent</option>
                                            <option value="Other Relative" {{ old("emergency_contacts.{$i}.relationship_to_client",$ec->relationship)=='Other Relative'?'selected':'' }}>Other Relative</option>
                                        </select>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Monthly Income <span class="required-asterisk">*</span></label>
                                        <input type="number" step="0.01" name="emergency_contacts[{{ $i }}][monthly_income]" class="form-control" value="{{ old("emergency_contacts.{$i}.monthly_income",$ec->monthly_income) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Education <span class="required-asterisk">*</span></label>
                                        <select name="emergency_contacts[{{ $i }}][educational_attainment]" class="form-select" required>
                                            <option value=""></option>
                                            <option value="College" {{ old("emergency_contacts.{$i}.educational_attainment",$ec->education)=='College'?'selected':'' }}>College</option>
                                            <option value="High School" {{ old("emergency_contacts.{$i}.educational_attainment",$ec->education)=='High School'?'selected':'' }}>High School</option>
                                            <option value="Elementary" {{ old("emergency_contacts.{$i}.educational_attainment",$ec->education)=='Elementary'?'selected':'' }}>Elementary</option>
                                        </select>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row gx-3 gy-3 mb-4">
                        <div class="col-md-3"><button type="button" id="addEmergencyContactBtn" class="btn btn-primary fw-bold">ADD CONTACT</button></div>
                        <div class="col-md-3"><button type="button" id="removeEmergencyContactBtn" class="btn btn-primary fw-bold">REMOVE CONTACT</button></div>
                    </div>
                </div>
            </div>

            <div class="profile-container-bottom">
                <div class="form-section-card pb-2">
                    <legend class="form-legend"><i class="fas fa-home me-3"></i><span class="fw-bold">CLIENT's HOUSEHOLD MEMBER/S</span></legend>
                    <div id="household-member-container">
                        @foreach($client->householdMembers as $i => $hm)
                            <div class="household-member-template">
                                <div class="row gx-3 gy-3 mb-3">
                                    <h5 class="fw-bold householdMemberCount">Household Member {{ $i+1 }}</h5>
                                    <input type="hidden" name="household_members[{{ $i }}][id]" value="{{ $hm->id }}">
                                    <div class="col-md-2">
                                        <label class="form-label">Surname <span class="required-asterisk">*</span></label>
                                        <input type="text" name="household_members[{{ $i }}][surname]" class="form-control" value="{{ old("household_members.{$i}.surname",$hm->surname) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Given Name <span class="required-asterisk">*</span></label>
                                        <input type="text" name="household_members[{{ $i }}][given_name]" class="form-control" value="{{ old("household_members.{$i}.given_name",$hm->given_name) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="household_members[{{ $i }}][middle_name]" class="form-control" value="{{ old("household_members.{$i}.middle_name",$hm->middle_name) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Gender <span class="required-asterisk">*</span></label>
                                        <select name="household_members[{{ $i }}][gender]" class="form-select" required>
                                            <option value=""></option>
                                            <option value="Male" {{ old("household_members.{$i}.gender",$hm->gender)=='Male'?'selected':'' }}>Male</option>
                                            <option value="Female" {{ old("household_members.{$i}.gender",$hm->gender)=='Female'?'selected':'' }}>Female</option>
                                            <option value="Prefer not to say" {{ old("household_members.{$i}.gender",$hm->gender)=='Prefer not to say'?'selected':'' }}>Prefer not to say</option>
                                        </select>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Birthdate <span class="required-asterisk">*</span></label>
                                        <input type="date" name="household_members[{{ $i }}][birthdate]" class="form-control" value="{{ old("household_members.{$i}.birthdate",$hm->birthdate) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Age <span class="required-asterisk">*</span></label>
                                        <input type="number" name="household_members[{{ $i }}][age]" class="form-control" value="{{ old("household_members.{$i}.age",$hm->age) }}" readonly required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                </div>
                                <div class="row gx-3 gy-3 mb-4">
                                    <div class="col-md-3">
                                        <label class="form-label">Phone Number <span class="required-asterisk">*</span></label>
                                        <input type="text" name="household_members[{{ $i }}][contact_number]" class="form-control" value="{{ old("household_members.{$i}.contact_number",$hm->contact_number) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Relationship to Client <span class="required-asterisk">*</span></label>
                                        <select name="household_members[{{ $i }}][relationship_to_client]" class="form-select" required>
                                            <option value=""></option>
                                            <option value="Friend" {{ old("household_members.{$i}.relationship_to_client",$hm->relationship)=='Friend'?'selected':'' }}>Friend</option>
                                            <option value="Child" {{ old("household_members.{$i}.relationship_to_client",$hm->relationship)=='Child'?'selected':'' }}>Child</option>
                                            <option value="Sibling" {{ old("household_members.{$i}.relationship_to_client",$hm->relationship)=='Sibling'?'selected':'' }}>Sibling</option>
                                            <option value="Parent" {{ old("household_members.{$i}.relationship_to_client",$hm->relationship)=='Parent'?'selected':'' }}>Parent</option>
                                            <option value="Grandparent" {{ old("household_members.{$i}.relationship_to_client",$hm->relationship)=='Grandparent'?'selected':'' }}>Grandparent</option>
                                            <option value="Other Relative" {{ old("household_members.{$i}.relationship_to_client",$hm->relationship)=='Other Relative'?'selected':'' }}>Other Relative</option>
                                        </select>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Monthly Income <span class="required-asterisk">*</span></label>
                                        <input type="number" step="0.01" name="household_members[{{ $i }}][monthly_income]" class="form-control" value="{{ old("household_members.{$i}.monthly_income",$hm->monthly_income) }}" required>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Education <span class="required-asterisk">*</span></label>
                                        <select name="household_members[{{ $i }}][educational_attainment]" class="form-select" required>
                                            <option value=""></option>
                                            <option value="College" {{ old("household_members.{$i}.educational_attainment",$hm->education)=='College'?'selected':'' }}>College</option>
                                            <option value="High School" {{ old("household_members.{$i}.educational_attainment",$hm->education)=='High School'?'selected':'' }}>High School</option>
                                            <option value="Elementary" {{ old("household_members.{$i}.educational_attainment",$hm->education)=='Elementary'?'selected':'' }}>Elementary</option>
                                        </select>
                                        <div class="invalid-feedback">Required</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row gx-3 gy-3 mb-4">
                        <div class="col-md-3"><button type="button" id="addHouseholdMemberBtn" class="btn btn-primary fw-bold">ADD MEMBER</button></div>
                        <div class="col-md-3"><button type="button" id="removeHouseholdMemberBtn" class="btn btn-primary fw-bold">REMOVE MEMBER</button></div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="deleteClientModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('client.profile.destroy', $client->client_id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Client Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this client, {{ $client->surname }}, {{ $client->given_name }}{{ $client->middle_name ? ' ' . strtoupper(substr($client->middle_name, 0, 1)) . '.' : '' }}? This action cannot be undone.</p>
                            <div class="mb-3">
                                <label class="form-label">Enter your password to confirm.</label>
                                <input type="password" name="password_confirmation_delete" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection