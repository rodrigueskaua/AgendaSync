const darkModeKey = 'darkMode';

export function isDarkModeEnabled() {
  return localStorage.getItem(darkModeKey) === 'true';
}

export function toggleDarkMode() {
  const isDarkMode = !isDarkModeEnabled();
  document.body.classList.toggle('dark-mode', isDarkMode);

  if (isDarkMode) {
    document.body.setAttribute('data-bs-theme', 'dark');
  } else {
    document.body.removeAttribute('data-bs-theme');
  }

  localStorage.setItem(darkModeKey, isDarkMode);
}

export function initializeDarkMode() {
  const isDarkMode = isDarkModeEnabled();
  if (isDarkMode) {
    document.body.classList.add('dark-mode');
    document.body.setAttribute('data-bs-theme', 'dark');
  } else {
    document.body.classList.remove('dark-mode');
    document.body.removeAttribute('data-bs-theme');
  }
}

initializeDarkMode();
