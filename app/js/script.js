import '../scss/style.scss';

/**
 * If the website is displayed on a mobile, return true.
 * @returns 
 */
function isMobile() {
    return window.innerWidth <= 768;
}

const commpassTtl = document.getElementById('commpass-ttl');
const commpassImg = document.getElementById('commpass-img');
const commpassDesc = document.getElementById('commpass-desc');
const commpassLnk = document.getElementById('commpass-lnk');

commpassTtl.addEventListener('mouseover', function(e) {
    commpassDesc.classList.remove('hidden');
});

commpassTtl.addEventListener('mouseout', function(e) {
    commpassDesc.classList.add('hidden');
});

if(isMobile()) {
    commpassTtl.addEventListener('click', function(e) {
        commpassDesc.classList.toggle('hidden');
    });
}

const mingleTtl = document.getElementById('mingle-ttl');
const mingleImg = document.getElementById('mingle-img');
const mingleDesc = document.getElementById('mingle-desc');
const mingleLnk = document.getElementById('mingle-lnk');

mingleTtl.addEventListener('mouseover', function(e) {
    mingleDesc.classList.remove('hidden');
});

mingleTtl.addEventListener('mouseout', function(e) {
    mingleDesc.classList.add('hidden');
});


if(isMobile()) {
    mingleTtl.addEventListener('click', function(e) {
        mingleDesc.classList.toggle('hidden');
    });
}

// mingleImg.addEventListener('mouseover', function(e) {
//     mingleLnk.classList.remove('hidden');
// });

// mingleImg.addEventListener('mouseout', function(e) {
//     mingleLnk.classList.add('hidden');
// });

// mingleLnk.addEventListener('mouseover', function(e) {
//     mingleLnk.classList.add('hidden');
// });

// mingleLnk.addEventListener('mouseout', function(e) {
//     mingleLnk.classList.add('hidden');
// });