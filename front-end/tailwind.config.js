/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  
  theme: {
    extend: {},
  },
  plugins: [],
  options: {
    safelist: [/fa-/, /fas/, /far/, /fab/,/fa-solid fa-spinner fa-spin-pulse/], // Aggiungi le classi di FontAwesome qui
  },
}



