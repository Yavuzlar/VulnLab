
function getCookie(cookiename) 
{
var cookiestring=RegExp(cookiename+"=[^;]+").exec(document.cookie);
return decodeURIComponent(!!cookiestring ? cookiestring.toString().replace(/^[^=]+./,"") : "");
}


/** LANGUAGES **/
const languages = [
    {
        name: "English",
        code: "en"
    },
    {
        name: "T&uuml;rk&ccedil;e",
        code: "tr"
    },
    {
        name: "Fran&#xE7;ais",
        code: "fr"
    }
]
var selectedLanguage = languages.find(x => x.code == (getCookie("lang") || "en"));

/** TRANSLATION **/
const translate = {
    "goBack": {
        "tr": "Geri D&ouml;n",
        "en": "Go Back",
        "fr": "Retourner"
    },
    "sourceC": {
        "tr": "Kaynak Kod",
        "en": "Source Code",
        "fr": "Code Source"
    }
}

/** GET DATA **/
try{
    var LabTitle = document.getElementById("VLBar").getAttribute(`title`);
    var CategoryID = document.getElementById("VLBar").getAttribute("category-id");
}catch {
    alert("VulnLab ERROR: VLBar Load ERROR!")
}


/** STYLES **/
const headerElStyle = `
    font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 1rem;
    margin:0;
    padding: 0;
    background-color: rgb(7, 14, 39);
    border-bottom: 1px solid rgb(22, 32, 68);
    width: 100%;
    position: sticky;
    top: 0;
`

const headerWrapperStyle = `
    padding: 10px 40px;
    display: flex;
    color: white;
    align-items: center;
    justify-content: space-between;
    display: relative;
`

const dropdownStyle = `
    position: relative;
    box-sizing: border-box;
    display: block;
`

const btnStyle = `
    display:flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    color: #fff;
    background-color: #162044;
    border-color: #162044;
    font-weight: 500;
    line-height: 1.5;
    vertical-align: middle;
    text-align: center;
    border: 1px solid transparent;
    font-size: 1rem;
    border-radius: 0.5rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    padding: 1rem 1.8rem;
`

const dropdownListStyle = `
    margin: 0;
    position:absolute;
    background-color: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    width: 100%;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.25rem;
    padding: 0.5rem 0;
    z-index: 100000;
    top: 100%;
    min-width: 10rem;
    display: none;
`

const dropdownListItemStyle = `
    cursor: pointer;
    color: #070E27;
    padding: 0.25rem 1rem;
    margin: 0;
    list-style: none;
    display: flex;
    align-items: center;
`

document.body.style.margin = "0";
var headerEl = document.createElement('div');
headerEl.style.cssText = headerElStyle;
document.body.prepend(headerEl);

var headerWrapperEl = document.createElement('div');
headerWrapperEl.style.cssText = headerWrapperStyle;
headerEl.appendChild(headerWrapperEl);


var logoEl = document.createElement('div');
logoEl.innerHTML =`
    <a href="/index.php">
        <img src="/public/assets/img/gallery/logo.png" alt="Vulnlab-Logo">
    </a>
`
headerWrapperEl.appendChild(logoEl);


var labNameEl = document.createElement('div');
labNameEl.innerHTML =`
    <h3> <b>${LabTitle || "Untitled Lab"}</b> </h3>
`
headerWrapperEl.appendChild(labNameEl);

var headerRight = document.createElement('div');
headerRight.style.cssText = `display: flex; align-items: center;`
headerWrapperEl.appendChild(headerRight);

var btnCategoryEl = document.createElement('div');
btnCategoryEl.style.cssText = btnStyle
btnCategoryEl.style.marginRight = "15px";
btnCategoryEl.innerHTML = `
<img style="width: 15px; margin-right:5px;" src="/public/assets/img/back.png" > ${translate["goBack"][selectedLanguage.code]}
`
btnCategoryEl.onmouseover = () => {
    btnCategoryEl.style.backgroundColor = "#131b3a";
}
btnCategoryEl.onmouseleave = () => {
    btnCategoryEl.style.backgroundColor = "#162044";
}

btnCategoryEl.onclick = () => {
    window.location.href = `/vuln/${CategoryID}`;
}

var btnSourceCodeEl= document.createElement("div")
btnSourceCodeEl.style.cssText=btnStyle;
btnSourceCodeEl.style.marginRight = "15px";
btnSourceCodeEl.innerHTML = `
<img style="width: 15px; margin-right:5px;" src="/public/assets/img/source.png" > ${translate["sourceC"][selectedLanguage.code]}
`
btnSourceCodeEl.onmouseover = () => {
    btnSourceCodeEl.style.backgroundColor = "#131b3a";
}
btnSourceCodeEl.onmouseleave = () => {
    btnSourceCodeEl.style.backgroundColor = "#162044";
}

btnSourceCodeEl.onclick = () =>{
    let url = "/source-code.php?page=."+window.location.pathname
    if (url.charAt(url.length -1) === "/"){
        url = url+ "index.php";
    }
    let left = (screen.width - 750) / 2;
    let top = (screen.height - 750) / 4;
    let pop = window.open(url,'popUpWindow','height=750,width=750,left='+left+',top='+top+',resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,directories=no, status=yes');
    pop.moveTo(left,top);
    pop.focus();
}

headerRight.appendChild(btnCategoryEl);
headerRight.appendChild(btnSourceCodeEl)

var langEl = document.createElement('div');
headerRight.appendChild(langEl);

var dropdownEl = document.createElement('div');
dropdownEl.style.cssText = dropdownStyle;
langEl.appendChild(dropdownEl);

var btnLangEl = document.createElement('div');
btnLangEl.style.cssText = btnStyle;

btnLangEl.innerHTML =`
    <img style="width: 26px; margin-right:5px;" src="/public/assets/img/${selectedLanguage.code}.png" >  ${selectedLanguage.name}
`
btnLangEl.onmouseover = () => {
    btnLangEl.style.backgroundColor = "#131b3a";
}
btnLangEl.onmouseleave = () => {
    btnLangEl.style.backgroundColor = "#162044";
}

btnLangEl.onclick = () => {
    if(dropdownListEl.style.display == "none") {
        dropdownListEl.style.display = "block";
    } else {
        dropdownListEl.style.display = "none";
    }
}

dropdownEl.appendChild(btnLangEl);

var dropdownListEl = document.createElement('ul');
dropdownListEl.style.cssText = dropdownListStyle;
dropdownEl.appendChild(dropdownListEl);

languages.forEach(lang => {
    let dropdownListItemEl = document.createElement('li');
    dropdownListItemEl.style.cssText = dropdownListItemStyle;
    dropdownListItemEl.innerHTML = `<img style="width: 26px; margin-right:5px;" src="/public/assets/img/${lang.code}.png" > ${lang.name}`
    dropdownListItemEl.onmouseover = () => {
        dropdownListItemEl.style.backgroundColor = "#EBEBED";
    }
    dropdownListItemEl.onmouseout = () => {
        dropdownListItemEl.style.backgroundColor = "#FFFFFF";
    }
    dropdownListItemEl.onclick = () => {
        document.cookie = "lang="+lang.code+";path=/";
        location.reload();
    }
    dropdownListEl.appendChild(dropdownListItemEl);
})

