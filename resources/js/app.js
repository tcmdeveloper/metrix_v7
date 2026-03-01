import './bootstrap';

/**************************************************/
/*  Javsscript for opening & closing slide menu   */
/**************************************************/


// CONSTANTS

const openSlideMenuIcon = document.querySelector('#openSlideMenuIcon');
const closeSlideMenuIcon = document.querySelector('#closeSlideMenuIcon');
const slideMenu = document.querySelector('#slideMenu');

const toggleNavSearchIcon = document.querySelector('#toggleNavSearchIcon');
const navSearchBar = document.querySelector('#navSearchBar');

const blackout = document.querySelector('#blackout');




// RUN FUNCTIONS ON CLICK

openSlideMenuIcon.onclick = function(e) {
    e.preventDefault();
    focusOnSlideMenu();
}

closeSlideMenuIcon.onclick = function(e) {
    e.preventDefault();
    resetAll();
}

toggleNavSearchIcon.onclick = function(e) {
    e.preventDefault();
    focusOnNavSearchBar();
}

blackout.onclick = function(e) {
    e.preventDefault();
    resetAll();
}




// CHECK IF ELEMENTS ARE OPEN

function blackoutIsOpen(){
    if(blackout.classList.contains('hidden') === true)
        return false;
    return true;
}

function slideMenuIsOpen() {
    if(slideMenu.classList.contains('-translate-y-20'))
        return false;
    return true;
}

function navSearchBarIsOpen() {
    if(navSearchBar.classList.contains('-translate-y-20') === true)
        return false;
    return true;
}




// SHOW / HIDE ELEMENTS

function showBlackout() {
    blackout.classList.remove('hidden');
}

function hideBlackout() {
    blackout.classList.add('hidden');
    // document.querySelector('.popup').classList.remove('top-1/2');
    // document.querySelector('.popup').classList.add('-top-full');
    // document.querySelector('.popup').classList.add('opacity-0');
}

function showSlideMenu() {
    slideMenu.classList.remove('-left-full');
    slideMenu.classList.add('left-0')
}

function hideSlideMenu() {
    slideMenu.classList.remove('left-0');
    slideMenu.classList.add('-left-full')
}

function showNavSearchBar() {
    navSearchBar.classList.remove('-translate-y-20');
    navSearchBar.classList.add('translate-y-0');
    document.querySelector('#navSearchInput').focus();
}

function hideNavSearchBar() {
    navSearchBar.classList.remove('translate-y-0');
    navSearchBar.classList.add('-translate-y-20')
}

function focusOnSlideMenu() {
    if(blackoutIsOpen() === false)
        showBlackout();

    hideNavSearchBar();
    showSlideMenu();
}

function focusOnNavSearchBar() {
    if(slideMenuIsOpen() === true) {
        hideSlideMenu();
    }

    if(navSearchBarIsOpen() === false) {
        showNavSearchBar();
        showBlackout();
        return;
    }

    if(navSearchBarIsOpen() === true) {
        hideNavSearchBar();
        hideBlackout();
        return;
    }
}

function resetAll() {
    hideSlideMenu();
    hideNavSearchBar();
    hideBlackout();

    if(document.querySelector('.edit-popup-box')){
        var popups = documents.querySelector('.edit-popup-box');

        // Loop through the elements.
        for (var i = 0; i < popups.length; i++) {
            // Add the class margin to the individual elements.
            popups[i].classList.add('hidden');
        }
    }
}