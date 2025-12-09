(function(){
  const body = document.querySelector('body.layout');
  const toggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('siteSidebar');

  if(!body || !toggle || !sidebar) return;

  const collapsedKey = 'sidebar-collapsed';
  const collapsed = localStorage.getItem(collapsedKey) === 'true';
  setCollapsed(collapsed);

  toggle.addEventListener('click', function(){
    const isCollapsed = body.classList.toggle('sidebar-collapsed');
    localStorage.setItem(collapsedKey, isCollapsed);
    toggle.setAttribute('aria-expanded', !isCollapsed);
  });

  document.addEventListener('click', function(e){
    if(window.innerWidth <= 900){
      if(!sidebar.contains(e.target) && !toggle.contains(e.target)){
        body.classList.add('sidebar-collapsed');
        localStorage.setItem(collapsedKey, true);
        toggle.setAttribute('aria-expanded', false);
      }
    }
  });

  function setCollapsed(val){
    if(val) body.classList.add('sidebar-collapsed');
    else body.classList.remove('sidebar-collapsed');
    toggle.setAttribute('aria-expanded', !val);
  }
})();
// ====================== THEME MODE =========================

const themeToggle = document.getElementById('themeToggle');
const savedTheme = localStorage.getItem('theme-mode');

// Load saved mode
if (savedTheme === 'light') {
    document.body.classList.add('light');
    if (themeToggle) themeToggle.checked = true;
}

if (themeToggle) {
    themeToggle.addEventListener('change', () => {
        if (themeToggle.checked) {
            document.body.classList.add('light');
            localStorage.setItem('theme-mode', 'light');
        } else {
            document.body.classList.remove('light');
            localStorage.setItem('theme-mode', 'dark');
        }
    });
}
