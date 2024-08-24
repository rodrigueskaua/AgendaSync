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
  updateContactIconsColor();
}

export function initializeDarkMode() {
  const isDarkMode = isDarkModeEnabled();
  document.body.classList.toggle('dark-mode', isDarkMode);
  document.body.setAttribute('data-bs-theme', isDarkMode ? 'dark' : '');
  updateContactIconsColor();
}

// Function to update contact icons color based on dark mode
function updateContactIconsColor() {
  const icons = document.querySelectorAll('.contact-icon');
  icons.forEach(icon => {
    const name = icon.getAttribute('data-contact-name') || ''; // Get the contact name from a data attribute if available
    icon.style.backgroundColor = generateColor(name);
  });
}

// Function to generate color based on the name and theme
function generateColor(name) {
  let hash = 0;
  for (let i = 0; i < name.length; i++) {
    hash = name.charCodeAt(i) + ((hash << 5) - hash);
  }

  const hue = Math.abs(hash) % 360;
  const isDarkMode = document.body.getAttribute('data-bs-theme') === 'dark';
  const saturation = isDarkMode ? 20 + (Math.abs(hash) % 20) : 60 + (Math.abs(hash) % 20);
  const lightness = isDarkMode ? 30 + (Math.abs(hash) % 10) : 70 + (Math.abs(hash) % 20);

  return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
}

// Initialize dark mode on page load
initializeDarkMode();

// Observer to detect changes in theme and update icon colors
const observer = new MutationObserver(() => {
  updateContactIconsColor();
});

observer.observe(document.body, { attributes: true, attributeFilter: ['data-bs-theme'] });
