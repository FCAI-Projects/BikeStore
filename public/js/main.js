$(function() {
  'use strict';
  $('.confirm').click(function () {
		return confirm('Are you sure??');
	});
});

const mainColor = localStorage.getItem('main-color');

if (mainColor) {
  document.documentElement.style.setProperty('--main-color', mainColor);
}

const elements = {
  colorLi: document.querySelectorAll('.settings .color-list li'),
  settingIcon: document.querySelector('.settings .setting-icon'),
  setting: document.querySelector('.settings'),
};

elements.settingIcon.onclick = () => {
  elements.setting.classList.toggle('open');
}

 elements.colorLi.forEach(li => {
   li.addEventListener('click', () => {
     document.documentElement.style.setProperty('--main-color', li.dataset.color);
     localStorage.setItem('main-color', li.dataset.color);
   });
 });
