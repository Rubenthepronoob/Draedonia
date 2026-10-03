// Prevent drawing and selecting text on the page.
document.addEventListener('selectstart', (event) => {
  event.preventDefault();
});

document.addEventListener('dragstart', (event) => {
  event.preventDefault();
});

const pages = {
  login: 'login',
  back: 'back',
  play: 'play-menu',
  customize: 'customize-menu',
  credits: 'credits-menu',
  exitgame: 'exitgame',
  youdied: 'you-died',
};

const menuButtons = ['play', 'customize', 'credits', 'exitgame'];
const mainTitle = document.getElementById('main-title');
const background = document.getElementById('background');
const finalScore = document.getElementById('finalScore');


function setTitle(value) {
  if (mainTitle) {
    mainTitle.textContent = value;
  }
}

function setBackground(name) {
  background?.classList.remove(
    'background-login',
    'background-home',
    'background-play',
    'background-credits',
    'background-customize',
    'background-died'
  );

  if (name) {
    background?.classList.add(`background-${name}`);
  }
}

function setButtonLayout(layout) {
  const buttons = document.getElementById('buttons');
  buttons?.classList.remove('top', 'middle', 'center');
  buttons?.classList.add(layout);
}

function showPage(pageId) {
  Object.values(pages).forEach((id) => {
    document.getElementById(id)?.classList.add('hide');
  });

  document.getElementById(pageId)?.classList.remove('hide');
}

function bindMenuButtons() {
  const menuActions = {
    login: () => {
      showPage('back');
        document.getElementById('loginbutton')?.classList.add('hide');
        menuButtons.forEach((id) => {
          document.getElementById(id)?.classList.remove('hide');
        });
        setButtonLayout('center');
        setTitle('home');
        setBackground('home');
    },
    back: () => {
      showPage('back');
      document.getElementById('back')?.classList.add('hide');
      menuButtons.forEach((id) => {
        document.getElementById(id)?.classList.remove('hide');
      });
      setButtonLayout('center');
      setTitle('home');
      setBackground('home');
    },
    play: () => {
      showPage('play-menu');
      document.getElementById('back')?.classList.remove('hide');
      menuButtons.forEach((id) => {
        document.getElementById(id)?.classList.add('hide');
      });
      setButtonLayout('top');
      setTitle('play');
      setBackground('play');
    },
    customize: () => {
      showPage('customize-menu');
      document.getElementById('back')?.classList.remove('hide');
      menuButtons.forEach((id) => {
        document.getElementById(id)?.classList.add('hide');
      });
      setButtonLayout('top');
      setTitle('Customize your character!');
      setBackground('customize');
    },
    credits: () => {
      showPage('credits-menu');
      document.getElementById('back')?.classList.remove('hide');
      menuButtons.forEach((id) => {
        document.getElementById(id)?.classList.add('hide');
      });
      setButtonLayout('middle');
      setTitle('credits');
      setBackground('credits');
    },
  };

  Object.entries(menuActions).forEach(([buttonId, handler]) => {
    document.getElementById(buttonId)?.addEventListener('click', handler);
  });
}

bindMenuButtons();