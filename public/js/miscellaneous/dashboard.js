document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!link.hasAttribute('onclick')) {
                navLinks.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    const seeDetailsBtn = document.querySelector('.btn-see-details');
    if (seeDetailsBtn) {
        seeDetailsBtn.addEventListener('click', function() {
            alert('See Details button clicked! This would navigate to a detailed report.');
        });
    }

    const yearSelect = document.getElementById('yearSelect');
    const monthSelect = document.getElementById('monthSelect');
    const daySelect = document.getElementById('daySelect');

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    function isLeapYear(year) {
        return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
    }

    function getDaysInMonth(year, monthIndex) {
        const daysInMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (monthIndex === 1 && isLeapYear(year)) {
            return 29;
        }
        return daysInMonths[monthIndex];
    }

    function populateMonths() {
        monthSelect.innerHTML = '';
        const today = new Date();
        const currentMonthIndex = today.getMonth();

        let optionsHtml = '';
        for (let i = 0; i < monthNames.length; i++) {
            optionsHtml += `<option value="${i}">${monthNames[i]}</option>`;
        }
        monthSelect.innerHTML = optionsHtml;
        monthSelect.value = currentMonthIndex;
    }

    function populateDays() {
        const selectedYear = parseInt(yearSelect.value);
        const selectedMonthIndex = parseInt(monthSelect.value);
        const daysInSelectedMonth = getDaysInMonth(selectedYear, selectedMonthIndex);
        const currentSelectedDay = parseInt(daySelect.value);

        daySelect.innerHTML = '';
        let optionsHtml = '';
        for (let i = 1; i <= daysInSelectedMonth; i++) {
            optionsHtml += `<option value="${i}">${i}</option>`;
        }
        daySelect.innerHTML = optionsHtml;

        if (currentSelectedDay > daysInSelectedMonth) {
            daySelect.value = daysInSelectedMonth;
        } else {
            daySelect.value = currentSelectedDay || new Date().getDate();
        }
    }

    populateMonths();
    populateDays();

    yearSelect.addEventListener('change', populateDays);
    monthSelect.addEventListener('change', populateDays);
});