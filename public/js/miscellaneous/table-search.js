document.addEventListener('DOMContentLoaded', function() {
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

    function populateDateSelects(yearSelectId, monthSelectId, daySelectId) {
        const yearSelect = document.getElementById(yearSelectId);
        const monthSelect = document.getElementById(monthSelectId);
        const daySelect = document.getElementById(daySelectId);

        if(!yearSelect || !monthSelect || !daySelect) return;

        const currentYear = new Date().getFullYear();
        const currentMonthIndex = new Date().getMonth();
        const currentDay = new Date().getDate();

        let yearOptionsHtml = '';
        for (let i = currentYear - 5; i <= currentYear + 5; i++) {
            yearOptionsHtml += `<option value="${i}">${i}</option>`;
        }
        yearSelect.innerHTML = yearOptionsHtml;
        yearSelect.value = currentYear;

        let monthOptionsHtml = '';
        for (let i = 0; i < monthNames.length; i++) {
            monthOptionsHtml += `<option value="${i}">${monthNames[i]}</option>`;
        }
        monthSelect.innerHTML = monthOptionsHtml;
        monthSelect.value = currentMonthIndex;

        function updateDays() {
            const selectedYear = parseInt(yearSelect.value);
            const selectedMonthIndex = parseInt(monthSelect.value);
            const daysInSelectedMonth = getDaysInMonth(selectedYear, selectedMonthIndex);
            const currentSelectedDay = parseInt(daySelect.value);

            let dayOptionsHtml = '';
            for (let i = 1; i <= daysInSelectedMonth; i++) {
                dayOptionsHtml += `<option value="${i}">${i}</option>`;
            }
            daySelect.innerHTML = dayOptionsHtml;

            if (currentSelectedDay > daysInSelectedMonth) {
                daySelect.value = daysInSelectedMonth;
            } else {
                daySelect.value = currentSelectedDay || currentDay;
            }
        }

        yearSelect.addEventListener('change', updateDays);
        monthSelect.addEventListener('change', updateDays);
        updateDays();
    }

    populateDateSelects('startYearSelect', 'startMonthSelect', 'startDaySelect');
    populateDateSelects('endYearSelect', 'endMonthSelect', 'endDaySelect');
});