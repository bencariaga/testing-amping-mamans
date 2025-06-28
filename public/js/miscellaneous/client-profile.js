document.addEventListener('DOMContentLoaded', function () {
    function calculateAge(birthField, ageField) {
        if (birthField.value) {
            const b = new Date(birthField.value);
            const t = new Date();
            let age = t.getFullYear() - b.getFullYear();
            const m = t.getMonth() - b.getMonth();
            if (m < 0 || (m === 0 && t.getDate() < b.getDate())) age--;
            ageField.value = age;
        } else {
            ageField.value = '';
        }
    }

    const form = document.getElementById('profileForm');
    const birthInput = form.querySelector('input[name="birthdate"]');
    const ageInput = form.querySelector('input[name="age"]');
    calculateAge(birthInput, ageInput);
    birthInput.addEventListener('change', function () {
        calculateAge(birthInput, ageInput);
    });

    document.querySelectorAll('input[name^="emergency_contacts"][name$="[birthdate]"]').forEach(function (b) {
        const index = b.name.match(/\[(\d+)\]/)[1];
        const a = document.querySelector(`input[name="emergency_contacts[${index}][age]"]`);
        if (a) {
            calculateAge(b, a);
            b.addEventListener('change', function () {
                calculateAge(b, a);
            });
        }
    });

    document.querySelectorAll('input[name^="household_members"][name$="[birthdate]"]').forEach(function (b) {
        const index = b.name.match(/\[(\d+)\]/)[1];
        const a = document.querySelector(`input[name="household_members[${index}][age]"]`);
        if (a) {
            calculateAge(b, a);
            b.addEventListener('change', function () {
                calculateAge(b, a);
            });
        }
    });

    const prov = form.querySelector('select[name="province"]');
    const city = form.querySelector('select[name="city"]');
    const brgy = form.querySelector('select[name="barangay"]');

    function updateCity(initialLoad = false) {
        city.querySelectorAll('option').forEach(o => o.style.display = 'none');
        city.querySelector('option[value=""]').style.display = '';
        if (prov.value === 'South Cotabato') {
            city.querySelectorAll('.south-cotabato-option').forEach(o => o.style.display = '');
        } else if (prov.value === 'Sarangani') {
            city.querySelectorAll('.sarangani-option').forEach(o => o.style.display = '');
        } else if (prov.value === 'Other') {
            city.querySelector('.other-province-option').style.display = '';
        }
        if (!initialLoad) city.value = '';
        updateBarangay(initialLoad);
    }

    function updateBarangay(initialLoad = false) {
        brgy.querySelectorAll('option').forEach(o => o.style.display = 'none');
        brgy.querySelector('option[value=""]').style.display = '';
        if (city.value === 'General Santos') {
            brgy.querySelectorAll('.gensan-option').forEach(o => o.style.display = '');
        } else if (city.value) {
            brgy.querySelector('.other-barangay-option').style.display = '';
        }
        if (!initialLoad) brgy.value = '';
    }

    if (prov && city && brgy) {
        prov.addEventListener('change', function () { updateCity(false); });
        city.addEventListener('change', function () { updateBarangay(false); });
        updateCity(true);
        updateBarangay(true);
    }

    const philhealthAffiliation = form.querySelector('select[name="philhealth_affiliation"]');
    const philhealthCategory = form.querySelector('select[name="philhealth_category"]');

    function updatePhilhealthCategory() {
        if (philhealthAffiliation.value === 'Unaffiliated') {
            philhealthCategory.value = '';
            philhealthCategory.disabled = true;
            philhealthCategory.removeAttribute('required');
        } else {
            philhealthCategory.disabled = false;
            philhealthCategory.setAttribute('required', 'required');
        }
    }

    if (philhealthAffiliation && philhealthCategory) {
        updatePhilhealthCategory();
        philhealthAffiliation.addEventListener('change', updatePhilhealthCategory);
    }

    let ecCount = document.querySelectorAll('.emergency-contact-template').length;
    document.getElementById('addEmergencyContactBtn')?.addEventListener('click', function () {
        const container = document.getElementById('emergency-contact-container');
        const template = document.querySelector('.emergency-contact-template');
        const newContact = template.cloneNode(true);
        newContact.querySelector('.emergencyContactCount').textContent = 'Emergency Contact ' + (ecCount + 1);
        newContact.querySelectorAll('input, select').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${ecCount}]`);
            input.value = '';
            input.classList.remove('is-invalid', 'is-valid');
        });
        newContact.querySelector(`input[name="emergency_contacts[${ecCount}][id]"]`).value = '';
        const newBirth = newContact.querySelector(`input[name="emergency_contacts[${ecCount}][birthdate]"]`);
        const newAge = newContact.querySelector(`input[name="emergency_contacts[${ecCount}][age]"]`);
        if (newBirth && newAge) {
            newBirth.addEventListener('change', function () {
                calculateAge(this, newAge);
            });
        }
        container.appendChild(newContact);
        ecCount++;
    });

    document.getElementById('removeEmergencyContactBtn')?.addEventListener('click', function () {
        const container = document.getElementById('emergency-contact-container');
        const contacts = container.querySelectorAll('.emergency-contact-template');
        if (contacts.length > 0) {
            container.removeChild(contacts[contacts.length - 1]);
            ecCount--;
        }
    });

    let hmCount = document.querySelectorAll('.household-member-template').length;
    document.getElementById('addHouseholdMemberBtn')?.addEventListener('click', function () {
        const container = document.getElementById('household-member-container');
        const template = document.querySelector('.household-member-template');
        const newMember = template.cloneNode(true);
        newMember.querySelector('.householdMemberCount').textContent = 'Household Member ' + (hmCount + 1);
        newMember.querySelectorAll('input, select').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${hmCount}]`);
            input.value = '';
            input.classList.remove('is-invalid', 'is-valid');
        });
        newMember.querySelector(`input[name="household_members[${hmCount}][id]"]`).value = '';
        const nbirth = newMember.querySelector(`input[name="household_members[${hmCount}][birthdate]"]`);
        const nage = newMember.querySelector(`input[name="household_members[${hmCount}][age]"]`);
        if (nbirth && nage) {
            nbirth.addEventListener('change', function () {
                calculateAge(this, nage);
            });
        }
        container.appendChild(newMember);
        hmCount++;
    });

    document.getElementById('removeHouseholdMemberBtn')?.addEventListener('click', function () {
        const container = document.getElementById('household-member-container');
        const members = container.querySelectorAll('.household-member-template');
        if (members.length > 0) {
            container.removeChild(members[members.length - 1]);
            hmCount--;
        }
    });

    const deleteClientModal = document.getElementById('deleteClientModal');
    if (deleteClientModal) {
        deleteClientModal.querySelector('form').addEventListener('submit', function (e) {
            const pwInput = this.querySelector('input[name="password_confirmation_delete"]');
            if (!pwInput.value) {
                e.preventDefault();
                pwInput.classList.add('is-invalid');
                pwInput.setCustomValidity('Password is required to delete.');
            } else {
                pwInput.classList.remove('is-invalid');
                pwInput.setCustomValidity('');
            }
        });
        deleteClientModal.addEventListener('hidden.bs.modal', function () {
            const pwInput = this.querySelector('input[name="password_confirmation_delete"]');
            if (pwInput) {
                pwInput.value = '';
                pwInput.classList.remove('is-invalid');
                pwInput.setCustomValidity('');
            }
        });
    }
});