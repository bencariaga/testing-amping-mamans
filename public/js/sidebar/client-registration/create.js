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

	const form = document.getElementById('regForm');
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
		document.querySelector('input[name="full_name"]').value = full;
		if (g) {
			const fg = g.split(' ')[0];
			const mi = m ? ' ' + m.charAt(0) + '.' : '';
			document.querySelector('input[name="display_name"]').value = s + ', ' + fg + mi;
		} else {
			document.querySelector('input[name="display_name"]').value = '';
		}
	}

	['surname','given_name','middle_name'].forEach(function(n) {
		const i = document.querySelector('input[name="'+n+'"]');
		if (i) i.addEventListener('input', updateNames);
	});

	const prov = document.querySelector('select[name="province"]');
	const city = document.querySelector('select[name="city"]');
	const brgy = document.querySelector('select[name="barangay"]');

	function updateCity() {
		city.querySelectorAll('option').forEach(o => o.style.display = '');
		if (prov.value === 'South Cotabato') {
			city.querySelectorAll('.south-cotabato-option').forEach(o => o.style.display = '');
		} else if (prov.value === 'Sarangani') {
			city.querySelectorAll('.sarangani-option').forEach(o => o.style.display = '');
		} else if (prov.value === 'Other') {
			city.querySelector('.other-province-option').style.display = '';
		}
		city.value = '';
		updateBarangay();
	}

	function updateBarangay() {
		brgy.querySelectorAll('option').forEach(o => o.style.display = '');
		if (city.value === 'General Santos') {
			brgy.querySelectorAll('.gensan-option').forEach(o => o.style.display = '');
		} else {
			brgy.querySelector('.other-barangay-option').style.display = '';
		}
		brgy.value = '';
	}

	if (prov && city && brgy) {
		prov.addEventListener('change', updateCity);
		city.addEventListener('change', updateBarangay);
		updateCity();
	}

	const aff = document.querySelector('select[name="phicAffiliation"]');
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

	let ecCount = 1;
	document.getElementById('addEmergencyContactBtn').addEventListener('click', function() {
		const c = document.getElementById('emergency-contact-container');
		const t = c.querySelector('.emergency-contact-template');
		const n = t.cloneNode(true);
		n.querySelector('.emergencyContactCount').textContent = 'Emergency Contact ' + (ecCount + 1);
		n.querySelectorAll('[name^="emergency_contacts[0]"]').forEach(i => {
			i.name = i.name.replace('[0]', '[' + ecCount + ']');
			i.value = '';
		});
		const bi = n.querySelector('input[name="emergency_contacts['+ecCount+'][birthdate]"]');
		const ai = n.querySelector('input[name="emergency_contacts['+ecCount+'][age]"]');
		if (bi && ai) bi.addEventListener('change', function() {
			calculateAge(this, ai);
		});
		c.appendChild(n);
		ecCount++;
	});

	document.getElementById('removeEmergencyContactBtn').addEventListener('click', function() {
		if (ecCount > 1) {
			const c = document.getElementById('emergency-contact-container');
			const list = c.querySelectorAll('.emergency-contact-template');
			c.removeChild(list[list.length - 1]);
			ecCount--;
		}
	});

	let hmCount = 1;
	document.getElementById('addHouseholdMemberBtn').addEventListener('click', function() {
		const c = document.getElementById('household-member-container');
		const t = c.querySelector('.household-member-template');
		const n = t.cloneNode(true);
		n.querySelector('.householdMemberCount').textContent = 'Household Member ' + (hmCount + 1);
		n.querySelectorAll('[name^="household_members[0]"]').forEach(i => {
			i.name = i.name.replace('[0]', '[' + hmCount + ']');
			i.value = '';
		});
		const bi = n.querySelector('input[name="household_members['+hmCount+'][birthdate]"]');
		const ai = n.querySelector('input[name="household_members['+hmCount+'][age]"]');
		if (bi && ai) bi.addEventListener('change', function() {
			calculateAge(this, ai);
		});
		c.appendChild(n);
		hmCount++;
	});

	document.getElementById('removeHouseholdMemberBtn').addEventListener('click', function() {
		if (hmCount > 1) {
			const c = document.getElementById('household-member-container');
			const list = c.querySelectorAll('.household-member-template');
			c.removeChild(list[list.length - 1]);
			hmCount--;
		}
	});
});