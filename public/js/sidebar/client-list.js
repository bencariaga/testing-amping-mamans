document.addEventListener('DOMContentLoaded', function() {
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
	if (form) {
		form.addEventListener('submit', function(e) {
			if (!form.checkValidity()) {
				e.preventDefault();
				e.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
	}

	const birthMain = document.querySelector('input[name="birthdate"]');
	const ageMain   = document.querySelector('input[name="age"]');
	if (birthMain && ageMain) {
		birthMain.addEventListener('change', function() {
			calculateAge(this, ageMain);
		});
	}

	document.querySelectorAll('input[name^="emergency_contacts"][name$="[birthdate]"]').forEach(function(b) {
		const aName = b.name.replace('[birthdate]', '[age]');
		const a = document.querySelector('input[name="'+aName+'"]');
		if (a) b.addEventListener('change', function() {
			calculateAge(this, a);
		});
	});

	document.querySelectorAll('input[name^="household_members"][name$="[birthdate]"]').forEach(function(b) {
		const aName = b.name.replace('[birthdate]', '[age]');
		const a = document.querySelector('input[name="'+aName+'"]');
		if (a) b.addEventListener('change', function() {
			calculateAge(this, a);
		});
	});

	function updateNames() {
		const s = document.querySelector('input[name="surname"]').value.trim();
		const g = document.querySelector('input[name="given_name"]').value.trim();
		const m = document.querySelector('input[name="middle_name"]').value.trim();
		const full = s + (g ? ', ' + g + (m ? ' ' + m : '') : '');
		const fullInp = document.querySelector('input[name="full_name"]');
		const dispInp = document.querySelector('input[name="display_name"]');
		if (fullInp) fullInp.value = full;
		if (dispInp) {
			if (g) {
				const fg = g.split(' ')[0];
				const mi = m ? ' ' + m.charAt(0) + '.' : '';
				dispInp.value = s + ', ' + fg + mi;
			} else {
				dispInp.value = '';
			}
		}
	}

	['surname','given_name','middle_name'].forEach(function(n) {
		const i = document.querySelector('input[name="'+n+'"]');
		if (i) i.addEventListener('input', updateNames);
	});

	const prov = document.querySelector('input[name="province"], select[name="province"]');
	const city = document.querySelector('input[name="city"], select[name="city"]');
	const brgy = document.querySelector('input[name="barangay"], select[name="barangay"]');

	function updateCity() {
		if (!city || !prov || !brgy) return;
		city.querySelectorAll('option').forEach(o => o.style.display = '');
		if (prov.value === 'South Cotabato') {
			city.querySelectorAll('.south-cotabato-option').forEach(o => o.style.display = '');
		} else if (prov.value === 'Sarangani') {
			city.querySelectorAll('.sarangani-option').forEach(o => o.style.display = '');
		} else if (prov.value === 'Other') {
			city.querySelectorAll('.other-province-option').forEach(o => o.style.display = '');
		}
		city.value = '';
		updateBarangay();
	}

	function updateBarangay() {
		if (!brgy || !city) return;
		brgy.querySelectorAll('option').forEach(o => o.style.display = '');
		if (city.value === 'General Santos') {
			brgy.querySelectorAll('.gensan-option').forEach(o => o.style.display = '');
		} else {
			brgy.querySelectorAll('.other-barangay-option').forEach(o => o.style.display = '');
		}
		brgy.value = '';
	}

	if (prov && city && brgy) {
		prov.addEventListener('change', updateCity);
		city.addEventListener('change', updateBarangay);
		updateCity();
	}

	const aff = document.querySelector('select[name="philhealth"], select[name="phicAffiliation"]');
	const cat = document.querySelector('select[name="phicCategory"]');
	if (aff && cat) {
		function updCat() {
			if (aff.value === 'Unaffiliated') {
				cat.value = '';
				cat.disabled = true;
			} else {
				cat.disabled = false;
			}
		}
		updCat();
		aff.addEventListener('change', updCat);
	}

	let ecCount = document.querySelectorAll('.emergency-contact-template').length;
	document.getElementById('addEmergencyContactBtn').addEventListener('click', function() {
		const container = document.getElementById('emergency-contact-container');
		const template = container.querySelector('.emergency-contact-template');
		const clone = template.cloneNode(true);
		clone.querySelector('.emergencyContactCount').textContent = 'Emergency Contact ' + (ecCount + 1);
		clone.querySelectorAll('[name^="emergency_contacts[0]"]').forEach(function(input) {
			input.name = input.name.replace('[0]', '[' + ecCount + ']');
			input.value = '';
		});
		const birth = clone.querySelector('input[name="emergency_contacts['+ecCount+'][birthdate]"]');
		const age = clone.querySelector('input[name="emergency_contacts['+ecCount+'][age]"]');
		if (birth && age) birth.addEventListener('change', function() { calculateAge(this, age); });
		container.appendChild(clone);
		ecCount++;
	});

	document.getElementById('removeEmergencyContactBtn').addEventListener('click', function() {
		if (ecCount > 1) {
			const container = document.getElementById('emergency-contact-container');
			const list = container.querySelectorAll('.emergency-contact-template');
			container.removeChild(list[list.length - 1]);
			ecCount--;
		}
	});

	let hmCount = document.querySelectorAll('.household-member-template').length;
	document.getElementById('addHouseholdMemberBtn').addEventListener('click', function() {
		const container = document.getElementById('household-member-container');
		const template = container.querySelector('.household-member-template');
		const clone = template.cloneNode(true);
		clone.querySelector('.householdMemberCount').textContent = 'Household Member ' + (hmCount + 1);
		clone.querySelectorAll('[name^="household_members[0]"]').forEach(function(input) {
			input.name = input.name.replace('[0]', '[' + hmCount + ']');
			input.value = '';
		});
		const birth = clone.querySelector('input[name="household_members['+hmCount+'][birthdate]"]');
		const age = clone.querySelector('input[name="household_members['+hmCount+'][age]"]');
		if (birth && age) birth.addEventListener('change', function() { calculateAge(this, age); });
		container.appendChild(clone);
		hmCount++;
	});

	document.getElementById('removeHouseholdMemberBtn').addEventListener('click', function() {
		if (hmCount > 1) {
			const container = document.getElementById('household-member-container');
			const list = container.querySelectorAll('.household-member-template');
			container.removeChild(list[list.length - 1]);
			hmCount--;
		}
	});
});