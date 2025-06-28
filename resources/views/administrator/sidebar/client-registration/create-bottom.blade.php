<div class="form-section-card pb-2 mb-4">
    <legend class="form-legend">
        <i class="fas fa-exclamation-circle me-3"></i><span>CLIENT's EMERGENCY CONTACT/S</span>
    </legend>

    <div id="emergency-contact-container">
        <div class="emergency-contact-template">
            <div class="row gx-3 gy-3 mb-3">
                <h5 class="fw-bold emergencyContactCount">Emergency Contact 1</h5>

                <div class="col-md-2">
                    <label class="form-label">Surname <span class="required-asterisk">*</span></label>
                    <input type="text" name="emergency_contacts[0][surname]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Given Name <span class="required-asterisk">*</span></label>
                    <input type="text" name="emergency_contacts[0][given_name]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="emergency_contacts[0][middle_name]" class="form-control">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Gender <span class="required-asterisk">*</span></label>
                    <select name="emergency_contacts[0][gender]" class="form-select" required>
                        <option value="" selected></option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Prefer not to say</option>
                    </select>
                    <div class="invalid-feedback">Required</div>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">Birthdate <span class="required-asterisk">*</span></label>
                    <input type="date" name="emergency_contacts[0][birthdate]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-1">
                    <label class="form-label">Age <span class="required-asterisk">*</span></label>
                    <input type="number" name="emergency_contacts[0][age]" class="form-control" readonly required>
                    <div class="invalid-feedback">Required</div>
                </div>
            </div>
            <div class="row gx-3 gy-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label">Phone Number <span class="required-asterisk">*</span></label>
                    <input type="number" name="emergency_contacts[0][contact_number]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Relationship to Client <span class="required-asterisk">*</span></label>
                    <select name="emergency_contacts[0][relationship_to_client]" class="form-select" required>
                        <option value="" selected></option>
                        <option>Friend</option>
                        <option>Child</option>
                        <option>Sibling</option>
                        <option>Parent</option>
                        <option>Grandparent</option>
                        <option>Other Relative</option>
                    </select>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Monthly Income <span class="required-asterisk">*</span></label>
                    <input type="number" step="0.01" name="emergency_contacts[0][monthly_income]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Educational Attainment <span class="required-asterisk">*</span></label>
                    <select name="emergency_contacts[0][educational_attainment]" class="form-select" required>
                        <option value="" selected></option>
                        <option>College</option>
                        <option>High School</option>
                        <option>Elementary</option>
                    </select>
                    <div class="invalid-feedback">Required</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3 gy-3 mb-4">
        <div class="col-md-3">
            <button type="button" id="addEmergencyContactBtn" class="btn btn-primary change-password-btn fw-bold">
                ADD CONTACT
            </button>
        </div>

        <div class="col-md-3">
            <button type="button" id="removeEmergencyContactBtn" class="btn btn-primary change-password-btn fw-bold">
                REMOVE CONTACT
            </button>
        </div>
    </div>
</div>

<div class="form-section-card pb-2">
    <legend class="form-legend">
        <i class="fas fa-home me-3"></i><span>CLIENT's HOUSEHOLD MEMBER/S</span>
    </legend>
    <div id="household-member-container">
        <div class="household-member-template">
            <div class="row gx-3 gy-3 mb-3">
                <h5 class="fw-bold householdMemberCount">Household Member 1</h5>

                <div class="col-md-2">
                    <label class="form-label">Surname <span class="required-asterisk">*</span></label>
                    <input type="text" name="household_members[0][surname]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Given Name <span class="required-asterisk">*</span></label>
                    <input type="text" name="household_members[0][given_name]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="household_members[0][middle_name]" class="form-control">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Gender <span class="required-asterisk">*</span></label>
                    <select name="household_members[0][gender]" class="form-select" required>
                        <option value="" selected></option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Prefer not to say</option>
                    </select>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Birthdate <span class="required-asterisk">*</span></label>
                    <input type="date" name="household_members[0][birthdate]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-1">
                    <label class="form-label">Age <span class="required-asterisk">*</span></label>
                    <input type="number" name="household_members[0][age]" class="form-control" readonly required>
                    <div class="invalid-feedback">Required</div>
                </div>
            </div>
            <div class="row gx-3 gy-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label">Phone Number <span class="required-asterisk">*</span></label>
                    <input type="number" name="household_members[0][contact_number]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Relationship to Client <span class="required-asterisk">*</span></label>
                    <select name="household_members[0][relationship_to_client]" class="form-select" required>
                        <option value="" selected></option>
                        <option>Friend</option>
                        <option>Child</option>
                        <option>Sibling</option>
                        <option>Parent</option>
                        <option>Grandparent</option>
                        <option>Other Relative</option>
                    </select>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Monthly Income <span class="required-asterisk">*</span></label>
                    <input type="number" step="0.01" name="household_members[0][monthly_income]" class="form-control" required>
                    <div class="invalid-feedback">Required</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Educational Attainment <span class="required-asterisk">*</span></label>
                    <select name="household_members[0][educational_attainment]" class="form-select" required>
                        <option value="" selected></option>
                        <option>College</option>
                        <option>High School</option>
                        <option>Elementary</option>
                    </select>
                    <div class="invalid-feedback">Required</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3 gy-3 mb-4">
        <div class="col-md-3">
            <button type="button" id="addHouseholdMemberBtn" class="btn btn-primary change-password-btn fw-bold">
                ADD MEMBER
            </button>
        </div>
        
        <div class="col-md-3">
            <button type="button" id="removeHouseholdMemberBtn" class="btn btn-primary change-password-btn fw-bold">
                REMOVE MEMBER
            </button>
        </div>
    </div>
</div>