const btn = document.querySelector('#headerCollapse');
const sidebar = document.querySelector('#applicationSidebar');
const backdrop = document.querySelector('#sidebarBackdrop');
const search = document.querySelector('#headerSearch');
const searchbar = document.querySelector('#applicationSearch');

if(btn) {
    btn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        backdrop.classList.toggle('hidden');
    });
}

if(backdrop){
    backdrop.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        backdrop.classList.toggle('hidden');
    });
}


if(search){
    search.addEventListener('click', () => {
        searchbar.classList.toggle('hidden');
    });
}

