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

    // Prepare setting
    let target = document.getElementsByTagName('footer')[0];
    let footerContainer = document.createElement('div');
    footerContainer.classList.add('bg-dark');
    let footerRow = document.createElement('div');
    footerRow.classList.add('row');
    footerRow.style.justifyContent = 'center';
    footerRow.style.marginTop = '-20px';
    footerRow.style.columnGap = '3em';
    footerContainer.append(footerRow);
    target.append(footerContainer);

    // Add footer text
    if (text.length !== 0) {
        let footerText = document.createElement('div');
        footerText.innerHTML = text;
        footerText.classList.add('text-white');
        footerRow.append(footerText);
    }

    // Add footer links
    if (html.length !== 0) {
        let footerLinks = document.createElement('div');
        footerLinks.innerHTML = html;
        footerLinks.style.display = 'flex';
        footerLinks.style.columnGap = '10px';
        footerRow.append(footerLinks);
    }
};

editDark = (html) => {
    console.log('dark theme is active');
};
