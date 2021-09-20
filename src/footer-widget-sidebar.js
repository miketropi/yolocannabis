const FooterWidgetToggleMobile = (widgets) => { 
  if(!widgets || widgets.length == 0) return;
  widgets.forEach((elem, index) => {
    elem.classList.add(`widget-toggle-mobile`);

    const headingElem = elem.querySelector('h2.widget-title');
    const toggleArrow = document.createElement(`span`);
    toggleArrow.classList.add('toggle-arrow')
    toggleArrow.innerHTML = `▾`

    headingElem.appendChild(toggleArrow)
    
    headingElem.addEventListener('click', (e) => {
      e.preventDefault();
      elem.classList.toggle(`widget-toggle-mobile--open`)
    })
  })
} 

export {FooterWidgetToggleMobile};