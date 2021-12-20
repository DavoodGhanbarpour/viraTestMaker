

// ------------- Definitions ------------- //

const lightBlub             =       `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><line x1="9.7" y1="17" x2="14.3" y2="17" /></svg>`;
const darkBlub              =        `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><line x1="9.7" y1="17" x2="14.3" y2="17" /></svg>`;
const lightThemeTitle       =       'حالت روشن';
const darkThemeTitle        =       'حالت تاریک';
const darkModeButton        =        document.getElementById("darkMode");
const spanTitleDarkMode     =        darkModeButton.getElementsByTagName('span')[0];
const divSVGIconDarkMode    =        darkModeButton.getElementsByTagName('div')[0];
// ------------- Events ------------- //
document.getElementById("darkMode").onclick = function() { darkModeSetting() };




(function() {
    loadUserDarkModeConfig();
})();


// ------------- Functions ------------- //

function darkModeSetting()
{
    let key                    =        'darkMode';
    let lastSetting            =        localStorage.getItem(key) ?? false;


    if( lastSetting === 'enable' )
    {
        localStorage.setItem(key, "disable");
        document.getElementById('mainBody').classList.remove('theme-dark');
        spanTitleDarkMode.innerHTML  = darkThemeTitle;
        divSVGIconDarkMode.innerHTML = darkBlub;
    }
    else
    {
        localStorage.setItem(key, "enable");
        document.getElementById('mainBody').classList.add('theme-dark');
        spanTitleDarkMode.innerHTML  = lightThemeTitle;
        divSVGIconDarkMode.innerHTML = lightBlub;

    }
}

function loadUserDarkModeConfig()
{
    let key         = 'darkMode';
    let lastSetting = localStorage.getItem(key) ?? false;
    if( lastSetting === 'enable' )
    {
        document.getElementById('mainBody').classList.add('theme-dark');
        spanTitleDarkMode.innerHTML  = lightThemeTitle;
        divSVGIconDarkMode.innerHTML = lightBlub;
    }
}



function loadTooltips()
{
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}



