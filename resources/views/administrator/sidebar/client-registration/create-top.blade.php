<div class="form-section-card pb-2 mb-4">
    <legend class="form-legend">
        <i class="fas fa-user me-3"></i><span>CLIENT's IDENTIFICATION DATA</span>
    </legend>

    <div class="row gx-3 gy-3 mb-3">
        <div class="col-md-2">
            <label class="form-label">Surname <span class="required-asterisk">*</span></label>
            <input type="text" name="surname" class="form-control" required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Given Name <span class="required-asterisk">*</span></label>
            <input type="text" name="given_name" class="form-control" required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-2">
            <label class="form-label">Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Gender <span class="required-asterisk">*</span></label>
            <select name="gender" class="form-select" required>
                <option value="" selected></option>
                <option>Male</option>
                <option>Female</option>
                <option>Prefer not to say</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-2">
            <label class="form-label">Birthdate <span class="required-asterisk">*</span></label>
            <input type="date" name="birthdate" class="form-control" required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-1">
            <label class="form-label">Age <span class="required-asterisk">*</span></label>
            <input type="number" name="age" class="form-control" readonly required>
            <div class="invalid-feedback">Required</div>
        </div>
    </div>

    <div class="row gx-3 gy-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Full Name <span class="required-asterisk">*</span></label>
            <input type="text" name="full_name" class="form-control" readonly required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Display Name <span class="required-asterisk">*</span></label>
            <input type="text" name="display_name" class="form-control" readonly required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-3">
            <label class="form-label" for="phicAffiliation">PHIC Affiliation <span class="required-asterisk">*</span></label>
            <select name="phicAffiliation" class="form-select" id="phicAffiliation" required>
                <option value="" selected></option>
                <option>Unaffiliated</option>
                <option>Affiliated</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-3">
            <label class="form-label" for="phicCategory">PHIC Category <span class="required-asterisk">*</span></label>
            <select name="phicCategory" class="form-select" id="phicCategory" required>
                <option value="" selected></option>
                <option>Self-Employed</option>
                <option>Sponsored / Indigent</option>
                <option>Employed</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>
    </div>
    <div class="row gx-3 gy-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Phone Number <span class="required-asterisk">*</span></label>
            <input type="number" name="contact_number" class="form-control" required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Birth Certificate (below 8)</label>
            <input type="file" name="birth_certificate" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Barangay Certificate (below 17)</label>
            <input type="file" name="brgy_residency" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Voter’s ID / Certificate (above 17)</label>
            <input type="file" name="voter_certificate" class="form-control">
        </div>
    </div>
    <div class="row gx-3 gy-3 mb-4">
        <div class="col-md-2">
            <label class="form-label">Civil Status <span class="required-asterisk">*</span></label>
            <select name="civil_status" class="form-select" required>
                <option value="" selected></option>
                <option>Single</option>
                <option>Married</option>
                <option>Widowed</option>
                <option>Separated</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-2">
            <label class="form-label">Job Status <span class="required-asterisk">*</span></label>
            <select name="job_status" class="form-select" required>
                <option value="" selected></option>
                <option>Unemployed</option>
                <option>Permanent</option>
                <option>Contractual</option>
                <option>Casual</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-2">
            <label class="form-label">Province <span class="required-asterisk">*</span></label>
            <select name="province" class="form-select" required>
                <option value="" selected></option>
                <option>South Cotabato</option>
                <option>Sarangani</option>
                <option>Other</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-2">
            <label class="form-label">City / Municipality <span class="required-asterisk">*</span></label>
            <select name="city" class="form-select" required>
                <option value="" selected></option>
                <option class="south-cotabato-option">General Santos</option>
                <option class="south-cotabato-option">Polomolok</option>
                <option class="south-cotabato-option">Tupi</option>
                <option class="sarangani-option">Alabel</option>
                <option class="sarangani-option">Glan</option>
                <option class="sarangani-option">Kiamba</option>
                <option class="sarangani-option">Maasim</option>
                <option class="sarangani-option">Maitum</option>
                <option class="sarangani-option">Malapatan</option>
                <option class="sarangani-option">Malungon</option>
                <option class="other-province-option">Other</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-2">
            <label class="form-label">Barangay <span class="required-asterisk">*</span></label>
            <select name="barangay" class="form-select" required>
                <option value="" selected></option>
                <option class="gensan-option">Apopong</option>
                <option class="gensan-option">Baluan</option>
                <option class="gensan-option">Batomelong</option>
                <option class="gensan-option">Buayan</option>
                <option class="gensan-option">Bula</option>
                <option class="gensan-option">Calumpang</option>
                <option class="gensan-option">City Heights</option>
                <option class="gensan-option">Conel</option>
                <option class="gensan-option">Dadiangas East</option>
                <option class="gensan-option">Dadiangas North</option>
                <option class="gensan-option">Dadiangas South</option>
                <option class="gensan-option">Dadiangas West</option>
                <option class="gensan-option">Fatima</option>
                <option class="gensan-option">Katangawan</option>
                <option class="gensan-option">Labangal</option>
                <option class="gensan-option">Lagao</option>
                <option class="gensan-option">Ligaya</option>
                <option class="gensan-option">Mabuhay</option>
                <option class="gensan-option">Olympog</option>
                <option class="gensan-option">San Isidro</option>
                <option class="gensan-option">San Jose</option>
                <option class="gensan-option">Siguel</option>
                <option class="gensan-option">Sinawal</option>
                <option class="gensan-option">Tambler</option>
                <option class="gensan-option">Tinagacan</option>
                <option class="gensan-option">Upper Labay</option>
                <option class="other-barangay-option">Other</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>
        <div class="col-md-2">
            <label class="form-label">Street</label>
            <input type="text" name="street" class="form-control">
        </div>
    </div>

    <div class="row gx-3 gy-3 mb-3">
        <div class="col-md-3">
            <label class="form-label">Occupation <span class="required-asterisk">*</span></label>
            <input type="text" name="occupation" class="form-control" required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Monthly Income <span class="required-asterisk">*</span></label>
            <input type="number" step="0.01" name="monthly_income" class="form-control" required>
            <div class="invalid-feedback">Required</div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Housing Occupancy Status <span class="required-asterisk">*</span></label>
            <select name="housing_status" class="form-select" required>
                <option value="" selected></option>
                <option>Owner</option>
                <option>Renter</option>
                <option>House Sharer</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>
        
        <div class="col-md-3">
            <label class="form-label">Lot Occupancy Status <span class="required-asterisk">*</span></label>
            <select name="lot_status" class="form-select" required>
                <option value="" selected></option>
                <option>Owner</option>
                <option>Renter</option>
                <option>Lot Sharer</option>
                <option>Informal Settler</option>
            </select>
            <div class="invalid-feedback">Required</div>
        </div>
    </div>
</div>