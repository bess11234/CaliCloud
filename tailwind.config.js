/** @type {import('tailwindcss').Config} */
export default {
    content: ['./*.html', './src/**/*.{js,ts,jsx,tsx,html}'],
    darkMode: 'media',
    theme: {
        extend: {
            colors: {
                'black2': "#18181b",
                'lightBlue': "#eff2f7",
                'darkBlue': "#010c27",
            }
        },
    },
    plugins: [],
}