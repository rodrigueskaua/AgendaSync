const darkModeKey = 'darkMode';

export function isDarkModeEnabled() {
  return localStorage.getItem(darkModeKey) === 'true';
}

export function toggleDarkMode() {
  const isDarkMode = !isDarkModeEnabled();
  document.body.classList.toggle('dark-mode', isDarkMode);
  localStorage.setItem(darkModeKey, isDarkMode);
}

export function initializeDarkMode() {
  const isDarkMode = isDarkModeEnabled();
  if (isDarkMode) {
    document.body.classList.add('dark-mode');
  }
}