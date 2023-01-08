/**
 * Prepare footer links for passing to theme based functions 
 * 
 * @function prepareFooter
 * @param {string} theme Active theme
 * 
*/
prepareFooter = (theme) => {

    // Prepare footer links
    let html = '';
    const re = /\[([^\[]*)\]\((.*)\)/;
    for (let i=0; i<items.length; i++) {
        myMatch = items[i].match(re);
        if (myMatch != null && myMatch.length == 3) {
            html += '<a class="text-warning" href="' + myMatch[2] + '">' + myMatch[1] + '</a>';
        }
    }
    
    // Passing to theme based functions
    theme === 'smart' ? editSmart(html) : null;
    theme === 'alternative' || theme === 'blogx' ? editBludit(html) : null;
    theme === 'darktheme' ? editDark(html) : null;

};


/**
 * Implement links and additional text to footer for smart theme
 * 
 * @function editSmart
 * @param {string} html Prepared dom for additional links
 * 
*/
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


/**
 * Implement links and additional text to footer for bludit default themes
 * 
 * @function editBludit
 * @param {string} html Prepared dom for additional links
 * 
*/
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


/**
 * Implement links and additional text to footer for dark theme
 * 
 * @function editDark
 * @param {string} html Prepared dom for additional links
 * 
*/
editDark = (html) => {

    // Prepare setting
    let footer = document.getElementsByClassName('container');
    footer = footer[footer.length - 1];
    let footerRow = document.createElement('div');
    footerRow.classList.add('row');
    footer.append(footerRow);

    // Add footer text
    if (text.length !== 0) {
        let footerText = document.createElement('small');
        footerText.innerHTML = text;
        footerText.classList.add('text-secondary');
        footerRow.append(footerText);
    }
    
    // Add footer links
    if (html.length !== 0) {
        let footerLinks = document.createElement('div');
        footerLinks.innerHTML = html;
        footerLinks.style.display = 'flex';
        footerLinks.style.columnGap = '10px';
        footerLinks.style.justifyContent = 'center';
        footerRow.append(footerLinks);
    }

};
