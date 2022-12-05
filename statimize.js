const re = /\[([^\[]*)\]\((.*)\)/;
let html = '';

window.onload = () => {
    for (let i=0; i<items.length; i++) {
        myMatch = items[i].match(re);
        if (myMatch != null && myMatch.length == 3) {
            html += '<a href="' + myMatch[2] + '">' + myMatch[1] + '</a>';
            console.log('text: ' + myMatch[1]);
            console.log('url: ' + myMatch[2]);
        }
    }
    console.log(html);
    let linkContainer = document.createElement('p');
    linkContainer.innerHTML = html;
    document.getElementById('footer-src').append(linkContainer);
};