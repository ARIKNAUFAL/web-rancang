// **declare and set the minWidth variable
const minWidth576 = window.matchMedia("(min-width:576px)");
// const minWidth768 = window.matchMedia('(min-width:768px)');

// **categories Section
const hrs = document.querySelectorAll(".requestGroup>hr");

function removeHr(width) {
    if (width.matches) {
        //** If media query matches
        for (const hr of hrs) {
            hr.remove();
        }
    }
}

removeHr(minWidth576); // Call listener function at run time
minWidth576.addListener(removeHr); // Attach listener function on state changes

// **header
const header = document.querySelector("header");

// **create the link to the home page
const nav = document.createElement("p");
const span = document.createElement("span");
const a = document.createElement("a");

a.setAttribute("href", "/");

nav.append("Request Status");
a.append("Home");

span.appendChild(a);
nav.prepend(span);

function addLink(width) {
    if (width.matches) {
        //** */ If media query matches
        header.appendChild(nav);
    } else {
        header.removeChild(nav);
    }
}

addLink(minWidth576); // Call listener function at run time
minWidth576.addListener(addLink); // Attach listener function on state changes
