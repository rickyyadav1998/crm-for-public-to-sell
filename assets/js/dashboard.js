function toggleSidebar(){const s=document.getElementById('sidebar');if(s)s.classList.toggle('open')}
function openModal(){const m=document.getElementById('modal');if(m)m.classList.add('show')}
function closeModal(){const m=document.getElementById('modal');if(m)m.classList.remove('show')}
(function(){
 const saved=localStorage.getItem('crm-theme');
 const dark=saved==='dark';
 document.body.classList.toggle('dark',dark);
 const btn=document.getElementById('themeToggle');
 if(btn){btn.textContent=dark?'☀':'☾';btn.title=dark?'Switch to day mode':'Switch to night mode';btn.onclick=function(){const isDark=document.body.classList.toggle('dark');localStorage.setItem('crm-theme',isDark?'dark':'light');btn.textContent=isDark?'☀':'☾';btn.title=isDark?'Switch to day mode':'Switch to night mode';}}
 const page=(location.pathname.split('/').pop()||'index.html').replace('.html','')||'dashboard';
 document.querySelectorAll('.nav-item[data-page]').forEach(a=>a.classList.toggle('active',a.dataset.page===page));
 const modal=document.getElementById('modal');if(modal)modal.addEventListener('click',e=>{if(e.target===modal)closeModal()});
 document.addEventListener('keydown',e=>{if((e.metaKey||e.ctrlKey)&&e.key.toLowerCase()==='k'){e.preventDefault();const input=document.querySelector('.search input');if(input)input.focus()}if(e.key==='Escape')closeModal()});
 document.querySelectorAll('.toggle').forEach(t=>t.addEventListener('click',()=>t.classList.toggle('on')));
})();