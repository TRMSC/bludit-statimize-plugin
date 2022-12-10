const re = /\[([^\[]*)\]\((.*)\)/;

prepareFooter = (theme) => {
    let html = '';
    for (let i=0; i<items.length; i++) {
        myMatch = items[i].match(re);
        if (myMatch != null && myMatch.length == 3) {
            html += '<a class="text-warning" href="' + myMatch[2] + '">' + myMatch[1] + '</a>';
        }
    }
    //if (html.length === 0) return; // UNCOMMENT LATER
    theme === 'smart' ? editSmart(html) : null;
    theme === 'alternative' || theme === 'blogx' ? editBludit(html) : null;
    theme === 'darktheme' ? editDark(html) : null;
};

editSmart = (html) => {
    // Add footer links
    if (html.length !== 0) {
        let footerLinks = document.getElementById('footer-links');
        footerLinks.classList.add('col', 'footer-col', 'footer-right');
        footerLinks.innerHTML = html;
        let footerSource = document.getElementById('footer-source');
        footerSource.classList.remove('footer-right');
        footerSource.classList.add('footer-center');
    }
    // Add footer text
    if (text.length !== 0) {
        let footerText = document.getElementById('footer-additional-text');
        footerText.innerHTML = text;
    }
};

editBludit = (html) => {
    console.log('bludit default theme is active');
};

editDark = (html) => {
    console.log('dark theme is active');
};

// ELEMENTS FOR LATER
/*
    let linkContainer = document.createElement('span');
    linkContainer.innerHTML = html;
    //document.getElementById('footer-src').append(linkContainer);
    let place = document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0];
    place.append(linkContainer);
*/