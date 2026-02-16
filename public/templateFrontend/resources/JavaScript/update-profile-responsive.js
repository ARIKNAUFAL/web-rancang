// **declare and set the minWidth variable
const minWidth576 = window.matchMedia("(min-width:576px)");

// **remove header at min-width:576px
const header = document.querySelector("header");

function removeHeader(width) {
    if (width.matches) {
        //** */ If media query matches
        header.remove();
    }
}

removeHeader(minWidth576); // Call listener function at run time
minWidth576.addListener(removeHeader); // Attach listener function on state changes

// **add back home at min-width:576px
const updateProfile = document.querySelector("section");

const standOut = document.querySelector(".stand-out");

// **create the back-profile link
const backProfileLink = document.createElement("a");
backProfileLink.setAttribute("href", "/profile");

// ** create the back-profile icon
const xmlns = "http://www.w3.org/2000/svg";
const boxWidth = 15;
const boxHeight = 15;

const backProfile = document.createElementNS(xmlns, "svg");
backProfile.setAttributeNS(
    null,
    "viewBox",
    "0 0 " + boxWidth + " " + boxHeight
);
backProfile.setAttributeNS(null, "width", boxWidth);
backProfile.setAttributeNS(null, "height", boxHeight);

const backProfilePath = document.createElementNS(xmlns, "path");
backProfilePath.setAttributeNS(
    null,
    "d",
    "M7.5 15L0 7.5L7.5 0L8.48438 0.984375L2.67188 6.79688H15V8.20312H2.67188L8.48438 14.0156L7.5 15Z"
);
backProfilePath.setAttributeNS(null, "fill", "#30314B");

backProfile.appendChild(backProfilePath);
backProfile.style.marginRight = "15px";

backProfileLink.appendChild(backProfile);

function modifyHeader(width) {
    if (width.matches) {
        //** */ If media query matches
        updateProfile.style.marginTop = "20px";
        standOut.insertAdjacentElement("afterbegin", backProfileLink);
    }
}

modifyHeader(minWidth576); // Call listener function at run time
minWidth576.addListener(modifyHeader); // Attach listener function on state changes
