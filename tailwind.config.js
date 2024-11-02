/** @type {import('tailwindcss').Config} */
export default {
  content: ['./*.html', './src/**/*.{js,ts,jsx,tsx,html}'],
  theme: {
    extend: {
      colors:{
        'black2': "#18181b",
      }
    },
  },
  plugins: [],
}