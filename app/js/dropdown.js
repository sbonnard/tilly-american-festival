const sponsorDropdown = document.getElementById('sponsor-dropdown');
const sponsorDropdownContent = document.getElementById('sponsor-dropdown-content');

const merchantDropdown = document.getElementById('merchant-dropdown');
const merchantDropdownContent = document.getElementById('merchant-dropdown-content');

const bandDropdown = document.getElementById('band-dropdown');
const bandDropdownContent = document.getElementById('band-dropdown-content');

const eventDropdown = document.getElementById('event-dropdown');
const eventDropdownContent = document.getElementById('event-dropdown-content');

/**
 * Toggles the visibility of a dropdown content section when the dropdown is clicked.
 *
 * @param {HTMLElement} yourDropdown - The dropdown button element.
 * @param {HTMLElement} yourDropdownContent - The content element associated with the dropdown.
 */
function getDropDown(yourDropdown, yourDropdownContent) {
    yourDropdown.addEventListener('click', function(e) {
        yourDropdownContent.classList.toggle('hidden');
    
        if (yourDropdownContent.classList.contains('hidden')) {
            yourDropdown.ariaExpanded = false;
        } else {
            yourDropdown.ariaExpanded = true;
        }
    });
}

getDropDown(sponsorDropdown, sponsorDropdownContent);
getDropDown(merchantDropdown, merchantDropdownContent);
getDropDown(bandDropdown, bandDropdownContent);
getDropDown(eventDropdown, eventDropdownContent);