const re = /\[([^\[]*)\]\((.*)\)/;
let html = '';

window.onload = () => {
    //if ( document.getElementById('footer-src') ) console.log('smart');

    for (let i=0; i<items.length; i++) {
        myMatch = items[i].match(re);
        if (myMatch != null && myMatch.length == 3) {
            html += '<a class="ml-5 text-warning" href="' + myMatch[2] + '">' + myMatch[1] + '</a>';
        }
    }
    if (html.length > 0) {
        let linkContainer = document.createElement('span');
        linkContainer.innerHTML = html;
        //document.getElementById('footer-src').append(linkContainer);
        let place = document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0];
        place.append(linkContainer);
    }
};