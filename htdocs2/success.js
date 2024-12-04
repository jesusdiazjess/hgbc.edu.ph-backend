// Array of image URLs
//const images = [
    //'https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/imageside/serverside1.jpg',
   // 'https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/imageside/serverside7.webp',
   // 'https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/imageside/serverside2.1.webp',
   // 'https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/imageside/serverside5.jpg',
   // 'https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/imageside/serverside4.3.jpg'
//];

// Select a random image from the array
const randomImage = images[Math.floor(Math.random() * images.length)];

// Apply the random image as the background
document.body.style.setProperty('--background-url', `url(${randomImage})`);

// Inject the background image to body::before
const style = document.createElement('style');
style.innerHTML = `
    body::before {
        background-image: var(--background-url);
    }
`;
document.head.appendChild(style);