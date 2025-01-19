const sponsorDropdown = document.getElementById('sponsor-dropdown');
const sponsorDropdownContent = document.getElementById('sponsor-dropdown-content');

sponsorDropdown.addEventListener('click', function(e) {
    sponsorDropdownContent.classList.toggle('hidden');

    if (sponsorDropdownContent.classList.contains('hidden')) {
        sponsorDropdown.ariaExpanded = false;
    } else {
        sponsorDropdown.ariaExpanded = true;
    }
});